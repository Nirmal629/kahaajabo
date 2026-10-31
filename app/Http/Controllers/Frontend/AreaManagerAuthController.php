<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AreaManagerAuthController extends Controller
{
    public function dashboard(){

        $user = auth('web')->user();

        $countries = Country::where('country_code', 'IN')->orderBy('country_name')->get();

        return view('Manager-Dashboard.dashboard', compact('countries'));
    }

    public function profile(){
        return view('Manager-Dashboard.profile');
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
}
