<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function viewcontact()
    {
        $data = array();
        $contact = ContactModel::select('*')->orderBy('id', 'desc')->paginate(10);
        $data['title'] = "List Message";
        $data['contact'] = $contact;
        return view('contact/viewcontact', $data);
    }

    public function detailcontact($id)
    {
        $contact = ContactModel::find($id);

        if (!$contact) {
            return redirect()->route('viewcontact')->with('error', 'Contact not found');
        }

        $data = array();
        $data['title'] = "Detail Message";
        $data['contact'] = $contact;

        return view('contact.detailcontact', $data);
    }
}