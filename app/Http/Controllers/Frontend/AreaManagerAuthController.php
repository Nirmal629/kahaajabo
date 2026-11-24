<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ExternalUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AreaManagerAuthController extends Controller
{
    public function dashboard(){

        $user = auth('web')->user();

        $countries = Country::where('country_code', 'IN')->orderBy('country_name')->get();

        return view('Manager-Dashboard.dashboard', compact('countries'));
    }

    public function profile(){

        $user = auth('web')->user();
        $external_user = ExternalUser::where('email', $user->email)->first();
        $countries = Country::where('country_code', 'IN')->orderBy('country_name')->get();

        return view('Manager-Dashboard.profile', compact('countries', 'user', 'external_user'));
    }

    public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {

            $user = Auth::guard('web')->user();

            // Delete old profile image
            if ($user->profile_picture &&
                Storage::disk('public')->exists($user->profile_picture)) {

                Storage::disk('public')->delete($user->profile_picture);
            }

            // Upload new image
            $imagePath = $request->file('profile_image')
                ->store('profile_images', 'public');

            // Update user profile
            $user->profile_picture = $imagePath;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile image updated successfully!',
                'image_url' => asset('storage/' . $imagePath),
            ]);

        } catch (\Exception $e) {

            Log::error('Profile Image Upload Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Unable to upload profile image.',
            ], 500);
        }
    }


    public function deleteProfileImage()
    {
        try {

            $user = Auth::guard('web')->user();

            if (!$user->profile_picture) {
                return response()->json([
                    'success' => false,
                    'message' => 'No profile image found.',
                ], 404);
            }

            // Delete image from storage
            if (Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Remove image path from database
            $user->profile_picture = null;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile image deleted successfully!',
                'image_url' => asset('images/default-profile.png'),
            ]);

        } catch (\Exception $e) {

            Log::error('Profile Image Delete Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Unable to delete profile image.',
            ], 500);
        }
    }

    public function updateProfile(Request $request){
        $user = Auth::user();

    if (!$user) {
        return redirect('/')
            ->with('error', 'Please login first.');
    }

    // Find corresponding external user using email
    $externalUser = ExternalUser::where('email', $user->email)->first();

    if (!$externalUser) {
        return back()->with('error', 'External user record not found.');
    }

    // VALIDATION
    $validated = $request->validate([
        // User table
        'first_name' => 'required|string|max:100',
        'last_name' => 'nullable|string|max:100',
        'phone_number' => 'required|digits:10|unique:users,phone_number,' . $user->id,

        'country_id' => 'required|integer',
        'state_id' => 'required|integer',
        'district_id' => 'required|integer',
        'city_id' => 'required|integer',
        'area_id' => 'required|integer',
        'complete_address' => 'nullable|string|max:1000',

        'email_notification' => 'required|in:yes,no',
        'call_text_chat_consent' => 'required|in:yes,no',

        // External user table - identity documents
        'aadhar_card_number' => 'nullable|digits:12',
        'aadhar_card_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',

        'pan_card_number' => [
            'nullable',
            'regex:/^[A-Z]{5}[0-9]{4}[A-Z]$/i'
        ],
        'pan_card_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',

        // Bank details
        'bank_name' => 'nullable|string|max:255',
        'account_holder_name' => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:30',
        'ifsc_code' => [
            'nullable',
            'regex:/^[A-Z]{4}0[A-Z0-9]{6}$/i'
        ],
        'bank_passBook_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',

        // Driving license
        'driving_license' => 'nullable|string|max:50',
        'driving_license_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'license_start_date' => 'nullable|date',
        'license_end_date' => 'nullable|date|after_or_equal:license_start_date',
    ]);

    // FILE UPLOAD DIRECTORY
    $uploadPath = public_path('uploads/area-manager');

    if (!File::exists($uploadPath)) {
        File::makeDirectory($uploadPath, 0755, true);
    }

    // Save uploaded files and return their filenames
    $uploadFile = function ($field) use ($request, $uploadPath) {
        if (!$request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);
        $fileName = $field . '_' . Str::uuid() . '.' .
            $file->getClientOriginalExtension();

        $file->move($uploadPath, $fileName);

        return $fileName;
    };

    DB::beginTransaction();

    try {

        // ==================================
        // UPDATE USERS TABLE
        // ==================================

        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'] ?? null;
        $user->phone_number = $validated['phone_number'];

        $user->country_id = $validated['country_id'];
        $user->state_id = $validated['state_id'];
        $user->district_id = $validated['district_id'];
        $user->city_id = $validated['city_id'];
        $user->area_id = $validated['area_id'];

        $user->email_notification = $validated['email_notification'];
        $user->call_text_chat_consent = $validated['call_text_chat_consent'];

        $user->save();


        // ==================================
        // UPDATE EXTERNAL_USERS TABLE
        // ==================================


        $externalUser->country_id = $validated['country_id'];
        $externalUser->state_id = $validated['state_id'];
        $externalUser->district_id = $validated['district_id'];
        $externalUser->city_id = $validated['city_id'];
        $externalUser->area_id = $validated['area_id'];

        $externalUser->complete_address = $validated['complete_address'] ?? null;

        $externalUser->aadhar_card_number =
            $validated['aadhar_card_number'] ?? null;

        $externalUser->pan_card_number =
            isset($validated['pan_card_number'])
                ? strtoupper($validated['pan_card_number'])
                : null;

        $externalUser->bank_name = $validated['bank_name'] ?? null;
        $externalUser->account_holder_name =
            $validated['account_holder_name'] ?? null;

        $externalUser->account_number =
            $validated['account_number'] ?? null;

        $externalUser->ifsc_code =
            isset($validated['ifsc_code'])
                ? strtoupper($validated['ifsc_code'])
                : null;

        $externalUser->driving_license =
            $validated['driving_license'] ?? null;

        $externalUser->license_start_date =
            $validated['license_start_date'] ?? null;

        $externalUser->license_end_date =
            $validated['license_end_date'] ?? null;


        // ==================================
        // UPLOAD DOCUMENTS
        // ==================================

        $fileFields = [
            'aadhar_card_file',
            'pan_card_file',
            'bank_passBook_file',
            'driving_license_file',
        ];

        foreach ($fileFields as $field) {
            $newFile = $uploadFile($field);

            // Update only when a new file is uploaded
            if ($newFile) {
                $externalUser->$field = $newFile;
            }
        }

        $externalUser->save();

        DB::commit();

        return back()->with('success', 'Profile details updated successfully!');

    } catch (\Throwable $e) {

        DB::rollBack();

        report($e);

        return back()->with('error', 'Unable to update profile. Please try again.');
    }
    }
}
