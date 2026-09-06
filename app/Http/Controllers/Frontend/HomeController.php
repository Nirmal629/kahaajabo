<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\HomeBanner;
use App\Models\HomeAllSection;
use App\Models\PopularDestination;
use App\Models\VehicleRate;
use App\Models\ContactDetails;
use App\Helpers\LocationHelper;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        
        $countries = Country::orderBy('country_name')
                        ->where('status', 1)
                        ->get();

        $get_banner = HomeBanner::where('status', 1)->get();
        $get_home_details = HomeAllSection::first();
        $get_popDestination = PopularDestination::where('status', 1)->get();

        $vehicle_rates = VehicleRate::with('vehicleType')
            ->where('status', 1)
            ->get();

        $contact_details = ContactDetails::first();

        return view('Frontend.index', compact('get_banner', 'get_home_details', 'get_popDestination', 'vehicle_rates', 'contact_details'));
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
