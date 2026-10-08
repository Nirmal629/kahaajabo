<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ExternalUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProfileCompletionController extends Controller
{
    // public function show()
    // {
    //     $user = Auth::guard('web')->user();

    //     if (!$user) {
    //         return redirect()->route('home.index');
    //     }

    //     // Already completed
    //     if ($user->profile_completed) {
    //         return redirect()->route(
    //             $this->getDashboardRoute($user)
    //         );
    //     }

    //     $countries = Country::orderBy('country_name')->get();

    //     return view(
    //         'frontend.profile.complete',
    //         compact('countries')
    //     );
    // }

    public function update(Request $request)
    {
        $request->validate([
            'country_id' => [
                'required',
                'integer',
                'exists:location_countries,id',
            ],

            'state_id' => [
                'required',
                'integer',
                'exists:location_states,id',
            ],

            'district_id' => [
                'required',
                'integer',
                'exists:location_districts,id',
            ],

            'city_id' => [
                'required',
                'integer',
                'exists:location_cities,id',
            ],

            'area_id' => [
                'required',
                'integer',
                'exists:location_areas,id',
            ],
        ], [
            'country_id.required' => 'Please select your country.',
            'country_id.exists' => 'Please select a valid country.',

            'state_id.required' => 'Please select your state.',
            'state_id.exists' => 'Please select a valid state.',

            'district_id.required' => 'Please select your district.',
            'district_id.exists' => 'Please select a valid district.',

            'city_id.required' => 'Please select your city.',
            'city_id.exists' => 'Please select a valid city.',

            'area_id.required' => 'Please select your area.',
            'area_id.exists' => 'Please select a valid area.',
        ]);

        $user = Auth::guard('web')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User is not authenticated.',
            ], 401);
        }

        $externalUser = ExternalUser::where('email', $user->email)->first();

        if (!$externalUser) {
            return response()->json([
                'status' => false,
                'message' => 'Area manager profile not found.',
            ], 404);
        }

        if ($user->user_type === 'area_manager') {

            $areaAlreadyAssigned = ExternalUser::where('user_type', 'area_manager')
                ->where('area_id', $request->area_id)
                ->where('id', '!=', $externalUser->id)
                ->exists();

            if ($areaAlreadyAssigned) {
                return response()->json([
                    'status' => false,
                    'message' => 'This area already has an area manager. Please select another area.',
                    'errors' => [
                        'area_id' => [
                            'This area is already assigned to another area manager.'
                        ]
                    ]
                ], 422);
            }

        } 
        
        if($user->user_type === 'user'){

            $user->country_id = $request->country_id;
            $user->state_id = $request->state_id;
            $user->district_id = $request->district_id;
            $user->city_id = $request->city_id;
            $user->area_id = $request->area_id;
            $user->profile_completed = true;

            $user->save();
        } else {
            
            $externalUser->country_id = $request->country_id;
            $externalUser->state_id = $request->state_id;
            $externalUser->district_id = $request->district_id;
            $externalUser->city_id = $request->city_id;
            $externalUser->area_id = $request->area_id;
            $externalUser->profile_completed = true;

            $externalUser->save();

            $user->country_id = $request->country_id;
            $user->state_id = $request->state_id;
            $user->district_id = $request->district_id;
            $user->city_id = $request->city_id;
            $user->area_id = $request->area_id;
            $user->profile_completed = true;

            $user->save();
        }

        $dashboardRoute = $this->getDashboardRoute($user);

        return response()->json([
            'status' => true,
            'message' => 'Profile completed successfully.',
            'redirect' => $dashboardRoute,
        ]);
    }

    private function getDashboardRoute($user)
    {
        switch ($user->user_type) {
            case 'area_manager':
                return route('manager.dashboard');

            case 'driver':
                return route('driver.dashboard');

            case 'car_owner':
                return route('car_owner.dashboard');

            case 'user':
            default:
                return route('user.dashboard');
        }
    }

}
