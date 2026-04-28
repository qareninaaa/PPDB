@extends('layouts.app')

@section('content')
<div class="card-box">

    <h3>Pengumuman</h3>

    <a href="{{ route('pengumuman.create') }}" class="btn btn-primary mb-3">
        + Tambah Pengumuman
    </a>

    @foreach($pengumuman as $p)
        <div class="card mb-3 p-3">
            <h5>{{ $p->judul }}</h5>
            <p>{{ $p->isi }}</p>

            <form action="{{ route('pengumuman.destroy', $p->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </div>
    @endforeach

</div>
@endsection