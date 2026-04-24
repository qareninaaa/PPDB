@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Edit Siswa</h3>

    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="nisn" value="{{ $siswa->nisn }}" class="form-control mb-2">
        <input type="text" name="nama" value="{{ $siswa->nama }}" class="form-control mb-2">
        <input type="text" name="alamat" value="{{ $siswa->alamat }}" class="form-control mb-2">
        <input type="date" name="tanggal_lahir" value="{{ $siswa->tanggal_lahir }}" class="form-control mb-2">

        <select name="jenis_kelamin" class="form-control mb-2">
            <option value="L" {{ $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>

        <input type="text" name="sekolah_asal" value="{{ $siswa->sekolah_asal }}" class="form-control mb-2">

        <select name="status" class="form-control mb-2">
            <option value="pending" {{ $siswa->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="diterima" {{ $siswa->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
            <option value="ditolak" {{ $siswa->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>

        <button class="btn btn-primary">Update</button>
    </form>

</div>
@endsection