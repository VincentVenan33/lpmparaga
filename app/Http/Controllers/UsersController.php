<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function viewusers()
    {
        $data = array();
        $users = UsersModel::select('*')->orderBy('id', 'desc')->paginate(10);
        $data['title'] = "List Users";
        $data['users'] = $users;
        return view('users/viewusers', $data);
    }

    public function addusers()
    {
        $data = array();
        $data['title'] = "Tambah Users";
        return view('users/addusers', $data);
    }

    public function saveusers(Request $request)
    {
        $users = UsersModel::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => ($request->status != "" ? "1" : "0"),
        ]);

        if ($users) {
            $request->validate([
                "name" => "required|min:5",
                "username" => "required|min:3",
                "email" => "required",
                "password" => "required|min:5",
                "role" => "required",
            ]);

            return redirect()->route('viewusers')->with('message', 'Data added Successfully');
        } else {
            return redirect()->route('viewusers')->with('error', 'Data added Error');
        }
    }

    public function changeusers($id)
    {
        $data = array();
        $users = UsersModel::select('*')
            ->where('id', $id)
            ->first();
        $data['title'] = "Ubah Users";
        $data['users'] = $users;
        return view('users/changeusers', $data);
    }

    public function updateusers(Request $request)
    {
        $request->validate([
            "name" => "required|min:5",
            "username" => "required|min:3",
            "email" => "required",
            "password" => "required|min:5",
            "role" => "required",

        ]);

        $users = UsersModel::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => ($request->newpassword != "" ? Hash::make($request->newpassword) : $request->password),
                'role' => $request->role,
                'status' => ($request->status != "" ? "1" : "0"),
            ]);
        if ($users) {
            return redirect()->route('viewusers')->with('message', 'Data update succeesfully');
        } else {
            return redirect()->route('viewusers')->with('error', 'Data update Error');
        }
    }

    public function deleteusers($id)
    {
        $users = UsersModel::where('id', $id)
            ->delete();
        return redirect()->route('viewusers')->with('error', 'Data Deleted');
    }
}