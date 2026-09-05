<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Helpers\LocationHelper;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        
        $countries = Country::orderBy('country_name')
                        ->where('status', 1)
                        ->get();

        return view('Frontend.index');
    }


    public function location_fetch(Request $request)
    {
        try {

            $request->validate([
                'type' => 'required|in:state,district,city,area',
            ]);

            $data = LocationHelper::fetch(
                $request->type,
                $request->only([
                    'country_id',
                    'state_id',
                    'district_id',
                    'city_id',
                ])
            );

            return response()->json([
                'success' => true,
                'message' => ucfirst($request->type) . ' data fetched successfully.',
                'status'  => $data,
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }





}
