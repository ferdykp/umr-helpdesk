<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->title = 'D-Bridge';
    }

    public function login()
    {
        // return view('auth.login', ['title' => $this->title]);
        return view('auth.login');
    }

    public function loginAuth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'     => 'required|username',
            'password'  => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'username'     => $request->username,
            'password'  => $request->password,
        ];

        if (Auth::attempt($data)) {
            if (Auth::user()->role == 'user' || Auth::user()->role == 'admin') {
                return redirect()->route('dashboard')->with('success', 'SignIn Berhasil');
            }
        } else {
            return redirect()->back()->withErrors('username atau Password salah')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout Berhasil');
    }
}
