<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\CalonSiswa;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $query = CalonSiswa::with('berkas');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where('nama', 'like', '%'.$request->search.'%')
                  ->orWhere('nisn', 'like', '%'.$request->search.'%');
        }

        $siswa = $query->latest()->paginate(10);

        return view('admin.pendaftaran.index', compact('siswa'));
    }

    public function show($id)
    {
        $siswa = CalonSiswa::with('berkas')->findOrFail($id);
        return view('admin.pendaftaran.show', compact('siswa'));
    }

    public function terima($id)
    {
        $siswa = CalonSiswa::findOrFail($id);

        if ($siswa->status == 'diterima') {
            return back()->with('error', 'Sudah diterima!');
        }

        $siswa->update(['status' => 'diterima']);

        return back()->with('success', 'Siswa diterima');
    }

    public function tolak($id)
    {
        $siswa = CalonSiswa::findOrFail($id);

        if ($siswa->status == 'ditolak') {
            return back()->with('error', 'Sudah ditolak!');
        }

        $siswa->update(['status' => 'ditolak']);

        return back()->with('success', 'Siswa ditolak');
    }
}