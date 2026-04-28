<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Models\CalonSiswa;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $totalSiswa = CalonSiswa::count();
        $pendaftarBaru = CalonSiswa::whereMonth('created_at', date('m'))->count();
        $pendaftar = CalonSiswa::where('status', 'pending')->count();
        $diterima = CalonSiswa::where('status', 'diterima')->count();
        $ditolak = CalonSiswa::where('status', 'ditolak')->count();

        $siswaTerbaru = CalonSiswa::latest()->take(5)->get();

        return view('admin/dashboard', compact(
            'totalSiswa',
            'pendaftarBaru',
            'pendaftar',
            'diterima',
            'ditolak',
            'siswaTerbaru'
        ));

        
    }

    public function destroy($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('datasiswa.index')->with('success', 'Data berhasil dihapus');
    }
}