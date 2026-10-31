<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicle_type = VehicleType::get();
        return view('Admin.VehicleType.index', compact('vehicle_type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.VehicleType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_type' => 'required|string|max:255|unique:vehicle_types,vehicle_type',
        ]);
        VehicleType::create([
            'vehicle_type'  => $request->vehicle_type,
            'status'     => 1,
        ]);

        return redirect()
            ->route('admin.vehicle-types.index')
            ->with('success', 'Vehicle Type added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vehicle_data = VehicleType::where('id', $id)->first();
        return view('Admin.VehicleType.create', compact('vehicle_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehicle_data = VehicleType::findOrFail($id);
        $request->validate([
            'vehicle_type' => 'required|string|max:255|unique:vehicle_types,vehicle_type,' . $id,
        ]);

        $vehicle_data->update([
            'vehicle_type' => $request->vehicle_type,
        ]);

        return redirect()->route('admin.vehicle-types.index')
                         ->with('success', 'Vehicle type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = VehicleType::find($id);
        
        $data->delete();

        return redirect()->route('admin.vehicle-types.index')->with('error', 'Vehicle type deleted successfully.');
    }

    public function vehicleTypes_update_status(Request $request){

        $vehicle_data = VehicleType::find($request->id);
    
        if ($vehicle_data) {
            $vehicle_data->status = $request->status;
            $vehicle_data->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Vehicle status updated successfully.',
                'status' => $vehicle_data->status
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Vehicle data not found.'
        ], 404);
    }
}
