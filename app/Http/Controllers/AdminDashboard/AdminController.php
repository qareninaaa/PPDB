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
        $diterima = CalonSiswa::where('status', 'diterima')->count();

        $siswaTerbaru = CalonSiswa::latest()->take(5)->get();

        return view('admin/dashboard', compact(
            'totalSiswa',
            'pendaftarBaru',
            'diterima',
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