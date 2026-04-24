@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Pendaftaran Siswa</h3>

    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <th>NISN</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach($siswa as $item)
        <tr>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->nisn }}</td>

            <td>
                @if($item->status == 'pending')
                    <span class="badge bg-warning">Pending</span>
                @elseif($item->status == 'diterima')
                    <span class="badge bg-success">Diterima</span>
                @else
                    <span class="badge bg-danger">Ditolak</span>
                @endif
            </td>

            <td>
                <a href="{{ route('pendaftaran.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('pendaftaran.terima', $item->id) }}" class="btn btn-success btn-sm">Diterima</a>
                <a href="{{ route('pendaftaran.tolak', $item->id) }}" class="btn btn-danger btn-sm">Ditolak</a>
            </td>
        </tr>
        @endforeach

    </table>

</div>
@endsection