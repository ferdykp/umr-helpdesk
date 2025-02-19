<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        // echo 'hello';
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'username wajib diisi',
                'password.required' => 'Password wajib diisi'
            ]
        );
        $infologin = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            // return redirect('dashboard');
            if (Auth::user()->role == 'user') {
                return redirect('dashboard/user');
            } elseif (Auth::user()->role == 'admin') {
                return redirect('dashboard/admin');
            }
        } else {
            return redirect('')->withErrors('username atau Password salah')->withInput();
        }
    }
    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
