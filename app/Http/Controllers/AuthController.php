<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            if(Auth::user()->role == 'admin')
            {
                return redirect('/admin/dashboard');
            }

            return redirect('/kasir/dashboard');
        }

        return back()->with('error','Email atau Password Salah');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}