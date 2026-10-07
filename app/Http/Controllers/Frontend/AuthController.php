<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ExternalUser;
use App\Mail\SignupOtpMail;
use App\Mail\RegistrationPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    
    public function partner_registration(Request $request){

        $request->validate([
            'partner_first_name' => 'required|string|max:100',
            'partner_last_name'  => 'required|string|max:100',

            'partner_email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('external_users', 'email')
                    ->where(function ($query) {
                        $query->where('otp_verified_status', 1);
                    }),
                Rule::unique('users', 'email'),
            ],

            'partner_phone' => [
                'required',
                'digits:10',
                Rule::unique('external_users', 'phone_number')
                    ->where(function ($query) {
                        $query->where('otp_verified_status', 1);
                    }),
                Rule::unique('users', 'phone_number'),
            ],

        ], [

            'partner_first_name.required' => 'First name is required.',
            'partner_last_name.required'  => 'Last name is required.',

            'partner_email.required' => 'Email is required.',
            'partner_email.email'    => 'Enter a valid email.',
            'partner_email.unique'   => 'Email is already registered.',

            'partner_phone.required' => 'Phone number is required.',
            'partner_phone.digits'   => 'Phone number must be 10 digits.',
            'partner_phone.unique'   => 'Phone number is already registered.',
        ]);

        $otp = (string) random_int(100000, 999999);

        $externalUser = null;

        try {

            $externalUser = DB::transaction(function () use ($request, $otp) {

                $existingUser = ExternalUser::where('email', $request->partner_email)
                    ->where('otp_verified_status', 0)
                    ->first();


                if ($existingUser) {

                    $existingUser->update([
                        'first_name'     => $request->partner_first_name,
                        'last_name'      => $request->partner_last_name,
                        'phone_number'   => $request->partner_phone,
                        'user_type'      => 'area_manager',
                        'otp'            => Hash::make($otp),
                        'otp_expires_at' => now()->addMinutes(5),
                        'otp_attempts'   => 0,
                    ]);

                    return $existingUser;
                }

                return ExternalUser::create([
                    'first_name'     => $request->partner_first_name,
                    'last_name'      => $request->partner_last_name,
                    'email'          => $request->partner_email,
                    'phone_number'   => $request->partner_phone,
                    'user_type'      => 'area_manager',
                    'status'         => 0,
                    'otp_verified_status'         => 0,
                    'otp'            => Hash::make($otp),
                    'otp_expires_at' => now()->addMinutes(5),
                    'otp_attempts'   => 0,
                ]);
            });

            Mail::to($request->partner_email)
                ->send(
                    new SignupOtpMail($otp)
                );


        } catch (\Throwable $e) {

            if ($externalUser) {

                try {

                    $externalUser->delete();

                } catch (\Throwable $deleteException) {

                    Log::error(
                        'Failed to delete temporary registration',
                        [
                            'email' => $request->partner_email,
                            'error' => $deleteException->getMessage(),
                        ]
                    );
                }
            }

            Log::error(
                'Signup OTP email failed',
                [
                    'email' => $request->partner_email,
                    'error' => $e->getMessage(),
                ]
            );

            return response()->json([
                'status' => false,
                'message' =>
                    'Unable to send OTP to your email. '
                    . 'Registration could not be completed. '
                    . 'Please try again.',
            ], 500);
        }

        return response()->json([
            'status'  => true,
            'message' => 'OTP has been sent to your email address.',
            'email'   => $request->partner_email,
        ]);
    }

    public function driver_registration(Request $request){

           $request->validate([
            'driver_first_name' => 'required|string|max:100',
            'driver_last_name'  => 'required|string|max:100',

            'driver_email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('external_users', 'email')
                    ->where(function ($query) {
                        $query->where('otp_verified_status', 1);
                    }),
                Rule::unique('users', 'email'),
            ],

            'driver_phone' => [
                'required',
                'digits:10',
                Rule::unique('external_users', 'phone_number')
                    ->where(function ($query) {
                        $query->where('otp_verified_status', 1);
                    }),
                Rule::unique('users', 'phone_number'),
            ],

        ], [

            'driver_first_name.required' => 'First name is required.',
            'driver_last_name.required'  => 'Last name is required.',

            'driver_email.required' => 'Email is required.',
            'driver_email.email'    => 'Enter a valid email.',
            'driver_email.unique'   => 'Email is already registered.',

            'driver_phone.required' => 'Phone number is required.',
            'driver_phone.digits'   => 'Phone number must be 10 digits.',
            'driver_phone.unique'   => 'Phone number is already registered.',
        ]);

        $otp = (string) random_int(100000, 999999);

        $externalUser = null;

        try {

            $externalUser = DB::transaction(function () use ($request, $otp) {

                $existingUser = ExternalUser::where('email', $request->driver_email)
                    ->where('otp_verified_status', 0)
                    ->first();


                if ($existingUser) {

                    $existingUser->update([
                        'first_name'     => $request->driver_first_name,
                        'last_name'      => $request->driver_last_name,
                        'phone_number'   => $request->driver_phone,
                        'user_type'      => 'driver',
                        'otp'            => Hash::make($otp),
                        'otp_expires_at' => now()->addMinutes(5),
                        'otp_attempts'   => 0,
                    ]);

                    return $existingUser;
                }

                return ExternalUser::create([
                    'first_name'        => $request->driver_first_name,
                    'last_name'         => $request->driver_last_name,
                    'email'             => $request->driver_email,
                    'phone_number'      => $request->driver_phone,
                    'user_type'         => 'driver',
                    'status'            => 0,
                    'otp_verified_status'  => 0,
                    'otp'               => Hash::make($otp),
                    'otp_expires_at'    => now()->addMinutes(5),
                    'otp_attempts'      => 0,
                ]);
            });

            Mail::to($request->driver_email)
                ->send(
                    new SignupOtpMail($otp)
                );


        } catch (\Throwable $e) {

            if ($externalUser) {

                try {

                    $externalUser->delete();

                } catch (\Throwable $deleteException) {

                    Log::error(
                        'Failed to delete temporary registration',
                        [
                            'email' => $request->driver_email,
                            'error' => $deleteException->getMessage(),
                        ]
                    );
                }
            }

            Log::error(
                'Signup OTP email failed',
                [
                    'email' => $request->driver_email,
                    'error' => $e->getMessage(),
                ]
            );

            return response()->json([
                'status' => false,
                'message' =>
                    'Unable to send OTP to your email. '
                    . 'Registration could not be completed. '
                    . 'Please try again.',
            ], 500);
        }
        return response()->json([
            'status'  => true,
            'message' => 'OTP has been sent to your email address.',
            'email'   => $request->driver_email,
        ]);
    }


    public function car_owner_registration(Request $request){

        $request->validate([
            'carOwner_first_name' => 'required|string|max:100',
            'carOwner_last_name'  => 'required|string|max:100',

            'carOwner_email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('external_users', 'email')
                    ->where(function ($query) {
                        $query->where('otp_verified_status', 1);
                    }),
                Rule::unique('users', 'email'),
            ],

            'carOwner_phone' => [
                'required',
                'digits:10',
                Rule::unique('external_users', 'phone_number')
                    ->where(function ($query) {
                        $query->where('otp_verified_status', 1);
                    }),
                Rule::unique('users', 'phone_number'),
            ],

        ], [

            'carOwner_first_name.required' => 'First name is required.',
            'carOwner_last_name.required'  => 'Last name is required.',

            'carOwner_email.required' => 'Email is required.',
            'carOwner_email.email'    => 'Enter a valid email.',
            'carOwner_email.unique'   => 'Email is already registered.',

            'carOwner_phone.required' => 'Phone number is required.',
            'carOwner_phone.digits'   => 'Phone number must be 10 digits.',
            'carOwner_phone.unique'   => 'Phone number is already registered.',
        ]);

        $otp = (string) random_int(100000, 999999);

        $externalUser = null;

        try {

            $externalUser = DB::transaction(function () use ($request, $otp) {

                $existingUser = ExternalUser::where('email', $request->carOwner_email)
                    ->where('otp_verified_status', 0)
                    ->first();


                if ($existingUser) {

                    $existingUser->update([
                        'first_name'     => $request->carOwner_first_name,
                        'last_name'      => $request->carOwner_last_name,
                        'phone_number'   => $request->carOwner_phone,
                        'user_type'      => 'car_owner',
                        'otp'            => Hash::make($otp),
                        'otp_expires_at' => now()->addMinutes(5),
                        'otp_attempts'   => 0,
                    ]);

                    return $existingUser;
                }

                return ExternalUser::create([
                    'first_name'        => $request->carOwner_first_name,
                    'last_name'         => $request->carOwner_last_name,
                    'email'             => $request->carOwner_email,
                    'phone_number'      => $request->carOwner_phone,
                    'user_type'         => 'car_owner',
                    'status'            => 0,
                    'otp_verified_status'  => 0,
                    'otp'               => Hash::make($otp),
                    'otp_expires_at'    => now()->addMinutes(5),
                    'otp_attempts'      => 0,
                ]);
            });

            Mail::to($request->carOwner_email)
                ->send(
                    new SignupOtpMail($otp)
                );


        } catch (\Throwable $e) {

            if ($externalUser) {

                try {

                    $externalUser->delete();

                } catch (\Throwable $deleteException) {

                    Log::error(
                        'Failed to delete temporary registration',
                        [
                            'email' => $request->carOwner_email,
                            'error' => $deleteException->getMessage(),
                        ]
                    );
                }
            }

            Log::error(
                'Signup OTP email failed',
                [
                    'email' => $request->carOwner_email,
                    'error' => $e->getMessage(),
                ]
            );

            return response()->json([
                'status' => false,
                'message' =>
                    'Unable to send OTP to your email. '
                    . 'Registration could not be completed. '
                    . 'Please try again.',
            ], 500);
        }
        return response()->json([
            'status'  => true,
            'message' => 'OTP has been sent to your email address.',
            'email'   => $request->carOwner_email,
        ]);
    }


    public function verify_otp(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'otp' => ['required','digits:6'],
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email.',
            'otp.required' => 'Please enter the OTP.',
            'otp.digits' => 'OTP must be 6 digits.',
        ]);


        try {

            $externalUser = ExternalUser::where( 'email', $request->email)->first();

            if (!$externalUser) {
                return response()->json([
                    'status' => false,
                    'message' => 'Registration details not found.'
                ], 404);
            }

            if ($externalUser->status == 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'This account is already verified.'
                ], 422);
            }

            if (
                !$externalUser->otp_expires_at ||
                now()->greaterThan(
                    $externalUser->otp_expires_at
                )
            ) {
                return response()->json([
                    'status' => false,
                    'message' => 'OTP has expired. Please request a new OTP.'
                ], 422);
            }

            if ($externalUser->otp_attempts >= 5) {
                return response()->json([
                    'status' => false,
                    'message' => 'Too many incorrect attempts. Please request a new OTP.'
                ], 422);
            }

            if (
                !Hash::check(
                    $request->otp,
                    $externalUser->otp
                )
            ) {

                $externalUser->increment('otp_attempts');
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid OTP. Please try again.'
                ], 422);
            }

            DB::beginTransaction();

            $userType = $externalUser->user_type ?? 'area_manager';

            $userexists = User::where('email', $externalUser->email)->first();

            if (!$userexists) {

                $password = Str::random(10);
                $user = User::create([
                    'name'   => collect([
                                    $externalUser->first_name,
                                    $externalUser->last_name,
                                ])->filter()->implode(' '),
                    'first_name'   => $externalUser->first_name,
                    'last_name'    => $externalUser->last_name,
                    'email'        => $externalUser->email,
                    'phone_number' => $externalUser->phone_number,
                    'password'     => Hash::make($password),
                    'user_type'    => $userType,
                    'status'       => 1,

                ]);

                Mail::to($user->email)
                    ->send(new RegistrationPasswordMail(
                        $user,
                        $password
                    ));
            }

            $externalUser->update([
                'status' => 1,
                'otp_verified_status' => 1,
                'otp' => null,
                'otp_expires_at' => null,
                'otp_attempts' => 0,
            ]);


            Auth::guard('web')->login($user);

            $request->session()->regenerate();

            DB::commit();

            $redirect = $this->getDashboardUrl(
                $userType
            );

            return response()->json([
                'status' => true,
                'user_type' => $userType,
                'email' => $user->email,
                'message' => 'Your account has been successfully verified.',
                // 'redirect' => route('home.index'),
                'redirectUserUrl' =>  $redirect,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }

    public function resend_otp(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
        ]);

        try {
            $externalUser = ExternalUser::where('email', $request->email)->first();

            if (!$externalUser) {
                return response()->json([
                    'status' => false,
                    'message' =>  'Registration details not found.'
                ], 404);
            }


            if ($externalUser->status == 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'This account is already verified.'
                ], 422);
            }

            $otp = (string) random_int(
                100000,
                999999
            );

            $externalUser->update([
                'otp' => Hash::make($otp),
                'otp_expires_at' => now()->addMinutes(5),
                'otp_attempts' => 0,
            ]);

            Mail::to($externalUser->email)
                ->send(
                    new SignupOtpMail($otp)
                );

            return response()->json([
                'status' => true,
                'message' => 'A new OTP has been sent to your email address.',
            ]);


        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Unable to send OTP. Please try again.',
            ], 500);
        }
    }


    private function getDashboardUrl($userType)
    {
        switch ($userType) {

            case 'user':
                return route('user.dashboard');

            case 'area_manager':
                return route('manager.dashboard');

            case 'driver':
                return route('driver.dashboard');

            case 'car_owner':
                return route('car_owner.dashboard');

            default:
                return route('home.index');
        }
    }
}
