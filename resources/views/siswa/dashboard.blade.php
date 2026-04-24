<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
   <div class="content dashboard-user">

    <div class="dashboard-header">
        <h2>Dashboard User</h2>
        <p>Selamat datang di sistem PPDB</p>
    </div>

    @if(!$siswa)
        <div class="empty-state">
            <h4>Kamu belum melakukan pendaftaran</h4>
            <p>Silakan lakukan pendaftaran terlebih dahulu</p>

            <a href="{{ route('siswa.pendaftaran.create') }}" class="btn-daftar">
                Daftar Sekarang
            </a>
        </div>
    @else

    <div class="row">

        <!-- DATA DIRI -->
        <div class="col-md-6">
            <div class="card-box">
                <h5>Data Diri</h5>
                <p><b>Nama:</b> {{ $siswa->nama }}</p>
                <p><b>NISN:</b> {{ $siswa->nisn }}</p>
                <p><b>Sekolah:</b> {{ $siswa->sekolah_asal }}</p>
            </div>
        </div>

        <!-- STATUS -->
        <div class="col-md-6">
            <div class="card-box">
                <h5>Status Pendaftaran</h5>

                @if($siswa->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @elseif($siswa->status == 'diterima')
                    <span class="badge bg-success">Diterima</span>
                @else
                    <span class="badge bg-danger">Ditolak</span>
                @endif

            </div>
        </div>

    </div>

    <!-- BERKAS -->
    <div class="card-box mt-4">
        <h5>Berkas</h5>

        @if($siswa->berkas)
            <ul>
                <li>
                    <a href="{{ asset('storage/'.$siswa->berkas->file_kk) }}" target="_blank">Lihat KK</a>
                </li>
                <li>
                    <a href="{{ asset('storage/'.$siswa->berkas->file_akta) }}" target="_blank">Lihat Akta</a>
                </li>
                <li>
                    <a href="{{ asset('storage/'.$siswa->berkas->file_ijazah) }}" target="_blank">Lihat Ijazah</a>
                </li>
            </ul>
        @else
            <div class="alert alert-danger">Berkas belum diupload</div>
        @endif
    </div>

    @endif

</div>
</body>
</html>
