<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function user_registration(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'first_name'       => 'required|string|max:100',
                'middle_name'      => 'nullable|string|max:100',
                'last_name'        => 'required|string|max:100',
                'email'            => 'required|email|max:255|unique:users,email',
                'primary_mobile'   => 'required|digits:10|unique:users,phone_number',
                'secondary_mobile' => 'nullable|digits:10|unique:users,secondary_mobile',
                'address'          => 'required|string|max:500',
                'password'         => 'required|string|min:8|confirmed',
            ],
            [
                'first_name.required'       => 'First name is required.',
                'first_name.string'         => 'First name must be a valid name.',
                'first_name.max'            => 'First name cannot exceed 100 characters.',

                'middle_name.string'        => 'Middle name must be a valid name.',
                'middle_name.max'           => 'Middle name cannot exceed 100 characters.',

                'last_name.required'        => 'Last name is required.',
                'last_name.string'          => 'Last name must be a valid name.',
                'last_name.max'             => 'Last name cannot exceed 100 characters.',

                'email.required'            => 'Email is required.',
                'email.email'               => 'Enter a valid email.',
                'email.max'                 => 'Email cannot exceed 255 characters.',
                'email.unique'              => 'Email is already registered.',

                'primary_mobile.required'   => 'Primary mobile number is required.',
                'primary_mobile.digits'     => 'Primary mobile number must be 10 digits.',
                'primary_mobile.unique'     => 'Primary mobile number is already registered.',
                'secondary_mobile.digits'   => 'Secondary mobile number must be 10 digits.',
                'secondary_mobile.unique'   => 'Secondary mobile number is already registered.',

                'address.required'          => 'Address is required.',

                'password.required'         => 'Password is required.',
                'password.min'              => 'Password must be at least 8 characters.',
                'password.confirmed'        => 'Password confirmation does not match.',
            ]
        );

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator, 'registration')
                ->withInput()
                ->with('open_modal', 'registerModal')
                ->with('open_tab', 'register');
        }


        try {

            $user = User::create([
                'name' => collect([
                    $request->first_name,
                    $request->middle_name,
                    $request->last_name,
                ])->filter()->implode(' '),

                'first_name'       => $request->first_name,
                'middle_name'      => $request->middle_name,
                'last_name'        => $request->last_name,
                'email'            => $request->email,
                'phone_number'     => $request->primary_mobile,
                'secondary_mobile' => $request->secondary_mobile,
                'address'          => $request->address,
                'password'         => Hash::make($request->password),
                'registration_date' => date('Y-m-d'),
                'status'           => true,
            ]);

            return redirect()->back()
                ->with('success', 'Registration completed successfully.');

        } catch (\Throwable $th) {

            \Log::error('User registration failed', [
                'error' => $th->getMessage(),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('open_modal', 'registerModal')
                ->with('open_tab', 'register')
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function user_login(Request $request){

        $validator = Validator::make(
            $request->all(),
                [
                    'login_email'    => 'required|email|max:255',
                    'login_password' => 'required|string',
                ],
                [
                    'login_email.required'    => 'Email is required.',
                    'login_email.email'       => 'Enter a valid email.',

                    'login_password.required' => 'Password is required.',
                ]
        );

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator, 'login')
                ->withInput()
                ->with('open_modal', 'registerModal')
                ->with('open_tab', 'login');
        }

        $user = User::where('email', $request->login_email)
            ->first();


        if (!$user) {

            return redirect()->back()
                ->withInput()
                ->with('open_modal', 'registerModal')
                ->with('open_tab', 'login')
                ->with('login_error', 'Email is incorrect.');
        }

        if ($user->status != true) {

            return redirect()->back()
                ->withInput()
                ->with('open_modal', 'registerModal')
                ->with('open_tab', 'login')
                ->with('login_error', 'Your account is inactive. Please contact support.');
        }

        $credentials = [
            'email'    => $request->login_email,
            'password' => $request->login_password,
        ];


        if (!Auth::attempt($credentials)) {

            return redirect()->back()
                ->withInput()
                ->with('open_modal', 'registerModal')
                ->with('open_tab', 'login')
                ->with('login_error', 'Invalid email or password.');
        }

        $request->session()->regenerate();


        return redirect()->back()
            ->with('success', 'Login successful.');
    }


    public function dashboard(){
        return view('User-Dashboard.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Remove authenticated session
        $request->session()->invalidate();

        // Generate a new CSRF token
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Logged out successfully.');
    }
}
