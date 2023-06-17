<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        } else {
            return view('login');
        }
    }

    public function actionlogin(Request $request)
{
    $data = [
        'email' => $request->input('email'),
        'password' => $request->input('password'),
    ];

    $credentials = [
        'email' => $request->input('email'),
        'password' => $request->input('password'),
    ];

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->status == 0) {
            Auth::logout();
            return redirect('login')->with('error', 'Akun Nonaktif!');
        }

        $request->session()->regenerate();

        $message = 'Selamat datang, ' . $user->name . '!';
        return redirect('dashboard')->with('message', $message);
    } else {
        $user = UsersModel::where('email', $request->input('email'))->first();

        if ($user) {
            return redirect('login')->with('error', 'Password Salah!');
        } else {
            return redirect('login')->with('error', 'Email Salah!');
        }
    }
}



    public function actionlogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('message','Berhasil Logout!');
    }
}