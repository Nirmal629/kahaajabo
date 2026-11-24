<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RideCostConfiguration;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RideCostConfigurationController extends Controller
{
    // INDEX / LIST
    public function index()
    {
        $user_type = Auth::guard('web')->user();

        $ride_costs = RideCostConfiguration::with('vehicleType')
            ->where('area_managerId', $user_type->id)
            ->latest()
            ->get();

        return view(
            'Manager-Dashboard.RideCost.index',
            compact('ride_costs')
        );
    }


    // CREATE
    public function create()
    {
        $vehicle_types = VehicleType::where('status', 1)->get();

        return view(
            'Manager-Dashboard.RideCost.create',
            compact('vehicle_types')
        );
    }


    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'gas_cost' => 'required|numeric|min:0',
            'vehicle_input' => 'required|in:Petrol,Diesel,CNG,EV',
            'per_km_cost' => 'required|numeric|min:0',
            'car_maintenance' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'driver_cost' => 'required|numeric|min:0',
        ]);

        try {

            $user_type = Auth::guard('web')->user();

            $ride_cost = new RideCostConfiguration();

            $ride_cost->area_managerId = $user_type->id;
            $ride_cost->vehicle_type_id = $request->vehicle_type_id;
            $ride_cost->gas_cost = $request->gas_cost;
            $ride_cost->vehicle_input = $request->vehicle_input;
            $ride_cost->per_km_cost = $request->per_km_cost;
            $ride_cost->car_maintenance = $request->car_maintenance;
            $ride_cost->total_cost = $request->total_cost;
            $ride_cost->driver_cost = $request->driver_cost;

            $ride_cost->save();

            return redirect()
                ->route('manager.ride.cost.index')
                ->with('success', 'Ride cost configuration added successfully!');

        } catch (\Exception $e) {

            Log::error('Ride Cost Store Error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong while saving ride cost configuration.');
        }
    }


    // EDIT - FETCH EXISTING DATA
    public function edit($id)
    {
        $user_type = Auth::guard('web')->user();

        $vehicle_types = VehicleType::where('status', 1)->get();

        $ride_cost = RideCostConfiguration::where('id', $id)
            ->where('area_managerId', $user_type->id)
            ->firstOrFail();

        return view(
            'Manager-Dashboard.RideCost.create',
            compact('vehicle_types', 'ride_cost')
        );
    }


    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'gas_cost' => 'required|numeric|min:0',
            'vehicle_input' => 'required|in:Petrol,Diesel,CNG,EV',
            'per_km_cost' => 'required|numeric|min:0',
            'car_maintenance' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'driver_cost' => 'required|numeric|min:0',
        ]);

        try {

            $user_type = Auth::guard('web')->user();

            $ride_cost = RideCostConfiguration::where('id', $id)
                ->where('area_managerId', $user_type->id)
                ->firstOrFail();

            $ride_cost->vehicle_type_id = $request->vehicle_type_id;
            $ride_cost->gas_cost = $request->gas_cost;
            $ride_cost->vehicle_input = $request->vehicle_input;
            $ride_cost->per_km_cost = $request->per_km_cost;
            $ride_cost->car_maintenance = $request->car_maintenance;
            $ride_cost->total_cost = $request->total_cost;
            $ride_cost->driver_cost = $request->driver_cost;

            $ride_cost->save();

            return redirect()
                ->route('manager.ride.cost.index')
                ->with('success', 'Ride cost configuration updated successfully!');

        } catch (\Exception $e) {

            Log::error('Ride Cost Update Error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong while updating ride cost configuration.');
        }
    }


    // VIEW
    public function show($id)
    {
        $user_type = Auth::guard('web')->user();

        $ride_cost = RideCostConfiguration::with('vehicleType')
            ->where('id', $id)
            ->where('area_managerId', $user_type->id)
            ->firstOrFail();

        return view(
            'Manager-Dashboard.RideCost.show',
            compact('ride_cost')
        );
    }


    // DELETE
    public function destroy($id)
    {
        $user_type = Auth::guard('web')->user();

        $ride_cost = RideCostConfiguration::where('id', $id)
            ->where('area_managerId', $user_type->id)
            ->firstOrFail();

        $ride_cost->delete();

        return redirect()
            ->route('manager.ride.cost.index')
            ->with('success', 'Ride cost configuration deleted successfully!');
    }


    public function updateStatus_ridecost(Request $request, $id)
    {
        try {

            $request->validate([
                'status' => 'required|in:approved,pending'
            ]); 

            $estimate = RideCostConfiguration::findOrFail($id);

            $estimate->status = $request->status;
            $estimate->save();

            return response()->json([
                'success' => true,
                'status' => ucfirst($estimate->status),
                'message' => 'Status updated successfully!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Unable to update status!'
            ], 500);
        }
    }
}
