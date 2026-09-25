<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\LoginOtpMail;
use App\Mail\RegistrationOtpMail;
use App\Mail\RegistrationPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

    public function sendUserRegistrationOtp(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'first_name'       => 'required|string|max:100',
                'middle_name'      => 'nullable|string|max:100',
                'last_name'        => 'required|string|max:100',
                'email'            => 'required|email|max:255',
                'primary_mobile'   => 'required|digits:10',
                'secondary_mobile' => 'nullable|digits:10',
            ],
            [
                'first_name.required' => 'First name is required.',
                'last_name.required'  => 'Last name is required.',
                'email.required'      => 'Email is required.',
                'email.email'         => 'Enter a valid email.',
                'primary_mobile.required' => 'Primary mobile number is required.',
                'primary_mobile.digits'   => 'Primary mobile number must be 10 digits.',
                'secondary_mobile.digits' => 'Secondary mobile number must be 10 digits.',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $email = strtolower(trim($request->email));

        if (User::where('email', $email)->exists()) {

            return response()->json([
                'status' => false,
                'message' => 'This email is already registered.'
            ], 422);
        }

        if (User::where('phone_number', $request->primary_mobile)->exists()) {

            return response()->json([
                'status' => false,
                'message' => 'This primary mobile number is already registered.'
            ], 422);
        }

        $otp = random_int(100000, 999999);

        session([
            'user_registration' => [

                'first_name'       => $request->first_name,
                'middle_name'      => $request->middle_name,
                'last_name'        => $request->last_name,
                'email'            => $email,
                'phone_number'     => $request->primary_mobile,
                'secondary_mobile' => $request->secondary_mobile,

            ],

            'user_registration_otp' => [
                'otp'        => Hash::make($otp),
                'expires_at' => now()->addMinutes(10)->timestamp,
                'attempts'   => 0,

            ],
        ]);


        try {

            Mail::to($email)->send(
                new RegistrationOtpMail(
                    $email,
                    $otp,
                    $request->first_name
                )
            );

        } catch (\Exception $e) {
            session()->forget([
                'user_registration',
                'user_registration_otp'
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Unable to send OTP. Please try again.'
            ], 500);
        }

        return response()->json([
            'status'  => true,
            'email'   => $email,
            'message' => 'OTP has been sent to your email address.'
        ]);
    }

    public function verifyUserRegistrationOtp(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'otp' => 'required|digits:6',
            ],
            [
                'otp.required' => 'OTP is required.',
                'otp.digits'   => 'OTP must be 6 digits.',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first('otp'),
            ], 422);
        }


        $registration = session('user_registration');

        $otpData = session('user_registration_otp');


        if (!$registration || !$otpData) {

            return response()->json([
                'status' => false,
                'message' => 'Registration session expired. Please register again.'
            ], 422);
        }

        if (now()->timestamp > $otpData['expires_at']) {

            session()->forget([
                'user_registration',
                'user_registration_otp'
            ]);

            return response()->json([
                'status' => false,
                'message' => 'OTP has expired. Please register again.'
            ], 422);
        }

        if (($otpData['attempts'] ?? 0) >= 5) {

            session()->forget([
                'user_registration',
                'user_registration_otp'
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Too many incorrect attempts. Please register again.'
            ], 429);
        }

        if (!Hash::check($request->otp, $otpData['otp'])) {

            $otpData['attempts'] =
                ($otpData['attempts'] ?? 0) + 1;

            session([
                'user_registration_otp' => $otpData
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP. Please enter the correct OTP.'
            ], 422);
        }

        $password = Str::random(10);
        $user = User::create([

            'name' => collect([
                    $registration['first_name'],
                    $registration['middle_name'],
                    $registration['last_name'],
                ])->filter()->implode(' '),
            'first_name'       => $registration['first_name'],
            'middle_name'      => $registration['middle_name'],
            'last_name'        => $registration['last_name'],
            'email'            => $registration['email'],
            'phone_number'     => $registration['phone_number'],
            'secondary_mobile' => $registration['secondary_mobile'],
            'password'         => Hash::make($password),
            'user_type'        => 'user',
            'status'           => 1,
            'email_verified_at' => now(),

        ]);

        Mail::to($user->email)
                ->send(new RegistrationPasswordMail(
                    $user,
                    $password
                ));

        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        session()->forget([
            'user_registration',
            'user_registration_otp'
        ]);

        $redirectUserUrl = route('user.dashboard');


        return response()->json([

            'status' => true,
            'message' => 'Registration successful. Welcome!',
            'user_type' => $user->user_type,
            'email' => $user->email,
            'redirectUserUrl' => $redirectUserUrl,

        ]);
    }

    public function resendUserRegistrationOtp(Request $request)
    {
        $email = strtolower(trim($request->email));

        $registration = session('user_registration');

        if (!$registration) {

            return response()->json([
                'status' => false,
                'message' => 'Registration session expired. Please register again.'
            ], 422);
        }

        if ($registration['email'] !== $email) {

            return response()->json([
                'status' => false,
                'message' => 'Invalid registration request.'
            ], 422);
        }

        $otp = random_int(100000, 999999);

        session([
            'user_registration_otp' => [
                'otp'        => Hash::make($otp),
                'expires_at' => now()->addMinutes(10)->timestamp,
                'attempts'   => 0,
            ]
        ]);

        try {

            Mail::to($email)->send(
                new RegistrationOtpMail(
                    $email,
                    $otp,
                    $registration['first_name']
                )
            );

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Unable to send OTP. Please try again.'
            ], 500);
        }

        return response()->json([
            'status' => true,
            'email' => $email,
            'message' => 'A new OTP has been sent to your email address.'
        ]);
    }

    public function user_login(Request $request)
    {
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

        $email = strtolower(trim($request->login_email));

        $user = User::where('email', $email)->first();

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
                ->with(
                    'login_error',
                    'Your account is inactive. Please contact support.'
                );
        }

        $credentials = [
            'email'    => $email,
            'password' => $request->login_password,
        ];

        if (!Auth::attempt($credentials)) {

            return redirect()->back()
                ->withInput()
                ->with('open_modal', 'registerModal')
                ->with('open_tab', 'login')
                ->with('login_error', 'Invalid email or password.');
        }

        /*
        |--------------------------------------------------------------------------
        | Regenerate session after login
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | Redirect according to user type
        |--------------------------------------------------------------------------
        */

        $redirectUrl = $this->getDashboardUrl($user->user_type);

        return redirect()->to($redirectUrl)
            ->with('success', 'Login successful.');
    }

    public function sendLoginOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
            ],
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first('email'),
            ], 422);
        }

        $email = strtolower(trim($request->email));

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'No account found with this email address.',
            ], 404);
        }

        if (isset($user->status) && !$user->status) {
            return response()->json([
                'status' => false,
                'message' => 'Your account is inactive. Please contact support.',
            ], 403);
        }

        $otp = random_int(100000, 999999);

        session([
            'login_otp' => [
                'email' => $email,
                'otp' => Hash::make($otp),
                'expires_at' => now()->addMinutes(10),
                'attempts' => 0,
            ],
        ]);

        try {

            Mail::to($email)->send(
                new LoginOtpMail(
                    $email,
                    $otp,
                    $user->first_name ?? $user->name ?? 'User'
                )
            );

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Unable to send OTP. Please try again.',
            ], 500);
        }

        return response()->json([
            'status' => true,
            'email' => $email,
            'message' => 'OTP has been sent to your email address.',
        ]);
    }

    public function verifyLoginOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login_email' => 'required|email',
            'login_otp' => 'required|digits:6',
        ], [
            'login_email.required' => 'Email address is required.',
            'login_email.email' => 'Please enter a valid email address.',
            'login_otp.required' => 'Please enter the OTP.',
            'login_otp.digits' => 'OTP must be 6 digits.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $email = strtolower(trim($request->login_email));
        $otp = trim($request->login_otp);

        /*
        |--------------------------------------------------------------------------
        | Get session OTP
        |--------------------------------------------------------------------------
        */

        $loginOtp = session('login_otp');

        if (!$loginOtp) {
            return response()->json([
                'status' => false,
                'message' => 'OTP session has expired. Please request a new OTP.',
            ], 422);
        }

        if ($loginOtp['email'] !== $email) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP request.',
            ], 422);
        }

        if (now()->greaterThan($loginOtp['expires_at'])) {

            session()->forget('login_otp');

            return response()->json([
                'status' => false,
                'message' => 'OTP has expired. Please request a new OTP.',
            ], 422);
        }

        if (($loginOtp['attempts'] ?? 0) >= 5) {

            session()->forget('login_otp');

            return response()->json([
                'status' => false,
                'message' => 'Too many incorrect attempts. Please request a new OTP.',
            ], 429);
        }

        if (!Hash::check($otp, $loginOtp['otp'])) {

            $loginOtp['attempts'] =
                ($loginOtp['attempts'] ?? 0) + 1;

            session([
                'login_otp' => $loginOtp,
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP. Please enter the correct OTP.',
            ], 422);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {

            session()->forget('login_otp');

            return response()->json([
                'status' => false,
                'message' => 'User account not found.',
            ], 404);
        }

        if (isset($user->status) && !$user->status) {

            session()->forget('login_otp');

            return response()->json([
                'status' => false,
                'message' => 'Your account is inactive. Please contact support.',
            ], 403);
        }

        Auth::guard('web')->login($user);
        session()->forget('login_otp');

        $redirect = $this->getDashboardUrl($user->user_type);

        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'user_type' => $user->user_type,
            'email' => $user->email,
            'redirectUserUrl' => $redirect,
        ]);
    }

    public function resendLoginOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = strtolower(trim($request->email));

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'No account found with this email address.',
            ], 404);
        }

        if (isset($user->status) && !$user->status) {
            return response()->json([
                'status' => false,
                'message' => 'Your account is inactive.',
            ], 403);
        }

        $otp = random_int(100000, 999999);

        session([
            'login_otp' => [
                'email' => $email,
                'otp' => Hash::make($otp),
                'expires_at' => now()->addMinutes(10),
                'attempts' => 0,
            ],
        ]);

        try {

            Mail::to($email)->send(
                new LoginOtpMail(
                    $email,
                    $otp,
                    $user->first_name ?? $user->name ?? 'User'
                )
            );

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Unable to resend OTP. Please try again.',
            ], 500);
        }

        return response()->json([
            'status' => true,
            'email' => $email,
            'message' => 'A new OTP has been sent to your email.',
        ]);
    }

    private function getDashboardUrl($userType)
    {
        switch ($userType) {

            case 'area_manager':
                return route('manager.dashboard');

            // case 'driver':
            //     return route('driver.dashboard');

            // case 'car_owner':
            //     return route('carowner.dashboard');

            case 'user':
            default:
                return route('user.dashboard');
        }
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
