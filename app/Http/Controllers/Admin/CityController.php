<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\State;
use App\Models\District;
use App\Models\Country;
use App\Models\City;
use App\Models\Area;
use App\Models\AreaManager;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $all_city = City::select('location_cities.*', 'location_countries.country_name', 'location_states.name as state_name', 'location_districts.district_name')
        //             ->leftjoin('location_countries', 'location_countries.id', 'location_cities.country_id')
        //             ->leftjoin('location_states', 'location_states.id', 'location_cities.state_id')
        //             ->leftjoin('location_districts', 'location_districts.id', 'location_cities.district_id')
        //             ->get();

        if ($request->ajax()) {

            $all_city = City::query()
                ->leftJoin(
                    'location_countries',
                    'location_countries.id',
                    '=',
                    'location_cities.country_id'
                )
                ->leftJoin(
                    'location_states',
                    'location_states.id',
                    '=',
                    'location_cities.state_id'
                )
                ->leftJoin(
                    'location_districts',
                    'location_districts.id',
                    '=',
                    'location_cities.district_id'
                )
                ->select([
                    'location_cities.id',
                    'location_cities.name',
                    'location_cities.status',
                    'location_countries.country_name',
                    'location_states.name as state_name',
                    'location_districts.district_name',
                ]);

            return DataTables::of($all_city)

                ->addIndexColumn()

                ->addColumn('status', function ($city) {

                    return '
                        <div class="d-flex align-items-center gap-2">
                            <div class="form-check form-switch m-0">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    role="switch"
                                    id="statusSwitch' . $city->id . '"
                                    data-id="' . $city->id . '"
                                    ' . ($city->status ? 'checked' : '') . '
                                    onchange="updateStatus(this)">
                            </div>

                            <span
                                id="status-text-' . $city->id . '"
                                class="form-check-label status-badge ' .
                                ($city->status ? 'status-active' : 'status-inactive') . '">
                                ' . ($city->status ? 'ACTIVE' : 'INACTIVE') . '
                            </span>
                        </div>
                    ';
                })

                ->addColumn('action', function ($city) {

                    $editUrl = route(
                        'admin.city.edit',
                        $city->id
                    );

                    $deleteUrl = route(
                        'admin.city.destroy',
                        $city->id
                    );

                    return '
                        <div class="d-flex align-items-center gap-2">

                            <a href="' . $editUrl . '"
                            class="text-primary"
                            title="Edit">
                                <i class="bx bx-edit fs-5"></i>
                            </a>

                            <form action="' . $deleteUrl . '"
                                method="POST"
                                class="delete-form m-0 p-0">

                                ' . csrf_field() . '

                                <input type="hidden"
                                    name="_method"
                                    value="DELETE">

                                <button type="submit"
                                        class="btn p-0 mt-2 border-0 bg-transparent text-danger"
                                        title="Delete">
                                    <i class="bx bx-trash fs-5"></i>
                                </button>

                            </form>

                        </div>
                    ';
                })

                ->filterColumn('country_name', function ($query, $keyword) {
                    $query->where(
                        'location_countries.country_name',
                        'like',
                        "%{$keyword}%"
                    );
                })

                ->filterColumn('state_name', function ($query, $keyword) {
                    $query->where(
                        'location_states.name',
                        'like',
                        "%{$keyword}%"
                    );
                })

                ->filterColumn('district_name', function ($query, $keyword) {
                    $query->where(
                        'location_districts.district_name',
                        'like',
                        "%{$keyword}%"
                    );
                })

                ->filterColumn('name', function ($query, $keyword) {
                    $query->where(
                        'location_cities.name',
                        'like',
                        "%{$keyword}%"
                    );
                })

                ->rawColumns([
                    'status',
                    'action'
                ])

                ->make(true);
        }

        return view('Admin.City.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::get();
        return view('Admin.City.create', compact('countries'));
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
            'name'  => [
                'required',
                'string',
                'max:255',
                Rule::unique('location_cities')->where(function ($query) use ($request) {
                    return $query->where('country_id', $request->country_id)
                                ->where('state_id', $request->state_id)
                                ->where('district_id', $request->district_id);
                }),
            ],
        ], [
            'name.unique' => 'This city already exists for the selected country and state.',
        ]);

        City::create([
            'country_id' => $request->country_id,
            'state_id'   => $request->state_id,
            'district_id'   => $request->district_id,
            'name'  => $request->name,
            'status'     => 1,
        ]);

        return redirect()
            ->route('admin.city.index')
            ->with('success', 'City added successfully.');
    
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
        $data = City::where('id', $id)->first();
        $countries = Country::get();
        $states = State::where('country_id', $data->country_id)->get();
        $district = District::where('country_id', $data->country_id)->where('state_id', $data->state_id)->get();

        return view('Admin.City.edit', compact('countries', 'states', 'data', 'district'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $city = City::findOrFail($id);

        $request->validate([
            'country_id' => 'required|exists:location_countries,id',
            'state_id'   => 'required|exists:location_states,id',
            'district_id'   => 'required|exists:location_districts,id',
            'name'  => [
                'required',
                'string',
                'max:255',
                Rule::unique('location_cities')
                    ->where(function ($query) use ($request) {
                        return $query->where('country_id', $request->country_id)
                                    ->where('state_id', $request->state_id)
                                    ->where('district_id', $request->district_id);
                    })
                    ->ignore($city->id),
            ],
        ], [
            'name.unique' => 'This city already exists for the selected country and state.',
        ]);

        $city->update([
            'country_id' => $request->country_id,
            'state_id'   => $request->state_id,
            'district_id'   => $request->district_id,
            'name'  => $request->name,
        ]);

        return redirect()
            ->route('admin.city.index')
            ->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = City::find($id);
        Area::where('city_id', $id)->delete();
        $data->delete();

        return redirect()->route('admin.city.index')->with('error', 'City Details deleted successfully.');
    }

    public function city_update_status(Request $request){
        $city_data = City::find($request->id);
    
        if ($city_data) {
            $city_data->status = $request->status;
            $city_data->save();
    
            return response()->json([
                'success' => true,
                'message' => 'City status updated successfully.',
                'status' => $city_data->status
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'City data not found.'
        ], 404);
    }

    public function all_state_fetch(Request $request){
        try {

            $state_data = State::where('country_id', $request->country_id)->get();
        
            if ($state_data) {
                return response()->json([
                    'success' => true,
                    'message' => 'State data fetched successfully.',
                    'status' => $state_data
                ]);
            }
        
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Somerhing Went wrong',
                'error' => $th
            ], 500);
        }
    }

    public function district_fetch_accState(Request $request){
        try {

            $district_data = District::where('country_id', $request->country_id)->where('state_id', $request->state_id)->get();
        
            if ($district_data) {
                return response()->json([
                    'success' => true,
                    'message' => 'District data fetched successfully.',
                    'status' => $district_data
                ]);
            }
        
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Somerhing Went wrong',
                'error' => $th
            ], 500);
        }
    }

    public function city_fetch_accDist(Request $request){
        try {

            $city_data = City::where('country_id', $request->country_id)->where('state_id', $request->state_id)->where('district_id', $request->district_id)->get();
        
            if ($city_data) {
                return response()->json([
                    'success' => true,
                    'message' => 'City data fetched successfully.',
                    'status' => $city_data
                ]);
            }
        
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Somerhing Went wrong',
                'error' => $th
            ], 500);
        }
    }


    public function area_fetch_accCity(Request $request){
        try {

            $area_data = Area::where('country_id', $request->country_id)->where('state_id', $request->state_id)
                    ->where('district_id', $request->district_id)->where('city_id', $request->city_id)->get();
        
            if ($area_data) {
                return response()->json([
                    'success' => true,
                    'message' => 'Area data fetched successfully.',
                    'status' => $area_data
                ]);
            }
        
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Somerhing Went wrong',
                'error' => $th
            ], 500);
        }
    }

    public function areaManager_fetch_accArea(Request $request){
        try {

            $areaManager_data = AreaManager::where('country_id', $request->country_id)->where('state_id', $request->state_id)
                    ->where('district_id', $request->district_id)->where('city_id', $request->city_id)
                    ->where('area_id', $request->area_id)->get();
        
            if ($areaManager_data) {
                return response()->json([
                    'success' => true,
                    'message' => 'Area Manager data fetched successfully.',
                    'status' => $areaManager_data
                ]);
            }
        
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Somerhing Went wrong',
                'error' => $th
            ], 500);
        }
    }
}
