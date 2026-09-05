<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Area;
use App\Models\State;
use App\Models\Country;
use App\Models\District;
use App\Models\City;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allArea = Area::select('location_areas.*', 'location_countries.country_name', 'location_states.name as state_name', 'location_districts.district_name', 'location_cities.name as city_name')
                    ->leftjoin('location_countries', 'location_countries.id', 'location_areas.country_id')
                    ->leftjoin('location_states', 'location_states.id', 'location_areas.state_id')
                    ->leftjoin('location_districts', 'location_districts.id', 'location_areas.district_id')
                    ->leftjoin('location_cities', 'location_cities.id', 'location_areas.city_id')
                    ->get();

        return view('Admin.Area.index', compact('allArea'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::get();
        return view('Admin.Area.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:location_countries,id',
            'state_id'   => 'required|exists:location_states,id',
            'district_id'   => 'required|exists:location_districts,id',
            'city_id'    => 'required|exists:location_cities,id',
            'area_name'  => [
                'required',
                Rule::unique('location_areas')->where(function ($query) use ($request) {
                    return $query->where('country_id', $request->country_id)
                                 ->where('state_id', $request->state_id)
                                 ->where('district_id', $request->district_id)
                                 ->where('city_id', $request->city_id);
                }),
            ],
            'pincode' => 'required|digits:6',
        ], [
            'area_name.unique' => 'This area already exists in the selected city.',
        ]);

        Area::create([
            'country_id' => $request->country_id,
            'state_id'   => $request->state_id,
            'district_id'   => $request->district_id,
            'city_id'    => $request->city_id,
            'area_name'  => $request->area_name,
            'pincode'  => $request->pincode,
            'status'     => 1,
        ]);

        return redirect()->route('admin.area.index')
                         ->with('success', 'Area added successfully.');
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
        $area = Area::findOrFail($id);

        $countries = Country::orderBy('country_name')
                            ->get();

        $states = State::where('country_id', $area->country_id)
                    //    ->where('status', 1)
                       ->orderBy('name')
                       ->get();
        
        $district = District::where('country_id', $area->country_id)->where('state_id', $area->state_id)->get();

        $cities = City::where('country_id', $area->country_id)->where('state_id', $area->state_id)
                      ->where('district_id', $area->district_id)
                      ->orderBy('name')
                      ->get();

        return view('Admin.Area.edit', compact(
            'area',
            'countries',
            'states',
            'district',
            'cities'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $area = Area::findOrFail($id);

        $request->validate([
            'country_id' => 'required|exists:location_countries,id',
            'state_id'   => 'required|exists:location_states,id',
            'district_id'   => 'required|exists:location_districts,id',
            'city_id'    => 'required|exists:location_cities,id',
            'area_name'  => [
                'required',
                Rule::unique('location_areas')
                    ->where(function ($query) use ($request) {
                        return $query->where('country_id', $request->country_id)
                                     ->where('state_id', $request->state_id)
                                     ->where('district_id', $request->district_id)
                                     ->where('city_id', $request->city_id);
                    })
                    ->ignore($area->id),
            ],
            'pincode' => 'required|digits:6',
        ], [
            'area_name.unique' => 'This area already exists in the selected city.',
        ]);

        $area->update([
            'country_id' => $request->country_id,
            'state_id'   => $request->state_id,
            'district_id'   => $request->district_id,
            'city_id'    => $request->city_id,
            'area_name'  => $request->area_name,
            'pincode'  => $request->pincode,
        ]);

        return redirect()->route('admin.area.index')
                         ->with('success', 'Area updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Area::find($id);
        $data->delete();

        return redirect()->route('admin.area.index')->with('error', 'Area Details deleted successfully.');
    }

    public function area_update_status(Request $request){
        $area_data = Area::find($request->id);
    
        if ($area_data) {
            $area_data->status = $request->status;
            $area_data->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Area status updated successfully.',
                'status' => $area_data->status
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Area data not found.'
        ], 404);
    }
}
