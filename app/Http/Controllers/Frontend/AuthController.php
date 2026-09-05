<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\InternalUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function partner_registration(Request $request){
        session()->flash('open_modal', 'myModal');

        $request->validate([
            'partner_first_name' => 'required|string|max:100',

            'partner_last_name' => 'required|string|max:100',

            'partner_email' => [
                'required',
                'email',
                'max:255',
                'unique:internal_users,email',
                'unique:users,email',
            ],

            'partner_phone' => [
                'required',
                'digits:10',
                'unique:internal_users,phone_number',
                'unique:users,phone_number',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'partner_country_id' => [
                'required',
                'exists:location_countries,id',
            ],

            'partner_state_id' => [
                'required',
                'exists:location_states,id',
            ],

            'partner_district_id' => [
                'required',
                'exists:location_districts,id',
            ],

            'partner_city_id' => [
                'required',
                'exists:location_cities,id',
            ],

            'partner_area_id' => [
                'required',
                'exists:location_areas,id',

                // Only one area_manager can be assigned to an area
                Rule::unique('internal_users', 'area_id')
                    ->where(function ($query) {
                        return $query->where('user_type', 'area_manager');
                    }),
            ],

        ], [

            'partner_first_name.required' => 'First name is required.',
            'partner_last_name.required' => 'Last name is required.',

            'partner_email.required' => 'Email is required.',
            'partner_email.email' => 'Enter a valid email.',
            'partner_email.unique' => 'Email is already registered.',

            'partner_phone.required' => 'Phone number is required.',
            'partner_phone.digits' => 'Phone number must be 10 digits.',
            'partner_phone.unique' => 'Phone number is already registered.',

            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',

            'partner_country_id.required' => 'Please select a country.',
            'partner_country_id.exists' => 'Selected country is invalid.',

            'partner_state_id.required' => 'Please select a state.',
            'partner_state_id.exists' => 'Selected state is invalid.',

            'partner_district_id.required' => 'Please select a district.',
            'partner_district_id.exists' => 'Selected district is invalid.',

            'partner_city_id.required' => 'Please select a city.',
            'partner_city_id.exists' => 'Selected city is invalid.',

            'partner_area_id.required' => 'Please select an area.',
            'partner_area_id.exists' => 'Selected area is invalid.',
            'partner_area_id.unique' => 'This area is already assigned to another area manager.',
        ]);

        try {

            DB::transaction(function () use ($request) {

                $fullName = collect([
                    $request->partner_first_name,
                    $request->partner_last_name,
                ])->filter()->implode(' ');


                /*
                |--------------------------------------------------------------------------
                | Create Internal User
                |--------------------------------------------------------------------------
                */

                InternalUser::create([
                    'first_name'   => $request->partner_first_name,
                    'last_name'    => $request->partner_last_name,
                    'email'        => $request->partner_email,
                    'phone_number' => $request->partner_phone,
                    'password'     => Hash::make($request->password),

                    'country_id'   => $request->partner_country_id,
                    'state_id'     => $request->partner_state_id,
                    'district_id'  => $request->partner_district_id,
                    'city_id'      => $request->partner_city_id,
                    'area_id'      => $request->partner_area_id,

                    'user_type'    => 'area_manager',
                    'status'       => 0,
                ]);


                /*
                |--------------------------------------------------------------------------
                | Create Login User
                |--------------------------------------------------------------------------
                */

                User::create([
                    'name'              => $fullName,
                    'first_name'        => $request->partner_first_name,
                    'last_name'         => $request->partner_last_name,
                    'email'             => $request->partner_email,
                    'phone_number'      => $request->partner_phone,
                    'password'          => Hash::make($request->password),
                    'registration_date' => now()->format('Y-m-d'),
                    'status'            => 0,
                    'user_type'         => 'area_manager',
                ]);
            });


            return redirect()
                ->back()
                ->with('success', 'Registration completed successfully.');


        } catch (\Throwable $th) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function driver_registration(Request $request){

        session()->flash('open_modal', 'driverModal');

        $request->validate([
            'driver_first_name' => 'required|string|max:100',
            'driver_last_name'  => 'required|string|max:100',
            'driver_email'      => 'required|email|max:255|unique:drivers,email',
            'driver_phone'      => 'required|digits:10|unique:drivers,phone_number',

            'driver_country_id'  => 'required|exists:countries,id',
            'driver_state_id'    => 'required|exists:states,id',
            'driver_district_id' => 'required|exists:districts,id',
            'driver_city_id'     => 'required|exists:cities,id',
            'driver_area_id'     => 'required|exists:areas,id',
        ],
        [
            'driver_first_name.required' => 'First name is required.',
            'driver_last_name.required'  => 'Last name is required.',
            'driver_email.required'      => 'Email is required.',
            'driver_email.email'         => 'Enter a valid email.',
            'driver_phone.unique'        => 'Email is already registered.',
            'driver_phone.required'      => 'Phone number is required.',
            'driver_phone.digits'        => 'Phone number must be 10 digits.',
            'driver_phone.unique'        => 'Phone number is already registered.',
            'driver_country_id.required' => 'Please select a country.',
            'driver_state_id.required'   => 'Please select a state.',
            'driver_district_id.required'=> 'Please select a district.',
            'driver_city_id.required'    => 'Please select a city.',
            'driver_area_id.required'    => 'Please select an area.',
        ]);

        try {

            $areaManagerId = AreaManager::where('country_id',$request->driver_country_id)
                    ->where('state_id',$request->driver_state_id)
                    ->where('district_id',$request->driver_district_id)
                    ->where('city_id',$request->driver_city_id)
                    ->where('area_id',$request->driver_area_id)->value('id');

            Driver::create([
                'first_name'    => $request->driver_first_name,
                'last_name'     => $request->driver_last_name,
                'email'         => $request->driver_email,
                'phone_number'  => $request->driver_phone,

                'country_id'    => $request->driver_country_id,
                'state_id'      => $request->driver_state_id,
                'district_id'   => $request->driver_district_id,
                'city_id'       => $request->driver_city_id,
                'area_id'       => $request->driver_area_id,
                'area_manager_id'       => $areaManagerId,
                'status'        => 0,
            ]);

            return redirect()->back()->with(
                'success',
                'Registration completed successfully.'
            );

        } catch (\Throwable $th) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}
