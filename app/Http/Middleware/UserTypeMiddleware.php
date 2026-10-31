<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserTypeMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        ...$types
    ): Response {

        if (!Auth::guard('web')->check()) {
            return redirect()->route('home.index');
        }

        $user = Auth::guard('web')->user();

        if (!in_array($user->user_type, $types)) {
            abort(403, 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}