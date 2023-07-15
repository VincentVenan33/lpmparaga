<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function changeprofil()
    {
        $data = array();

        $userId = Auth::id();
        $user = UsersModel::find($userId);

        $data['title'] = "Profile";
        $data['user'] = $user;

        return view('profile.changeprofile', $data);
    }

    public function updateprofile(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'username' => 'required|min:3',
            'email' => 'required|email',
            'oldpassword' => 'required_with:newpassword|',
            'newpassword' => 'nullable|min:5',
        ]);

        $userId = Auth::id();
        $user = UsersModel::find($userId);

        if ($request->filled('newpassword')) {
            if (!Hash::check($request->oldpassword, $user->password)) {
                return redirect()->back()->withErrors(['oldpassword' => 'Password lama salah.'])->withInput();
            }
        }

        $isProfileUpdated = false;

        if ($user->name != $request->name || $user->username != $request->username || $user->email != $request->email || $request->filled('newpassword')) {
            $isProfileUpdated = true;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('newpassword')) {
            $user->password = Hash::make($request->newpassword);
        }

        $user->status = $request->has('status') ? 1 : 0;
        // $user->save();

        // if ($isProfileUpdated) {
        //     return redirect()->route('index')->with('message', 'Profil telah diperbarui.');
        // } elseif ($request->has('cancel')) {
        //     return redirect()->route('index')->with('error', 'Gagal memperbarui profil.');
        // } else {
        //     return redirect()->route('index');
        // }

        if ($user->save()) {
            return redirect()->route('dashboard')->with('message', 'News updated successfully');
        } else {
            return redirect()->route('dashboard')->with('error', 'News error to update');
        }
    }


    public function deleteprofil()
    {
        $userId = Auth::id();
        $user = UsersModel::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'Data not found.');
        }

        $user->delete();

        Auth::logout();

        return redirect()->route('login')->with('success', 'Profile deleted successfully.');
    }
}