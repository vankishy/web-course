<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthControllers extends Controller
{
    // SHOW PAGE REGISTER
    public function registerPage()
    {
        return view('auth.signup');
    }

    // HANDLE REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('signin')->with('success', 'Akun berhasil dibuat! Silakan Sign In.');
    }

    // SHOW PAGE LOGIN
    public function loginPage()
    {
        return view('auth.signin');
    }

    // HANDLE LOGIN
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau Password salah.');
    }

    // HANDLE LOGOUT
   public function logout(Request $request)
{
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('signin');
}

}
