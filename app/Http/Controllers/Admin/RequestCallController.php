<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestCallEnquiry;
use Illuminate\Http\Request;

class RequestCallController extends Controller
{

    public function requestCall_index(){

        $all_enquiry = RequestCallEnquiry::orderBy('id', 'DESC')->get();

        return view('Admin.Request_Call.index', compact('all_enquiry'));
    }

    public function view($id)
    {
        $requestCall = RequestCallEnquiry::find($id);

        if (!$requestCall) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found.'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $requestCall
        ]);
    }

    public function requestCall_update(Request $request, string $id){
        $request->validate([
            'first_name'              => 'required|string|max:100',
            'middle_name'             => 'nullable|string|max:100',
            'last_name'               => 'nullable|string|max:100',
            'email'                   => 'required|email|max:255',
            'mobile_number'           => 'required|digits:10',
            'secondaryMobile_number'  => 'nullable|digits:10',
            'home_address'            => 'nullable|string',
            'office_address'          => 'nullable|string',
            'message'                 => 'required|string',
        ]);

        $requestCall = RequestCallEnquiry::findOrFail($id);

        $requestCall->update([
            'first_name'              => $request->first_name,
            'middle_name'             => $request->middle_name,
            'last_name'               => $request->last_name,
            'email'                   => $request->email,
            'mobile_number'           => $request->mobile_number,
            'secondaryMobile_number'  => $request->secondaryMobile_number,
            'home_address'            => $request->home_address,
            'office_address'          => $request->office_address,
            'message'                 => $request->message,
        ]);

        return redirect()
            ->route('admin.requestCall.index')
            ->with('success', 'Request call details updated successfully.');
    }

    public function requestCall_edit(string $id){

        $data = RequestCallEnquiry::where('id', $id)->first();

        return view('Admin.Request_Call.edit', compact('data'));
    }


    public function requestCall_destroy(string $id){
        
        $data = RequestCallEnquiry::find($id);
        $data->delete();

        return redirect()->route('admin.requestCall.index')->with('error', 'Request call details deleted successfully.');
    }


    public function requestCall_update_status(Request $request){

        $enquiry_data = RequestCallEnquiry::find($request->id);
    
        if ($enquiry_data) {
            $enquiry_data->status = $request->status;
            $enquiry_data->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Request call enquiry status updated successfully.',
                'status' => $enquiry_data->status
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Request Call data not found.'
        ], 404);
    }
}
