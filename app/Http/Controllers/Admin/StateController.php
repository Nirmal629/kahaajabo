<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Country;
use App\Models\District;
use App\Models\City;
use App\Models\Area;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_state = State::select('location_states.*', 'location_countries.country_name')
                    ->leftjoin('location_countries', 'location_countries.id', 'location_states.country_id')
                    ->get();

        return view('Admin.State.index', compact('all_state'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::get();
        return view('Admin.State.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:location_countries,id',
            'state_name' => 'required|string|max:255|unique:location_states,name',
        ]);

        $countrie_data = Country::where('id', $request->country_id)->first();

        State::create([
            'country_id' => $request->country_id,
            'country_code' => $countrie_data->country_code,
            'name'       => $request->state_name,
            'status'     => 1,
        ]);

        return redirect()->route('admin.state.index')
                        ->with('success', 'State added successfully.');
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
        $countries = Country::get();
        $data = State::where('id', $id)->first();
        return view('Admin.State.edit', compact('countries', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $state = State::findOrFail($id);

        $request->validate([
            'country_id' => 'required|exists:location_countries,id',
            'state_name' => [
                'required',
                'max:255',
                Rule::unique('location_states', 'name')
                    ->where(function ($query) use ($request) {
                        return $query->where('country_id', $request->country_id);
                    })
                    ->ignore($state->id),
            ],
        ]);

        $countrie_data = Country::where('id', $request->country_id)->first();

        $state->update([
            'country_id' => $request->country_id,
            'country_code' => $countrie_data->country_code,
            'name'       => $request->state_name,
        ]);

        return redirect()->route('admin.state.index')
                        ->with('success', 'State updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = State::find($id);
        Area::where('state_id', $id)->delete();
        City::where('state_id', $id)->delete();
        District::where('state_id', $id)->delete();
        
        $data->delete();

        return redirect()->route('admin.state.index')->with('error', 'State Details deleted successfully.');
    }


    public function state_update_status(Request $request){

        $state_data = State::find($request->id);
    
        if ($state_data) {
            $state_data->status = $request->status;
            $state_data->save();
    
            return response()->json([
                'success' => true,
                'message' => 'State status updated successfully.',
                'status' => $state_data->status
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'State data not found.'
        ], 404);
    }
}
