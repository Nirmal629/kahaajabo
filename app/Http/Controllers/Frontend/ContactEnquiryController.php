<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RequestCallEnquiry;
use Illuminate\Http\Request;

class ContactEnquiryController extends Controller
{
    public function call_enquiry(Request $request){
        session()->flash('open_modal', 'bookingModal');
        $request->validate([
            'first_name'      => 'required|string|max:100',
            'middle_name'     => 'nullable|string|max:100',
            'last_name'       => 'required|string|max:100',

            'email'           => 'required|email|max:255',

            'primary_mobile'  => 'required|digits:10',
            'secondary_mobile'=> 'nullable|digits:10',

            'home_address'         => 'required|string',
            'office_address'         => 'string',
            'message'         => 'nullable|string',
        ], [
            'first_name.required'     => 'First name is required.',
            'last_name.required'      => 'Last name is required.',

            'email.required'          => 'Email is required.',
            'email.email'             => 'Enter a valid email.',

            'primary_mobile.required' => 'Primary mobile number is required.',
            'primary_mobile.digits'   => 'Primary mobile number must be 10 digits.',

            'secondary_mobile.digits' => 'Secondary mobile number must be 10 digits.',

            'home_address.required'        => 'Home Address is required.',
        ]);

        try {
            RequestCallEnquiry::create([
                'first_name'       => $request->first_name,
                'middle_name'      => $request->middle_name,
                'last_name'        => $request->last_name,
                'email'            => $request->email,
                'mobile_number'   => $request->primary_mobile,
                'secondaryMobile_number' => $request->secondary_mobile,
                'home_address'          => $request->home_address,
                'office_address'          => $request->office_address,
                'message'          => $request->message,
            ]);

            return redirect()->back()
                ->with('success', 'Enquiry submitted successfully.');
                
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }
}
