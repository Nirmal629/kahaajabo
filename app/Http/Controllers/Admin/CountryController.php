<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\District;
use App\Models\City;
use App\Models\State;
use App\Models\Area;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::orderBy('country_name')->get();
        return view('Admin.Country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_name'    => 'required|string|max:100|unique:location_countries,country_name',
            'country_code'    => 'required|string|max:2|unique:location_countries,country_code',
            'phone_code'      => 'required|string|max:10',
            'currency'        => 'required|string|max:10',
            'currency_name'   => 'required|string|max:100',
            'currency_symbol' => 'required|string|max:10',
            'flag'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

            $country_data = new Country;

            $country_data->country_name = $request->country_name;
            $country_data->country_code = $request->country_code;
            $country_data->phone_code = $request->phone_code;
            $country_data->currency = $request->currency;
            $country_data->currency_name = $request->currency_name;
            $country_data->currency_symbol = $request->currency_symbol;

            // Upload Path
            $path = public_path('uploads/Country-flag/');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            if ($request->hasFile('flag')) {

                $fileName = $request->file('flag')->getClientOriginalName();
                $request->flag->move($path, $fileName);

                $country_data->flag = $fileName;
            }
            $country_data->save();

        return redirect()->route('admin.country.index')
            ->with('success','Country Details Added Successfully');
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
        $data = Country::where('id', $id)->first();
        return view('Admin.Country.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'country_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('location_countries', 'country_name')->ignore($id),
            ],

            'country_code' => [
                'required',
                'string',
                'max:2',
                Rule::unique('location_countries', 'country_code')->ignore($id),
            ],
            'phone_code'      => 'required|string|max:10',
            'currency'        => 'required|string|max:10',
            'currency_name'   => 'required|string|max:100',
            'currency_symbol' => 'required|string|max:10',
            'flag'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

            $country_data = Country::findOrFail($id);

            $country_data->country_name = $request->country_name;
            $country_data->country_code = $request->country_code;
            $country_data->phone_code = $request->phone_code;
            $country_data->currency = $request->currency;
            $country_data->currency_name = $request->currency_name;
            $country_data->currency_symbol = $request->currency_symbol;

            // Upload Path
            $path = public_path('uploads/Country-flag/');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            if ($request->hasFile('flag')) {
                if ($country_data->flag && File::exists($path.$country_data->flag)) {
                    File::delete($path.$country_data->flag);
                }

                $fileName = $request->file('flag')->getClientOriginalName();
                $request->flag->move($path, $fileName);

                $country_data->flag = $fileName;
            }
            $country_data->save();

        return redirect()->route('admin.country.index')
            ->with('success','Country Details Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Country::find($id);

        Area::where('country_id', $id)->delete();
        // Delete all cities belonging to this country
        City::where('country_id', $id)->delete();
        District::where('country_id', $id)->delete();
        // Delete all states belonging to this country
        State::where('country_id', $id)->delete();
        $data->delete();

        return redirect()->route('admin.country.index')->with('error', 'Country Details deleted successfully.');
    }


    public function country_update_status(Request $request){

        $country_data = Country::find($request->id);
    
        if ($country_data) {
            $country_data->status = $request->status;
            $country_data->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Country status updated successfully.',
                'status' => $country_data->status
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Country data not found.'
        ], 404);
    }
}
