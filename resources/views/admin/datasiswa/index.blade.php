@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Data Siswa</h3>

    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NISN</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($siswa as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nisn }}</td>

                <td>
                    @if($item->status == 'diterima')
                        <span class="badge bg-success">Diterima</span>
                    @elseif($item->status == 'ditolak')
                        <span class="badge bg-danger">Ditolak</span>
                    @else
                        <span class="badge bg-warning">Pending</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('datasiswa.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('datasiswa.destroy', $item->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>

                    <a href="{{ route('datasiswa.terima', $item->id) }}" class="btn btn-success btn-sm">Diterima</a>
                    <a href="{{ route('datasiswa.tolak', $item->id) }}" class="btn btn-secondary btn-sm">Ditolak</a>
                    <a href="{{ route('datasiswa.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection