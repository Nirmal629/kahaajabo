<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    
    public function profile(){
        $countries = Country::where('country_code', 'IN')->orderBy('country_name')->get();
        return view('User-Dashboard.profile', compact('countries'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name'       => 'required|string|max:255',
            'middle_name'      => 'nullable|string|max:255',
            'last_name'        => 'nullable|string|max:255',
            'phone_number'     => 'required|digits:10',
            'secondary_mobile' => 'nullable|digits:10',
            'gender'           => 'nullable|in:male,female,other',
            'dob'              => 'nullable|date|before_or_equal:today',
            'skill_level'      => 'nullable|string|max:255',
            'currency'         => 'nullable|string|max:255',
            'timezone'         => 'nullable|string|max:255',
            'country_id'       => 'required|exists:location_countries,id',
            'state_id'         => 'required|exists:location_states,id',
            'district_id'      => 'required|exists:location_districts,id',
            'email_notification' => 'nullable|in:yes,no',
            'call_text_chat_consent' => 'nullable|in:yes,no',
        ]);

        // Update each field individually
        $user->name = collect([
                    $validated['first_name'],
                    $validated['middle_name'],
                    $validated['last_name'],
                ])->filter()->implode(' ');
        $user->first_name = $validated['first_name'];
        $user->middle_name = $validated['middle_name'] ?? null;
        $user->last_name = $validated['last_name'] ?? null;
        $user->phone_number = $validated['phone_number'];
        $user->secondary_mobile = $validated['secondary_mobile'] ?? null;

        $user->gender = $validated['gender'] ?? null;
        $user->dob = $validated['dob'] ?? null;

        $user->skill_level = $validated['skill_level'] ?? null;
        $user->currency = $validated['currency'] ?? null;
        $user->timezone = $validated['timezone'] ?? null;

        $user->country_id = $validated['country_id'];
        $user->state_id = $validated['state_id'];
        $user->district_id = $validated['district_id'];

        $user->email_notification = $validated['email_notification'] ?? $user->email_notification;
        $user->call_text_chat_consent = $validated['call_text_chat_consent'] ?? $user->call_text_chat_consent;

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
