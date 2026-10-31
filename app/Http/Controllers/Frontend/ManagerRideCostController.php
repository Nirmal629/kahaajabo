<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use App\Models\DirectCostEstimate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ManagerRideCostController extends Controller
{
    public function direct_cost_list(){
        $user_type = Auth::guard('web')->user();

        $cost_estimates = DirectCostEstimate::where(
            'area_managerId',
            $user_type->id
        )->latest()->get();

        return view('Manager-Dashboard.CarCost.directCarCost', compact('cost_estimates'));
    }

    public function create_direct_cost_list(){
        $vehicle_types = VehicleType::where('status', 1)->get();

        return view('Manager-Dashboard.CarCost.create_directCarCost', compact('vehicle_types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pickup_location' => 'required|string|max:255',
            'pickup_latitude' => 'nullable|numeric|between:-90,90',
            'pickup_longitude' => 'nullable|numeric|between:-180,180',

            'dropoff_location' => 'required|string|max:255',
            'dropoff_latitude' => 'nullable|numeric|between:-90,90',
            'dropoff_longitude' => 'nullable|numeric|between:-180,180',

            'estimated_distance' => 'required|numeric|min:0',
            'vehicle_category' => 'required|string|max:255',
            'total_estimated_fare' => 'required|numeric|min:0',
        ]);

        try {

            $user_type = Auth::guard('web')->user();

            $cost_add = new DirectCostEstimate;

            $cost_add->area_managerId = $user_type->id;
            $cost_add->pickup_location = $request->pickup_location;
            $cost_add->pickup_latitude = $request->pickup_latitude;
            $cost_add->pickup_longitude = $request->pickup_longitude;
            $cost_add->dropoff_location = $request->dropoff_location;
            $cost_add->dropoff_latitude = $request->dropoff_latitude;
            $cost_add->dropoff_longitude = $request->dropoff_longitude;
            $cost_add->estimated_distance = $request->estimated_distance;
            $cost_add->vehicle_category = $request->vehicle_category;
            $cost_add->total_estimated_fare = $request->total_estimated_fare;
            $cost_add->status = 'Pending';

            $cost_add->save();

            return redirect()
                ->route('manager.directride.cost.estimate')
                ->with('success', 'Direct cost estimate saved successfully!');

        } catch (\Exception $e) {

            Log::error('Direct Cost Estimate Error: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong while saving the direct cost estimate.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {

            $request->validate([
                'status' => 'required|in:pending,approved',
            ]);

            $user = Auth::guard('web')->user();

            $estimate = DirectCostEstimate::where('id', $id)
                ->where('area_managerId', $user->id)
                ->firstOrFail();

            $estimate->status = ucfirst($request->status);
            $estimate->save();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully!',
                'status' => ucfirst($estimate->status),
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {

            Log::error('Direct Cost Status Update Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Unable to update status.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = Auth::guard('web')->user();
            $cost_estimate = DirectCostEstimate::where('id', $id)
                ->where('area_managerId', $user->id)
                ->firstOrFail();

            $cost_estimate->delete();

            return redirect()
                ->route('manager.directride.cost.estimate')
                ->with('success', 'Direct cost estimate deleted successfully!');

        } catch (\Exception $e) {

            Log::error('Direct Cost Estimate Delete Error: ' . $e->getMessage());
            return redirect()
                ->route('manager.directride.cost.estimate')
                ->with('error', 'Unable to delete direct cost estimate.');
        }
    }
}
