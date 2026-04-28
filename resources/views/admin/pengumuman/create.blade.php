@extends('layouts.app')

@section('content')
<div class="card-box">

    <h3>Buat Pengumuman</h3>

    <form action="{{ route('pengumuman.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Isi</label>
            <textarea name="isi" class="form-control" rows="5" required></textarea>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>

</div>
@endsection