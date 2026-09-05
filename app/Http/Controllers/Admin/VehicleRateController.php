<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VehicleRate;
use App\Models\VehicleType;
use Illuminate\Support\Facades\File;

class VehicleRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicle_rates = VehicleRate::with('vehicleType')
            ->latest()
            ->get();

        return view('Admin.VehicleRate.index', compact('vehicle_rates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicle_types = VehicleType::
            // where('status', 1)
            orderBy('vehicle_type')
            ->get();

        return view('Admin.VehicleRate.create', compact('vehicle_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'vehicle_name'    => 'required|string|max:255',
            'vehicle_image'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price_per_km'    => 'required|numeric|min:0',
        ]);

        $fileName = null;

        if ($request->hasFile('vehicle_image')) {

            $path = public_path('uploads/vehicle-rate');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            $fileName = time() . '_' . $request->vehicle_image->getClientOriginalName();

            $request->vehicle_image->move($path, $fileName);
        }

        VehicleRate::create([
            'vehicle_type_id' => $request->vehicle_type_id,
            'vehicle_name'    => $request->vehicle_name,
            'vehicle_image'   => $fileName,
            'price_per_km'    => $request->price_per_km,
            'status'          => 1,
        ]);

        return redirect()
            ->route('admin.vehicle-rates.index')
            ->with('success', 'Vehicle rate added successfully.');
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
        $vehicle_rate = VehicleRate::findOrFail($id);

        $vehicle_types = VehicleType::
            // where('status', 1)
            orderBy('vehicle_type')
            ->get();

        return view(
            'Admin.VehicleRate.create',
            compact('vehicle_rate', 'vehicle_types')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehicle_rate = VehicleRate::findOrFail($id);

        $request->validate([
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'vehicle_name'    => 'required|string|max:255',
            'vehicle_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price_per_km'    => 'required|numeric|min:0',
        ]);

        $fileName = $vehicle_rate->vehicle_image;

        if ($request->hasFile('vehicle_image')) {

            $path = public_path('uploads/vehicle-rate');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            // Delete old image
            if (
                $vehicle_rate->vehicle_image &&
                File::exists($path . '/' . $vehicle_rate->vehicle_image)
            ) {
                File::delete($path . '/' . $vehicle_rate->vehicle_image);
            }

            $fileName = time() . '_' . $request->vehicle_image->getClientOriginalName();

            $request->vehicle_image->move($path, $fileName);
        }

        $vehicle_rate->update([
            'vehicle_type_id' => $request->vehicle_type_id,
            'vehicle_name'    => $request->vehicle_name,
            'vehicle_image'   => $fileName,
            'price_per_km'    => $request->price_per_km,
        ]);

        return redirect()
            ->route('admin.vehicle-rates.index')
            ->with('success', 'Vehicle rate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle_rate = VehicleRate::findOrFail($id);

        $path = public_path('uploads/vehicle-rate');

        if (
            $vehicle_rate->vehicle_image &&
            File::exists($path . '/' . $vehicle_rate->vehicle_image)
        ) {
            File::delete($path . '/' . $vehicle_rate->vehicle_image);
        }

        $vehicle_rate->delete();

        return redirect()
            ->route('admin.vehicle-rates.index')
            ->with('success', 'Vehicle rate deleted successfully.');
    }


    public function vehicleRates_update_status(Request $request)
    {
        $vehicle_rate = VehicleRate::findOrFail($request->id);

        if ($vehicle_rate) {
            $vehicle_rate->status = $request->status;
            $vehicle_rate->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Vehicle Rate status updated successfully.',
                'status' => $vehicle_rate->status
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Vehicle Rate data not found.'
        ], 404);
    }
}
