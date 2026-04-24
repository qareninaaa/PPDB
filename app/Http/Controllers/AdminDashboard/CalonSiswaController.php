<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CalonSiswa;

class CalonSiswaController extends Controller
{
    public function index()
    {
        $siswa = CalonSiswa::where('status', 'diterima')->get();
        return view('admin.datasiswa.index', compact('siswa'));
    }

    public function show($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        return view('admin.datasiswa.show', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        return view('admin.datasiswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('datasiswa.index');
    }

    public function destroy($id)
    {
        CalonSiswa::destroy($id);
        return back();
    }
}