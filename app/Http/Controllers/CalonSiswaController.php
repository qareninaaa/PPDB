<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\Berkas;
use Illuminate\Http\Request;

class CalonSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = CalonSiswa::all();
        return view('pages.calon_siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.calon_siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:calon_siswa,nisn',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'sekolah_asal' => 'required',
            'status' => 'required|in:pending,ditolak,diterima',
        ]);

        CalonSiswa::create([
            'user_id' => auth()->id(),
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'sekolah_asal' => $request->sekolah_asal,
            'status' => $request->status,
        ]);

        return redirect()->route('calon_siswa.index')->with('success', 'Calon Siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        return view('pages.calon_siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        return view('pages.calon_siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nisn' => 'required|unique:calon_siswa,nisn,' . $id,
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'sekolah_asal' => 'required',
            'status' => 'required|in:pending,ditolak,diterima',
        ]);

        $siswa = CalonSiswa::findOrFail($id);
        $siswa->update([
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'sekolah_asal' => $request->sekolah_asal,
            'status' => $request->status,
        ]);

        return redirect()->route('calon_siswa.index')->with('success', 'Calon Siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('calon_siswa.index')->with('success', 'Calon Siswa berhasil dihapus.');
    }
}
