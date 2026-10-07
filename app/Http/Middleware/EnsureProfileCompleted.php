<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('web')->user();

        /*
        |--------------------------------------------------------------------------
        | Not logged in
        |--------------------------------------------------------------------------
        */

        if (!$user) {
            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | Profile already completed
        |--------------------------------------------------------------------------
        */

        if ($user->profile_completed) {
            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | Allow dashboard
        |
        | Dashboard will show the mandatory modal.
        |--------------------------------------------------------------------------
        */

        $dashboardRoutes = [
            'user.dashboard',
            'manager.dashboard',
            'driver.dashboard',
            'car_owner.dashboard',
        ];

        if ($request->routeIs($dashboardRoutes)) {
            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | Allow profile completion routes
        |--------------------------------------------------------------------------
        */

        if ($request->routeIs('profile.complete')) {
            return $next($request);
        }

        if ($request->routeIs('profile.complete.update')) {
            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | Incomplete profile
        |
        | Always send the user to their own dashboard.
        |--------------------------------------------------------------------------
        */

        switch ($user->user_type) {

            case 'area_manager':

                return redirect()->route(
                    'manager.dashboard'
                );

            case 'driver':

                return redirect()->route(
                    'driver.dashboard'
                );

            case 'car_owner':

                return redirect()->route(
                    'car_owner.dashboard'
                );

            case 'user':
            default:

                return redirect()->route(
                    'user.dashboard'
                );
        }
    }
}
