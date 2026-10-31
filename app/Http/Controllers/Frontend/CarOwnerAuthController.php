<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CarOwnerAuthController extends Controller
{
    public function dashboard(){
        $countries = Country::orderBy('country_name')->get();
        return view('CarOwner-Dashboard.dashboard', compact('countries'));
    }
}
