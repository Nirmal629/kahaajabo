<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ExternalUser;
use Illuminate\Http\Request;
use App\Mail\RegistrationPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    public function redirect(Request $request){
        $type = $request->query('type', 'login');

        $allowedTypes = [
            'login',
            'user',
            'partner',
            'car_owner',
            'driver',
        ];

        if (!in_array($type, $allowedTypes, true)) {
            abort(400, 'Invalid Google authentication type.');
        }

        session(['google_auth_type' => $type]);

        return Socialite::driver('google')->redirect();
    }
    /**
     * Handle Google callback.
     */
    /**
     * Handle Google callback for:
     * Regular User, Partner, Car Owner, Driver and Login.
     */
    public function callback(Request $request)
    {
        $createdUser = null;
        $createdExternalUser = null;

        try {
            /*
            |--------------------------------------------------------------------------
            | 1. Get Google account details
            |--------------------------------------------------------------------------
            */

            $googleUser = Socialite::driver('google')->user();

            $googleData = $googleUser->getRaw();

            $email = $googleUser->getEmail();

            // Google must provide a verified email.
            if (
                !$email ||
                ($googleData['email_verified'] ?? false) !== true
            ) {
                return redirect('/')->with(
                    'error',
                    'Please use a verified Google email.'
                );
            }

            $email = strtolower(trim($email));

            $fullName = trim($googleUser->getName() ?? '');

            $firstName = $googleData['given_name']
                ?? Str::before($fullName, ' ');

            $lastName = $googleData['family_name']
                ?? trim(Str::after($fullName, ' '));

            $firstName = $firstName ?: 'Google';
            $lastName = $lastName ?: 'User';

            /*
            |--------------------------------------------------------------------------
            | 2. Identify Google authentication type
            |--------------------------------------------------------------------------
            */

            $authType = session()->pull('google_auth_type', 'login');

            /*
            |--------------------------------------------------------------------------
            | 3. Regular User Google Registration
            |--------------------------------------------------------------------------
            */

            if ($authType === 'user') {

                // Check both tables to prevent duplicate accounts.
                if (
                    User::where('email', $email)->exists() ||
                    ExternalUser::where('email', $email)->exists()
                ) {
                    return redirect('/')->with(
                        'error',
                        'An account already exists with this Google email. Please log in instead.'
                    );
                }

                $password = Str::random(10);

                try {

                    // Create the regular user in the users table.
                    $createdUser = User::create([
                        'name' => trim($firstName . ' ' . $lastName),
                        'first_name' => $firstName,
                        'middle_name' => null,
                        'last_name' => $lastName,
                        'email' => $email,

                        // Complete these details through your profile form.
                        'phone_number' => null,
                        'secondary_mobile' => null,
                        'address' => null,

                        'password' => Hash::make($password),
                        'user_type' => 'user',
                        'status' => 1,
                        'email_verified_at' => now(),
                        'registration_date' => now()->toDateString(),
                    ]);

                    // Send the registration password email.
                    Mail::to($createdUser->email)->send(
                        new RegistrationPasswordMail(
                            $createdUser,
                            $password
                        )
                    );

                } catch (Throwable $mailException) {

                    // Remove the account if registration fails
                    // or the required email cannot be sent.
                    if ($createdUser) {
                        try {
                            $createdUser->delete();
                        } catch (Throwable $cleanupException) {
                            Log::error(
                                'Google user registration cleanup failed.',
                                [
                                    'error' => $cleanupException->getMessage(),
                                ]
                            );
                        }
                    }

                    throw $mailException;
                }

                // Log in as a regular user.
                Auth::guard('web')->login($createdUser);

                $request->session()->regenerate();

                // Use your existing dashboard route.
                return redirect()->route('user.dashboard');
            }

            /*
            |--------------------------------------------------------------------------
            | 4. Partner, Car Owner and Driver Google Registration
            |--------------------------------------------------------------------------
            */

            if (in_array(
                $authType,
                ['partner', 'car_owner', 'driver'],
                true
            )) {

                $userType = match ($authType) {
                    'partner' => 'area_manager',
                    'car_owner' => 'car_owner',
                    'driver' => 'driver',
                };

                // Prevent duplicate accounts in either table.
                if (
                    User::where('email', $email)->exists() ||
                    ExternalUser::where('email', $email)->exists()
                ) {
                    return redirect('/')->with(
                        'error',
                        'An account already exists with this Google email. Please use Google login instead.'
                    );
                }

                $password = Str::random(10);

                /*
                * Create both records in one transaction.
                */
                DB::transaction(function () use (
                    $email,
                    $firstName,
                    $lastName,
                    $userType,
                    $password,
                    &$createdUser,
                    &$createdExternalUser
                ) {

                    $createdExternalUser = ExternalUser::create([
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'email' => $email,
                        'phone_number' => null,
                        'user_type' => $userType,
                        'status' => 1,
                        'otp_verified_status' => 1,
                        'otp' => null,
                        'otp_expires_at' => null,
                        'otp_attempts' => 0,
                    ]);

                    $createdUser = User::create([
                        'name' => trim($firstName . ' ' . $lastName),
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'email' => $email,
                        'phone_number' => null,
                        'password' => Hash::make($password),
                        'user_type' => $userType,
                        'status' => 1,
                    ]);
                });

                /*
                * Send registration password email.
                */
                try {

                    Mail::to($createdUser->email)->send(
                        new RegistrationPasswordMail(
                            $createdUser,
                            $password
                        )
                    );

                } catch (Throwable $mailException) {

                    // Roll back the registration records if email fails.
                    try {
                        DB::transaction(function () use (
                            $createdUser,
                            $createdExternalUser
                        ) {
                            if ($createdUser) {
                                $createdUser->delete();
                            }

                            if ($createdExternalUser) {
                                $createdExternalUser->delete();
                            }
                        });
                    } catch (Throwable $cleanupException) {
                        Log::error(
                            'Google partner registration cleanup failed.',
                            [
                                'error' => $cleanupException->getMessage(),
                            ]
                        );
                    }

                    throw $mailException;
                }

                // Log in through your existing web guard.
                Auth::guard('web')->login($createdUser);

                $request->session()->regenerate();

                // Select the correct dashboard.
                $dashboardRoute = match ($userType) {
                    'area_manager' => 'manager.dashboard',
                    'car_owner' => 'car_owner.dashboard',
                    'driver' => 'driver.dashboard',
                };

                return redirect('/')
                    ->with('google_partner_registration_success', true)
                    ->with(
                        'google_partner_redirect',
                        route($dashboardRoute)
                    )
                    ->with('google_registered_type', $userType);
            }

            /*
            |--------------------------------------------------------------------------
            | 5. Normal Google Login
            |--------------------------------------------------------------------------
            */

            $user = User::where('email', $email)->first();

            if (!$user) {

                if (ExternalUser::where('email', $email)->exists()) {
                    return redirect('/')->with(
                        'error',
                        'Your account is not linked to a login profile. Please contact support.'
                    );
                }

                return redirect('/')->with(
                    'error',
                    'Account not found. Please register first.'
                );
            }

            // Redirect according to the existing account type.
            $dashboard = match ($user->user_type) {
                'user' => 'user.dashboard',
                'area_manager' => 'manager.dashboard',
                'driver' => 'driver.dashboard',
                'car_owner' => 'car_owner.dashboard',
                default => null,
            };

            if (!$dashboard) {
                return redirect('/')->with(
                    'error',
                    'Your account type is not supported for Google login.'
                );
            }

            if (!$user->status) {
                return redirect('/')->with(
                    'error',
                    'Your account is inactive. Please contact support.'
                );
            }

            Auth::guard('web')->login($user);

            $request->session()->regenerate();

            return redirect()->route($dashboard);

        } catch (Throwable $e) {

            Log::error('Google authentication failed.', [
                'error' => $e->getMessage(),
            ]);

            return redirect('/')->with(
                'error',
                'Google login or registration failed. Please try again.'
            );
        }
    }
}
