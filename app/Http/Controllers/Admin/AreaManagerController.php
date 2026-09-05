<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\InternalUser;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\State;
use App\Models\CarOwner;
use App\Models\VehicleDetails;
use App\Models\Driver;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class AreaManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managerData = InternalUser::select('internal_users.*', 'location_countries.country_name', 'location_states.name as state_name',
            'location_districts.district_name', 'location_cities.name as city_name', 'location_areas.area_name', 'location_areas.pincode')
            ->leftjoin('location_countries', 'location_countries.id', 'internal_users.country_id')
            ->leftjoin('location_states', 'location_states.id', 'internal_users.state_id')
            ->leftjoin('location_districts', 'location_districts.id', 'internal_users.district_id')
            ->leftjoin('location_cities', 'location_cities.id', 'internal_users.city_id')
            ->leftjoin('location_areas', 'location_areas.id', 'internal_users.area_id')
            ->get();

        return view('Admin.AreaManager.index', compact('managerData'));
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
        $areaManager = AreaManager::select(
            'internal_users.*',
            'location_countries.country_name',
            'location_states.name as state_name',
            'location_districts.district_name',
            'location_cities.name as city_name',
            'location_areas.area_name',
            'location_areas.pincode'
        )
        ->leftJoin('location_countries','location_countries.id','=','internal_users.country_id')
        ->leftJoin('location_states','location_states.id','=','internal_users.state_id')
        ->leftJoin('location_districts','location_districts.id','=','internal_users.district_id')
        ->leftJoin('location_cities','location_cities.id','=','internal_users.city_id')
        ->leftJoin('location_areas','location_areas.id','=','internal_users.area_id')
        ->findOrFail($id);

        $getCar_owner = CarOwner::where('area_manager_id', $id)
                        ->select('first_name','last_name','email','phone_number')
                        ->get();

        $get_vehicles = VehicleDetails::select('vehicle_details.*')
            ->leftJoin('car_owners', function ($join) {
                $join->on('vehicle_details.vehicle_owner_id', '=', 'car_owners.id')
                    ->where('vehicle_details.vehicle_owner_type', 'Car Owner');
            })
            // ->leftJoin('drivers', function ($join) {
            //     $join->on('vehicle_details.vehicle_owner_id', '=', 'drivers.id')
            //         ->where('vehicle_details.vehicle_owner_type', 'Driver');
            // })
            ->where(function ($query) use ($id) {

                $query->where(function ($q) use ($id) {
                    $q->where('vehicle_details.vehicle_owner_type', 'Car Owner')
                    ->where('car_owners.area_manager_id', $id);
                });

                // $query->orWhere(function ($q) use ($id) {
                //     $q->where('vehicle_details.vehicle_owner_type', 'Driver')
                //     ->where('drivers.area_manager_id', $id);
                // });

            })
            ->get();

        $driver_details = Driver::where('area_manager_id', $id)
            ->select(
                'id',
                'first_name',
                'last_name',
                'email',
                'phone_number'
            )
            ->get();


        if (!$areaManager) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found.'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $areaManager,
            'car_owner' => $getCar_owner,
            'vehicle_details' => $get_vehicles,
            'drivers' => $driver_details
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $area_manager = InternalUser::findOrFail($id);

        $countries = Country::orderBy('country_name')
            ->get();

        $states = State::where('country_id', $area_manager->country_id)
                    //    ->where('status', 1)
            ->orderBy('name')
            ->get();

        $district = District::where('country_id', $area_manager->country_id)->where('state_id', $area_manager->state_id)->get();

        $cities = City::where('country_id', $area_manager->country_id)->where('state_id', $area_manager->state_id)
            ->where('district_id', $area_manager->district_id)
            ->orderBy('name')
            ->get();

        $area = Area::where('country_id', $area_manager->country_id)->where('state_id', $area_manager->state_id)
            ->where('district_id', $area_manager->district_id)
            ->where('city_id', $area_manager->city_id)
            ->get();

        return view('Admin.AreaManager.edit', compact(
            'area_manager',
            'countries',
            'states',
            'district',
            'cities',
            'area'
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
            'email' => 'required|email|unique:area_managers,email,'.$id,
            'phone_number' => 'required|digits_between:10,15|unique:area_managers,phone_number,'.$id,

            'country_id' => 'required',
            'state_id' => 'required',
            'district_id' => 'required',
            'city_id' => 'required',
            'area_id' => 'required',

            'aadhar_card_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'pan_card_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'bank_passBook_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'driving_license_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $areaManager = InternalUser::findOrFail($id);

        // Upload Folder
        $path = public_path('uploads/area-manager/');

        if (! File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Aadhaar
        if ($request->hasFile('aadhar_card_file')) {

            if ($areaManager->aadhar_card_file && File::exists($path.$areaManager->aadhar_card_file)) {
                File::delete($path.$areaManager->aadhar_card_file);
            }

            $file = time().'_aadhar.'.$request->aadhar_card_file->extension();
            $request->aadhar_card_file->move($path, $file);
            $areaManager->aadhar_card_file = $file;
        }

        // PAN
        if ($request->hasFile('pan_card_file')) {

            if ($areaManager->pan_card_file && File::exists($path.$areaManager->pan_card_file)) {
                File::delete($path.$areaManager->pan_card_file);
            }

            $file = time().'_pan.'.$request->pan_card_file->extension();
            $request->pan_card_file->move($path, $file);
            $areaManager->pan_card_file = $file;
        }

        // Passbook
        if ($request->hasFile('bank_passBook_file')) {

            if ($areaManager->bank_passBook_file && File::exists($path.$areaManager->bank_passBook_file)) {
                File::delete($path.$areaManager->bank_passBook_file);
            }

            $file = time().'_passbook.'.$request->bank_passBook_file->extension();
            $request->bank_passBook_file->move($path, $file);
            $areaManager->bank_passBook_file = $file;
        }

        // Driving License
        if ($request->hasFile('driving_license_file')) {

            if ($areaManager->driving_license_file && File::exists($path.$areaManager->driving_license_file)) {
                File::delete($path.$areaManager->driving_license_file);
            }

            $file = time().'_license.'.$request->driving_license_file->extension();
            $request->driving_license_file->move($path, $file);
            $areaManager->driving_license_file = $file;
        }

        // Update Data
        $areaManager->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,

            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'district_id' => $request->district_id,
            'city_id' => $request->city_id,
            'area_id' => $request->area_id,

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
            ->route('admin.area-manager.index')
            ->with('success', 'Area Manager updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = InternalUser::find($id);
        $data->delete();

        return redirect()->route('admin.area-manager.index')->with('error', 'Area Manager Details deleted successfully.');
    }

    public function areaManager_update_status(Request $request)
    {

        $areaManager_details = InternalUser::find($request->id);

        if ($areaManager_details) {
            $areaManager_details->status = $request->status;
            $areaManager_details->save();

            return response()->json([
                'success' => true,
                'message' => 'Area Manager status updated successfully.',
                'status' => $areaManager_details->status,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Area Manager Details not found.',
        ], 404);
    }
}
