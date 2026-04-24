@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4">Detail Siswa</h3>

    <div class="card-box">

        <table class="table table-bordered">
            <tr>
                <th>NISN</th>
                <td>{{ $siswa->nisn }}</td>
            </tr>

            <tr>
                <th>Nama</th>
                <td>{{ $siswa->nama }}</td>
            </tr>

            <tr>
                <th>Alamat</th>
                <td>{{ $siswa->alamat }}</td>
            </tr>

            <tr>
                <th>Tanggal Lahir</th>
                <td>{{ $siswa->tanggal_lahir }}</td>
            </tr>

            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $siswa->jenis_kelamin }}</td>
            </tr>

            <tr>
                <th>Sekolah Asal</th>
                <td>{{ $siswa->sekolah_asal }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    @if($siswa->status == 'diterima')
                        <span class="badge bg-success">Diterima</span>
                    @elseif($siswa->status == 'ditolak')
                        <span class="badge bg-danger">Ditolak</span>
                    @else
                        <span class="badge bg-warning">Pending</span>
                    @endif
                </td>
            </tr>

        </table>

        <a href="{{ route('datasiswa.index') }}" class="btn btn-secondary">Kembali</a>

    </div>

</div>
@endsection