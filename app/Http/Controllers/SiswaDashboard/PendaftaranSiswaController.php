<?php

namespace App\Http\Controllers\SiswaDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\Berkas;

class PendaftaranSiswaController extends Controller
{
    public function index()
    {
        $siswa = CalonSiswa::where('user_id', auth()->id())->with('berkas')->first();

        return view('siswa.pendaftaran.create', compact('siswa'));
    }
    // FORM
    public function create()
    {
        // cek apakah user sudah daftar
        $cek = CalonSiswa::where('user_id', auth()->id())->first();

        if ($cek) {
            return redirect('/siswa/dashboard')->with('error', 'Kamu sudah melakukan pendaftaran!');
        }

        return view('siswa.pendaftaran.create');
    }

    // SIMPAN
    public function store(Request $request)
    {
        $request->validate([
        'nisn' => 'required|unique:calon_siswa,nisn',
        'nama' => 'required',
        'alamat' => 'required',
        'tanggal_lahir' => 'required',
        'jenis_kelamin' => 'required',
        'sekolah_asal' => 'required',

        'file_kk' => 'required|file|mimes:pdf,jpg,png',
        'file_akta' => 'required|file|mimes:pdf,jpg,png',
        'file_ijazah' => 'required|file|mimes:pdf,jpg,png',
    ]);

    // simpan data siswa
    $siswa = CalonSiswa::create([
        'user_id' => auth()->id(),
        'nisn' => $request->nisn,
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'sekolah_asal' => $request->sekolah_asal,
        'status' => 'pending'
    ]);

    // upload file
    $kk = $request->file('file_kk')->store('berkas', 'public');
    $akta = $request->file('file_akta')->store('berkas', 'public');
    $ijazah = $request->file('file_ijazah')->store('berkas', 'public');

    // simpan ke tabel berkas
    Berkas::create([
        'calon_siswa_id' => $siswa->id,
        'file_kk' => $kk,
        'file_akta' => $akta,
        'file_ijazah' => $ijazah
    ]);

    return redirect('/siswa/dashboard')->with('success', 'Pendaftaran berhasil!');
    }
}