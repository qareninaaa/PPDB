<?php

namespace App\Http\Controllers\SiswaDashboard;

use App\Models\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = CalonSiswa::with('berkas')->where('user_id', auth()->id())->first();

        return view('siswa.dashboard', compact('siswa'));
    }

    public function update(Request $request, $id)
{
    $siswa = CalonSiswa::with('berkas')->findOrFail($id);

    // VALIDASI
    $request->validate([
        'nama' => 'required|string|max:255',
        'nisn' => 'required|string|max:20',
        'sekolah_asal' => 'required|string|max:255',

        'file_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'file_akta' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'file_ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    // UPDATE DATA SISWA
    $siswa->update([
        'nama' => $request->nama,
        'nisn' => $request->nisn,
        'sekolah_asal' => $request->sekolah_asal,
    ]);

    // CEK / BUAT DATA BERKAS
    $berkas = $siswa->berkas;
    if (!$berkas) {
        $berkas = $siswa->berkas()->create([]);
    }

    // 🔥 FUNCTION UNTUK HANDLE FILE
    function updateFile($requestFile, $oldFile)
    {
        if ($requestFile) {
            // hapus file lama
            if ($oldFile && Storage::disk('public')->exists($oldFile)) {
                Storage::disk('public')->delete($oldFile);
            }

            // simpan file baru
            return $requestFile->store('berkas', 'public');
        }

        return $oldFile;
    }

    // UPDATE FILE
    $berkas->file_kk = updateFile($request->file('file_kk'), $berkas->file_kk);
    $berkas->file_akta = updateFile($request->file('file_akta'), $berkas->file_akta);
    $berkas->file_ijazah = updateFile($request->file('file_ijazah'), $berkas->file_ijazah);

    $berkas->save();

    return redirect()->back()->with('success', 'Data berhasil diperbarui');
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
  

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
