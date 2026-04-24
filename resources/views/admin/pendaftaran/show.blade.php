@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Detail Siswa</h3>

    <table class="table table-bordered">
        <tr><th>Nama</th><td>{{ $siswa->nama }}</td></tr>
        <tr><th>NISN</th><td>{{ $siswa->nisn }}</td></tr>
        <tr><th>Alamat</th><td>{{ $siswa->alamat }}</td></tr>
        <tr><th>Sekolah</th><td>{{ $siswa->sekolah_asal }}</td></tr>
        <tr><th>Status</th><td>{{ $siswa->status }}</td></tr>
    </table>

    <h4 class="mt-4">Berkas Siswa</h4>

    @if($siswa->berkas)
    <table class="table table-bordered">
        <tr>
            <th>File KK</th>
            <td>
                <a href="{{ asset('storage/'.$siswa->berkas->file_kk) }}" target="_blank" class="btn btn-primary btn-sm">
                    Lihat KK
                </a>
            </td>
        </tr>

        <tr>
            <th>File Akta</th>
            <td>
                <a href="{{ asset('storage/'.$siswa->berkas->file_akta) }}" target="_blank" class="btn btn-info btn-sm">
                    Lihat Akta
                </a>
            </td>
        </tr>

        <tr>
            <th>File Ijazah</th>
            <td>
                <a href="{{ asset('storage/'.$siswa->berkas->file_ijazah) }}" target="_blank" class="btn btn-success btn-sm">
                    Lihat Ijazah
                </a>
            </td>
        </tr>
    </table>
    @else
        <div class="alert alert-warning">Berkas belum diupload</div>
    @endif

</div>
@endsection