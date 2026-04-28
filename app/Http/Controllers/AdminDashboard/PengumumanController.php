<?php

namespace App\Http\Controllers\AdminDashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->get();
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required'
        ]);

        Pengumuman::create($request->all());

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Pengumuman::findOrFail($id)->delete();

        return redirect()->back()
            ->with('success', 'Pengumuman dihapus');
    }
}
