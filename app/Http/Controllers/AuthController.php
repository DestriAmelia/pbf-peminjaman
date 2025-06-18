<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // login
    public function login()
    {
        return view('auth/login');
    }

    //loginProses
    public function loginProses(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'password' => 'required|min:4',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        $response = Http::post('http://localhost:8080/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful() && $response['status'] === true) {
            // Simpan token JWT ke session
            Session::put('token', $response['token']);
            Session::put('email', $request->email);
            Session::put('id_user', $request->id_user);
            Session::put('name', $request->name);
            Session::put('role', $request->role);

            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        } else {
            return redirect()->back()->with('error', 'Email atau password salah');
        }
    }

    //logout
    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect()->route('login')->with('success', 'Anda Berhasil Logout');
        //Logout bawaan Laravel (jaga-jaga)

    }
}
