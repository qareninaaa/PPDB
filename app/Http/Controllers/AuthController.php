<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // tampilkan form login
    public function login()
    {
        return view('auth.login');
    }

    // proses login
public function processLogin(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return back()->with('error', 'Email atau password salah');
    }

    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user->role === 'siswa') {
        return redirect()->route('siswa.dashboard');
    }

    Auth::logout();
    return redirect('/login')->with('error', 'Role tidak dikenali');
}
  

    // tampilkan register
    public function register()
    {
        return view('auth.register');
    }

    // proses register
    public function processRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        return redirect('/login')->with('success', 'Register berhasil!');
    }

    // logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}