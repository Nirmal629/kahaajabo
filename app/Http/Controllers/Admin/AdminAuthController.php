<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{

    public function login(){
        return view('Admin.Auth.login');
    }

    public function authentication(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        $admin = Admin::where('email', $request->email)->first();

        if (Auth::guard('admin')->attempt($credentials, $remember)) {

            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')
                            ->with('success', 'Login successful.');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
