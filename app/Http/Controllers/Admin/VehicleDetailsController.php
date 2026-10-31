<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleDetails;
use App\Models\VehicleDocument;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class VehicleDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $get_vehicleDetails = VehicleDetails::orderBy('id', 'DESC')->get();
        return view('Admin.VehicleDetails.index', compact('get_vehicleDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicle = VehicleDetails::with('document')->findOrFail($id);
        return response()->json($vehicle);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = VehicleDetails::with('document')->findOrFail($id);
        return view('Admin.VehicleDetails.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request;
        $request->validate([
            'brand'=>'required',
            'model'=>'required',
            'type'=>'required',
            'seat_capacity'=>'required|integer',
            'registration_number' => 'required',

            'policy_number' => 'required|string|max:100',
            'insurance_policy_startDate' => 'required|date',
            'insurance_policy_endDate' => 'required|date|after_or_equal:insurance_policy_startDate',

            'fitness_certificate_number' => 'required|string|max:100',
            'fitness_certificate_startDate' => 'required|date',
            'fitness_certificate_endDate' => 'required|date|after_or_equal:fitness_certificate_startDate',

            'allIndia_tourist_permit_number' => 'required|string|max:100',
            'allIndia_tourist_permit_startDate' => 'required|date',
            'allIndia_tourist_permit_endDate' => 'required|date|after_or_equal:allIndia_tourist_permit_startDate',

            'registration_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'insurance_policy_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'fitness_certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'allIndia_tourist_permit_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
        ]);


            $vehicle = VehicleDetails::findOrFail($id);

            $vehicle->brand = $request->brand;
            $vehicle->model = $request->model;
            $vehicle->type = $request->type;
            $vehicle->seat_capacity = $request->seat_capacity;
            $vehicle->manufacture_year = $request->manufacture_year;
            $vehicle->fuel_type = $request->fuel_type;
            $vehicle->registration_number = $request->registration_number;
            $vehicle->save();

            // Vehicle Documents
            $document = VehicleDocument::where('vehicle_id', $id)->first();

            if (!$document) {
                $document = new VehicleDocument();
                $document->vehicle_id = $id;
            }

            $document->insurance_policy_number = $request->policy_number;
            $document->insurance_policy_startDate = $request->insurance_policy_startDate;
            $document->insurance_policy_endDate = $request->insurance_policy_endDate;

            $document->fitness_certificate_number = $request->fitness_certificate_number;
            $document->fitness_certificate_startDate = $request->fitness_certificate_startDate;
            $document->fitness_certificate_endDate = $request->fitness_certificate_endDate;

            $document->allIndia_tourist_permit_number = $request->allIndia_tourist_permit_number;
            $document->allIndia_tourist_permit_startDate = $request->allIndia_tourist_permit_startDate;
            $document->allIndia_tourist_permit_endDate = $request->allIndia_tourist_permit_endDate;

            // Upload Path
            $path = public_path('uploads/vehicle-documents/');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            // Registration Certificate
            if ($request->hasFile('registration_certificate')) {

                if ($document->registration_certificate && File::exists($path.$document->registration_certificate)) {
                    File::delete($path.$document->registration_certificate);
                }

                $file = time().'_rc.'.$request->registration_certificate->extension();
                $request->registration_certificate->move($path, $file);

                $document->registration_certificate = $file;
            }

            // Insurance File
            if ($request->hasFile('insurance_policy_file')) {

                if ($document->insurance_policy_file && File::exists($path.$document->insurance_policy_file)) {
                    File::delete($path.$document->insurance_policy_file);
                }

                $file = time().'_insurance.'.$request->insurance_policy_file->extension();
                $request->insurance_policy_file->move($path, $file);

                $document->insurance_policy_file = $file;
            }

            // Fitness Certificate
            if ($request->hasFile('fitness_certificate_file')) {

                if ($document->fitness_certificate_file && File::exists($path.$document->fitness_certificate_file)) {
                    File::delete($path.$document->fitness_certificate_file);
                }

                $file = time().'_fitness.'.$request->fitness_certificate_file->extension();
                $request->fitness_certificate_file->move($path, $file);

                $document->fitness_certificate_file = $file;
            }

            // Tourist Permit
            if ($request->hasFile('allIndia_tourist_permit_file')) {

                if ($document->allIndia_tourist_permit_file && File::exists($path.$document->allIndia_tourist_permit_file)) {
                    File::delete($path.$document->allIndia_tourist_permit_file);
                }

                $file = time().'_permit.'.$request->allIndia_tourist_permit_file->extension();
                $request->allIndia_tourist_permit_file->move($path, $file);

                $document->allIndia_tourist_permit_file = $file;
            }

            $document->save();


        

        return redirect()->route('admin.vehicle-details.index')
            ->with('success','Vehicle Details Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = VehicleDetails::find($id);
        $data->delete();

        return redirect()->route('admin.vehicle-details.index')->with('error', 'Vehicle Details deleted successfully.');
    }

    public function vehicleDetails_update_status(Request $request){

        $vehicle_details= VehicleDetails::find($request->id);
    
        if ($vehicle_details) {
            $vehicle_details->status = $request->status;
            $vehicle_details->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Vehicle Details status updated successfully.',
                'status' => $vehicle_details->status
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Vehicle Details not found.'
        ], 404);
    }
}
