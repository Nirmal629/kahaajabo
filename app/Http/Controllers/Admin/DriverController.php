<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Area;
use App\Models\AreaManager;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\State;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $driverData = Driver::select('drivers.*', 'countries.country_name', 'states.name as state_name',
            'districts.district_name', 'cities.name as city_name', 'areas.area_name', 'areas.pincode', 
            DB::raw("CONCAT(area_managers.first_name, ' ', COALESCE(area_managers.last_name, '')) as area_manager_name"))
            ->leftjoin('countries', 'countries.id', 'drivers.country_id')
            ->leftjoin('states', 'states.id', 'drivers.state_id')
            ->leftjoin('districts', 'districts.id', 'drivers.district_id')
            ->leftjoin('cities', 'cities.id', 'drivers.city_id')
            ->leftjoin('areas', 'areas.id', 'drivers.area_id')
            ->leftjoin('area_managers', 'area_managers.id', 'drivers.area_manager_id')
            ->get();

        return view('Admin.Driver.index', compact('driverData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $driver = Driver::select('drivers.*', 'countries.country_name', 'states.name as state_name',
            'districts.district_name', 'cities.name as city_name', 'areas.area_name', 'areas.pincode', 
            DB::raw("CONCAT(area_managers.first_name, ' ', COALESCE(area_managers.last_name, '')) as area_manager_name"))
            ->leftjoin('countries', 'countries.id', 'drivers.country_id')
            ->leftjoin('states', 'states.id', 'drivers.state_id')
            ->leftjoin('districts', 'districts.id', 'drivers.district_id')
            ->leftjoin('cities', 'cities.id', 'drivers.city_id')
            ->leftjoin('areas', 'areas.id', 'drivers.area_id')
            ->leftjoin('area_managers', 'area_managers.id', 'drivers.area_manager_id')
            ->findOrFail($id);


        if (!$driver) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found.'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $driver
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $driver_details = Driver::findOrFail($id);

        $countries = Country::orderBy('country_name')
            ->get();

        $states = State::where('country_id', $driver_details->country_id)
            ->orderBy('name')
            ->get();

        $district = District::where('country_id', $driver_details->country_id)->where('state_id', $driver_details->state_id)->get();

        $cities = City::where('country_id', $driver_details->country_id)->where('state_id', $driver_details->state_id)
            ->where('district_id', $driver_details->district_id)
            ->orderBy('name')
            ->get();

        $area = Area::where('country_id', $driver_details->country_id)->where('state_id', $driver_details->state_id)
            ->where('district_id', $driver_details->district_id)
            ->where('city_id', $driver_details->city_id)
            ->get();

        $area_manager = AreaManager::where('country_id', $driver_details->country_id)->where('state_id', $driver_details->state_id)
            ->where('district_id', $driver_details->district_id)
            ->where('city_id', $driver_details->city_id)
            ->where('area_id', $driver_details->area_id)->get();

        return view('Admin.Driver.edit', compact(
            'driver_details',
            'countries',
            'states',
            'district',
            'cities',
            'area',
            'area_manager'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:drivers,email,'.$id,
            'phone_number' => 'required|digits_between:10,15|unique:drivers,phone_number,'.$id,

            'country_id' => 'required',
            'state_id' => 'required',
            'district_id' => 'required',
            'city_id' => 'required',
            'area_id' => 'required',
            'area_manager_id' => 'required',

            'aadhar_card_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'pan_card_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'bank_passBook_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'driving_license_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $driver_data = Driver::findOrFail($id);

        // Upload Folder
        $path = public_path('uploads/driver-document/');

        if (! File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Aadhaar
        if ($request->hasFile('aadhar_card_file')) {

            if ($driver_data->aadhar_card_file && File::exists($path.$driver_data->aadhar_card_file)) {
                File::delete($path.$driver_data->aadhar_card_file);
            }

            $file = time().'_aadhar.'.$request->aadhar_card_file->extension();
            $request->aadhar_card_file->move($path, $file);
            $driver_data->aadhar_card_file = $file;
        }

        // PAN
        if ($request->hasFile('pan_card_file')) {

            if ($driver_data->pan_card_file && File::exists($path.$driver_data->pan_card_file)) {
                File::delete($path.$driver_data->pan_card_file);
            }

            $file = time().'_pan.'.$request->pan_card_file->extension();
            $request->pan_card_file->move($path, $file);
            $driver_data->pan_card_file = $file;
        }

        // Passbook
        if ($request->hasFile('bank_passBook_file')) {

            if ($driver_data->bank_passBook_file && File::exists($path.$driver_data->bank_passBook_file)) {
                File::delete($path.$driver_data->bank_passBook_file);
            }

            $file = time().'_passbook.'.$request->bank_passBook_file->extension();
            $request->bank_passBook_file->move($path, $file);
            $driver_data->bank_passBook_file = $file;
        }

        // Driving License
        if ($request->hasFile('driving_license_file')) {

            if ($driver_data->driving_license_file && File::exists($path.$driver_data->driving_license_file)) {
                File::delete($path.$driver_data->driving_license_file);
            }

            $file = time().'_license.'.$request->driving_license_file->extension();
            $request->driving_license_file->move($path, $file);
            $driver_data->driving_license_file = $file;
        }

        // Update Data
        $driver_data->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,

            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'district_id' => $request->district_id,
            'city_id' => $request->city_id,
            'area_id' => $request->area_id,
            'area_manager_id' => $request->area_manager_id,

            'complete_address' => $request->complete_address,

            'aadhar_card_number' => $request->aadhar_card_number,
            'pan_card_number' => $request->pan_card_number,

            'bank_name' => $request->bank_name,
            'account_holder_name' => $request->account_holder_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,

            'driving_license' => $request->driving_license,
            'license_start_date' => $request->license_start_date,
            'license_end_date' => $request->license_end_date,

            'register_date' => $request->register_date,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()
            ->route('admin.driver.index')
            ->with('success', 'Driver Details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Driver::find($id);
        $data->delete();

        return redirect()->route('admin.driver.index')->with('error', 'Driver Details deleted successfully.');
    }

    public function driver_update_status(Request $request)
    {

        $driver_details = Driver::find($request->id);

        if ($driver_details) {
            $driver_details->status = $request->status;
            $driver_details->save();

            return response()->json([
                'success' => true,
                'message' => 'Driver status updated successfully.',
                'status' => $driver_details->status,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Driver Details not found.',
        ], 404);
    }
}
