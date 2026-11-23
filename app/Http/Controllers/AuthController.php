<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('is_logged_in')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($request->username === 'admin' && $request->password === 'rahasia') {
            session([
                'is_logged_in' => true,
                'username' => 'admin',
            ]);
            return redirect()->route('dashboard')->with('success', 'Berhasil login sebagai admin.');
        }

        return back()->withErrors(['login' => 'Username atau password salah!']);
    }

    public function logout()
    {
        session()->forget(['is_logged_in', 'username']);
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}