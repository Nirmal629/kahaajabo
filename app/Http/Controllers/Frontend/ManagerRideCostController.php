<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerRideCostController extends Controller
{
    public function ride_cost_list(){
        return view('Manager-Dashboard.CarCost.index');
    }
}
