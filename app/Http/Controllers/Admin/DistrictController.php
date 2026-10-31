<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Country;
use App\Models\District;
use App\Models\City;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_district = District::select('location_districts.*', 'location_countries.country_name', 'location_states.name as state_name')
                    ->leftjoin('location_countries', 'location_countries.id', 'location_districts.country_id')
                    ->leftjoin('location_states', 'location_states.id', 'location_districts.state_id')
                    ->get();

        return view('Admin.District.index', compact('all_district'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::get();
        return view('Admin.District.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:location_countries,id',
            'state_id'   => 'required|exists:location_states,id',
            'district_name'  => [
                'required',
                'string',
                'max:255',
                Rule::unique('location_districts')->where(function ($query) use ($request) {
                    return $query->where('country_id', $request->country_id)
                                ->where('state_id', $request->state_id);
                }),
            ],
        ], [
            'district_name.unique' => 'This district already exists for the selected country and state.',
        ]);

        District::create([
            'country_id' => $request->country_id,
            'state_id'   => $request->state_id,
            'district_name'  => $request->district_name,
            'status'     => 1,
        ]);

        return redirect()
            ->route('admin.district.index')
            ->with('success', 'District added successfully.');
    
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
        $data = District::where('id', $id)->first();
        $countries = Country::get();
        $states = State::where('country_id', $data->country_id)->get();

        return view('Admin.District.edit', compact('countries', 'states', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $district = District::findOrFail($id);

        $request->validate([
            'country_id' => 'required|exists:location_countries,id',
            'state_id'   => 'required|exists:location_states,id',
            'district_name'  => [
                'required',
                'string',
                'max:255',
                Rule::unique('location_districts')
                    ->where(function ($query) use ($request) {
                        return $query->where('country_id', $request->country_id)
                                    ->where('state_id', $request->state_id);
                    })
                    ->ignore($district->id),
            ],
        ], [
            'district_name.unique' => 'This district already exists for the selected country and state.',
        ]);

        $district->update([
            'country_id' => $request->country_id,
            'state_id'   => $request->state_id,
            'district_name'  => $request->district_name,
        ]);

        return redirect()
            ->route('admin.district.index')
            ->with('success', 'District updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = District::find($id);
        City::where('district_id', $id)->delete();
        Area::where('city_id', $id)->delete();
        $data->delete();

        return redirect()->route('admin.district.index')->with('error', 'District Details deleted successfully.');
    }

    public function district_update_status(Request $request){

        $district_data = District::find($request->id);
    
        if ($district_data) {
            $district_data->status = $request->status;
            $district_data->save();
    
            return response()->json([
                'success' => true,
                'message' => 'District status updated successfully.',
                'status' => $district_data->status
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'District data not found.'
        ], 404);
    }

}
