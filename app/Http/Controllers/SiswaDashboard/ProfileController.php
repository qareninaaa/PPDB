<?php

namespace App\Http\Controllers\SiswaDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // TAMPIL HALAMAN
    public function index()
    {
        return view('siswa.profil');
    }

    // UPDATE PROFIL
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // kalau isi password baru
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diupdate');
    }
}