<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarOwner;
use App\Models\Area;
use App\Models\AreaManager;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\State;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CarOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carOwnerData = CarOwner::select('car_owners.*', 'countries.country_name', 'states.name as state_name',
            'districts.district_name', 'cities.name as city_name', 'areas.area_name', 'areas.pincode', 
            DB::raw("CONCAT(area_managers.first_name, ' ', COALESCE(area_managers.last_name, '')) as area_manager_name"))
            ->leftjoin('countries', 'countries.id', 'car_owners.country_id')
            ->leftjoin('states', 'states.id', 'car_owners.state_id')
            ->leftjoin('districts', 'districts.id', 'car_owners.district_id')
            ->leftjoin('cities', 'cities.id', 'car_owners.city_id')
            ->leftjoin('areas', 'areas.id', 'car_owners.area_id')
            ->leftjoin('area_managers', 'area_managers.id', 'car_owners.area_manager_id')
            ->get();

        return view('Admin.CarOwner.index', compact('carOwnerData'));
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
        $carOwner = CarOwner::select('car_owners.*', 'countries.country_name', 'states.name as state_name',
            'districts.district_name', 'cities.name as city_name', 'areas.area_name', 'areas.pincode', 
            DB::raw("CONCAT(area_managers.first_name, ' ', COALESCE(area_managers.last_name, '')) as area_manager_name"))
            ->leftjoin('countries', 'countries.id', 'car_owners.country_id')
            ->leftjoin('states', 'states.id', 'car_owners.state_id')
            ->leftjoin('districts', 'districts.id', 'car_owners.district_id')
            ->leftjoin('cities', 'cities.id', 'car_owners.city_id')
            ->leftjoin('areas', 'areas.id', 'car_owners.area_id')
            ->leftjoin('area_managers', 'area_managers.id', 'car_owners.area_manager_id')
            ->findOrFail($id);


        if (!$carOwner) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found.'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $carOwner
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car_owner = CarOwner::findOrFail($id);

        $countries = Country::orderBy('country_name')
            ->get();

        $states = State::where('country_id', $car_owner->country_id)
                    //    ->where('status', 1)
            ->orderBy('name')
            ->get();

        $district = District::where('country_id', $car_owner->country_id)->where('state_id', $car_owner->state_id)->get();

        $cities = City::where('country_id', $car_owner->country_id)->where('state_id', $car_owner->state_id)
            ->where('district_id', $car_owner->district_id)
            ->orderBy('name')
            ->get();

        $area = Area::where('country_id', $car_owner->country_id)->where('state_id', $car_owner->state_id)
            ->where('district_id', $car_owner->district_id)
            ->where('city_id', $car_owner->city_id)
            ->get();

        $area_manager = AreaManager::where('country_id', $car_owner->country_id)->where('state_id', $car_owner->state_id)
            ->where('district_id', $car_owner->district_id)
            ->where('city_id', $car_owner->city_id)
            ->where('area_id', $car_owner->area_id)->get();

        return view('Admin.CarOwner.edit', compact(
            'car_owner',
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
            'email' => 'required|email|unique:car_owners,email,'.$id,
            'phone_number' => 'required|digits_between:10,15|unique:car_owners,phone_number,'.$id,

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

        $carOwner = CarOwner::findOrFail($id);

        // Upload Folder
        $path = public_path('uploads/car-owner/');

        if (! File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Aadhaar
        if ($request->hasFile('aadhar_card_file')) {

            if ($carOwner->aadhar_card_file && File::exists($path.$carOwner->aadhar_card_file)) {
                File::delete($path.$carOwner->aadhar_card_file);
            }

            $file = time().'_aadhar.'.$request->aadhar_card_file->extension();
            $request->aadhar_card_file->move($path, $file);
            $carOwner->aadhar_card_file = $file;
        }

        // PAN
        if ($request->hasFile('pan_card_file')) {

            if ($carOwner->pan_card_file && File::exists($path.$carOwner->pan_card_file)) {
                File::delete($path.$carOwner->pan_card_file);
            }

            $file = time().'_pan.'.$request->pan_card_file->extension();
            $request->pan_card_file->move($path, $file);
            $carOwner->pan_card_file = $file;
        }

        // Passbook
        if ($request->hasFile('bank_passBook_file')) {

            if ($carOwner->bank_passBook_file && File::exists($path.$carOwner->bank_passBook_file)) {
                File::delete($path.$carOwner->bank_passBook_file);
            }

            $file = time().'_passbook.'.$request->bank_passBook_file->extension();
            $request->bank_passBook_file->move($path, $file);
            $carOwner->bank_passBook_file = $file;
        }

        // Driving License
        if ($request->hasFile('driving_license_file')) {

            if ($carOwner->driving_license_file && File::exists($path.$carOwner->driving_license_file)) {
                File::delete($path.$carOwner->driving_license_file);
            }

            $file = time().'_license.'.$request->driving_license_file->extension();
            $request->driving_license_file->move($path, $file);
            $carOwner->driving_license_file = $file;
        }

        // Update Data
        $carOwner->update([
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
            ->route('admin.car-owner.index')
            ->with('success', 'Car Owner updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = CarOwner::find($id);
        $data->delete();

        return redirect()->route('admin.car-owner.index')->with('error', 'Car Owner Details deleted successfully.');
    }

    public function carOwner_update_status(Request $request)
    {

        $carOwner_details = CarOwner::find($request->id);

        if ($carOwner_details) {
            $carOwner_details->status = $request->status;
            $carOwner_details->save();

            return response()->json([
                'success' => true,
                'message' => 'Car Owner status updated successfully.',
                'status' => $carOwner_details->status,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Car Owner Details not found.',
        ], 404);
    }
}
