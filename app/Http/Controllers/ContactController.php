<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function viewcontact()
    {
        $data = array();
        $contact_data = ContactModel::select('*')->orderBy('id', 'desc')->paginate(10); //menampilkan 10 data per halaman
        // Menghitung jumlah pesan masuk yang belum terbaca
        $unread_count = ContactModel::where('status', 0)->count();

        $data['title'] = "Inbox";
        $data['contact'] = $contact_data;
        $data['unread_count'] = $unread_count;

        return view('contact/viewcontact', $data);
    }

    public function detailcontact($id)
    {
        $data = array();
        $contact_data = ContactModel::findOrFail($id);

        // Update status pesan menjadi sudah dibaca
        ContactModel::where('id', $id)->update(['status' => 1]);

        // Menghitung jumlah pesan masuk yang belum terbaca
        $unread_count = ContactModel::where('status', 0)->count();

        $data['title'] = "Detail Pesan";
        $data['contact'] = $contact_data;
        $data['unread_count'] = $unread_count;

        return view('contact/detailcontact', $data);
    }


    public function readAll()
    {
        ContactModel::where('status', 0)->update(['status' => 1]);

        return redirect()->back();
    }

    public function deletecontact($id)
    {
        $contact_data = ContactModel::where('id', $id)->first();
        $contact_data->delete();
        return redirect()->route('viewcontact')->with('error', 'Data Deleted');
    }
}