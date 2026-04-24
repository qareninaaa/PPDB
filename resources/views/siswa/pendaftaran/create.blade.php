<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Siswa</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    
</body>
</html>
<div class="container">

    <div class="card-box">
        <h3 class="mb-3">Form Pendaftaran Siswa</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('siswa.pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="nisn" placeholder="NISN" class="form-control mb-2">
            <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control mb-2">
            <input type="text" name="alamat" placeholder="Alamat" class="form-control mb-2">

            <input type="date" name="tanggal_lahir" class="form-control mb-2">

            <select name="jenis_kelamin" class="form-control mb-2">
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>

            <input type="text" name="sekolah_asal" placeholder="Sekolah Asal" class="form-control mb-3">

            <label>Upload KK</label>
            <input type="file" name="file_kk" class="form-control mb-2">

            <label>Upload Akta</label>
            <input type="file" name="file_akta" class="form-control mb-2">

            <label>Upload Ijazah</label>
            <input type="file" name="file_ijazah" class="form-control mb-2">

            <button class="btn btn-primary w-100">Daftar Sekarang</button>
        </form>
    </div>

</div>