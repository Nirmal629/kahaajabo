<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactDetails;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(){
        $contact_data = ContactDetails::first();
        return view('Admin.Contact-Us.index', compact('contact_data'));
    }

    public function update_details(Request $request){

        $request->validate([
            'email_id' => 'email|max:255',
            'phone_number' => 'digits:10',
            'address' => 'string|max:1000',
            'open_time' => 'string|max:255',
        ]);

        $contact_data = ContactDetails::first();

        if (!$contact_data) {
            $contact_data = new ContactDetails();
        }

        $contact_data->email_id = $request->email_id;
        $contact_data->phone_number = $request->phone_number;
        $contact_data->address = $request->address;
        $contact_data->open_time = $request->open_time;

        $contact_data->save();

        return redirect()
            ->route('admin.contact-us.index')
            ->with('success', 'Contact Us Details updated successfully.');

    }

}
