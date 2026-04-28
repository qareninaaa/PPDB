<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Pendaftaran Siswa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(120deg, #eef2ff, #f8fafc);
    margin: 0;
}

/* CONTAINER */
.container {
    max-width: 700px;
    margin: auto;
    padding: 40px 20px;
}

/* CARD */
.card {
    background: white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

/* TITLE */
.card h3 {
    margin-bottom: 20px;
    font-weight: 600;
}

/* GROUP */
.form-group {
    margin-bottom: 15px;
}

label {
    font-size: 14px;
    font-weight: 500;
    display: block;
    margin-bottom: 5px;
}

/* INPUT */
.form-control {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    outline: none;
    transition: 0.2s;
}

.form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
}

/* FILE */
input[type="file"] {
    padding: 8px;
    background: #f9fafb;
}

/* SECTION */
.section-title {
    margin-top: 20px;
    margin-bottom: 10px;
    font-weight: 600;
    color: #374151;
}

/* BUTTON */
.btn {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #2563eb, #4f46e5);
    color: white;
    font-weight: 500;
    cursor: pointer;
    margin-top: 15px;
    transition: 0.2s;
}

.btn:hover {
    opacity: 0.9;
}

/* ALERT */
.alert {
    background: #fee2e2;
    color: #b91c1c;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 15px;
}
</style>

</head>
<body>

<div class="container">

    <div class="card">
        <h3>📋 Form Pendaftaran Siswa</h3>

        @if(session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif

        <form action="{{ route('siswa.pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- DATA DIRI -->
            <div class="section-title">Data Diri</div>

            <div class="form-group">
                <label>NISN</label>
                <input type="text" name="nisn" class="form-control">
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control">
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control">
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control">
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option value="">-- Pilih --</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Sekolah Asal</label>
                <input type="text" name="sekolah_asal" class="form-control">
            </div>

            <!-- BERKAS -->
            <div class="section-title">Upload Berkas</div>

            <div class="form-group">
                <label>Upload KK</label>
                <input type="file" name="file_kk" class="form-control">
            </div>

            <div class="form-group">
                <label>Upload Akta</label>
                <input type="file" name="file_akta" class="form-control">
            </div>

            <div class="form-group">
                <label>Upload Ijazah</label>
                <input type="file" name="file_ijazah" class="form-control">
            </div>

            <button class="btn">Daftar Sekarang</button>
        </form>
    </div>

</div>

</body>
</html>