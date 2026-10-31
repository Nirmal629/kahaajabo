<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RequestCallEnquiry;
use App\Models\ContactEnquiry;
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

    public function contact_enquiry(Request $request){
        $request->validate([
            'contact_first_name' => 'required|string|max:100',
            'contact_last_name'  => 'required|string|max:100',
            'contact_email'      => 'email|max:255',
            'contact_phoneNo'    => 'required|digits:10',
            'contact_subject'    => 'string|max:255',
            'contact_message'    => 'required|string|max:2000',
        ], [
            'contact_first_name.required' => 'Please enter your first name.',
            'contact_last_name.required'  => 'Please enter your last name.',
            'contact_email.email'         => 'Please enter a valid email address.',
            'contact_phoneNo.required'    => 'Please enter your phone number.',
            'contact_phoneNo.digits'      => 'Phone number must be exactly 10 digits.',
            'contact_message.required'    => 'Please enter your message.',
        ]);

        // Save enquiry
        ContactEnquiry::create([
            'first_name' => $request->contact_first_name,
            'last_name'  => $request->contact_last_name,
            'email'      => $request->contact_email,
            'phone_no'   => $request->contact_phoneNo,
            'subject'    => $request->contact_subject,
            'message'    => $request->contact_message,
        ]);

        // Redirect with success message
        return back()->with(
            'success',
            'Your enquiry has been submitted successfully.'
        );
    
    }
}
