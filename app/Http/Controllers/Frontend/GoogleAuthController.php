<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ExternalUser;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $googleData = $googleUser->getRaw();

            // Require a verified Google email
            if (
                !$googleUser->getEmail() ||
                ($googleData['email_verified'] ?? false) !== true
            ) {
                return redirect('/')
                    ->with('error', 'Please use a verified Google email.');
            }

            $email = $googleUser->getEmail();

            // First check the main users table
            $user = User::where('email', $email)->first();

            if (!$user) {
                // Check whether this email belongs to an external user
                $externalUser = ExternalUser::where(
                    'email',
                    $email
                )->first();

                if (!$externalUser) {
                    return redirect('/')
                        ->with(
                            'error',
                            'Account not found. Please register first.'
                        );
                }

                // Your existing authentication flow must have a
                // corresponding User record for dashboard access.
                return redirect('/')
                    ->with(
                        'error',
                        'Your account needs to be linked to your login profile. Please contact support.'
                    );
            }

            // Resolve the user's dashboard from the stored account type
            $dashboard = match ($user->user_type) {
                'user'        => 'user.dashboard',
                'area_manager' => 'manager.dashboard',
                'driver'      => 'driver.dashboard',
                'car_owner'   => 'car_owner.dashboard',
                default       => 'home.index',
            };

            if (!$dashboard) {
                return redirect('/')
                    ->with('error', 'Unsupported account type.');
            }

            // Use the guard expected by your existing dashboard routes
            Auth::guard('web')->login($user);

            request()->session()->regenerate();

            // Respect your profile-completion middleware
            return redirect()->route($dashboard);

        } catch (Throwable $e) {
            report($e);

            return redirect('/')
                ->with('error', 'Google login failed. Please try again.');
        }
    }
}
