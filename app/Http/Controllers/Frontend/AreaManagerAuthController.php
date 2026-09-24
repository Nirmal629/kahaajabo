<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AreaManagerAuthController extends Controller
{
    public function dashboard(){
        return view('Manager-Dashboard.dashboard');
    }
}
