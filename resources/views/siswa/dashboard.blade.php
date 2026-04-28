<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Siswa Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #eef2ff;
    margin: 0;
}

/* NAVBAR */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    padding: 15px 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.nav-left h3 {
    margin: 0;
    color: #2563eb;
}

.profile {
    position: relative;
    cursor: pointer;
}

.profile-btn {
    background: #2563eb;
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 14px;
}

.dropdown {
    position: absolute;
    right: 0;
    top: 45px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    width: 180px;
    display: none;
    overflow: hidden;
    z-index: 100;
}

.dropdown a,
.dropdown button {
    display: block;
    width: 100%;
    padding: 10px 15px;
    border: none;
    background: none;
    text-align: left;
    cursor: pointer;
    text-decoration: none;
    color: #111827;
}

.dropdown a:hover,
.dropdown button:hover {
    background: #f1f5f9;
}

.container {
    max-width: 1100px;
    margin: auto;
    padding: 30px 20px;
}

/* HEADER */
.dashboard-header {
    background: linear-gradient(135deg, #2563eb, #4f46e5);
    color: white;
    padding: 30px;
    border-radius: 20px;
    margin-bottom: 25px;
}

/* CARD */
.card {
    background: white;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}

/* GRID */
.row {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}
.col {
    flex: 1;
    min-width: 300px;
}

/* INPUT */
.input {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #ccc;
    margin-top: 5px;
}

/* BUTTON */
.btn {
    padding: 10px 18px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}
.btn-primary { background:#2563eb; color:white; }
.btn-success { background:#22c55e; color:white; }

/* BADGE */
.badge {
    padding: 8px 18px;
    border-radius: 999px;
}
.bg-warning { background:#fde68a; }
.bg-success { background:#22c55e; color:white; }
.bg-danger { background:#ef4444; color:white; }

.file-item {
    display:flex;
    justify-content:space-between;
    padding:10px;
    background:#f9fafb;
    border-radius:10px;
    margin-bottom:10px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="nav-left">
        <h3>PPDB</h3>
    </div>

    <div class="profile" onclick="toggleDropdown()">
        <div class="profile-btn">
            👤 {{ auth()->user()->name }}
        </div>

        <div class="dropdown" id="dropdownMenu">
            <a href="{{ route('profil.index') }}">Profil</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</div>

<div class="container">

<div class="dashboard-header">
    <h2>Dashboard Siswa</h2>
    <p>Selamat datang, {{ auth()->user()->name }}</p>
</div>

@if(!$siswa)

<div class="card">
    <h4>Belum daftar</h4>
    <a href="{{ route('siswa.pendaftaran.create') }}" class="btn btn-primary">Daftar</a>
</div>

@else

<!-- BUTTON -->
<div style="text-align:right; margin-bottom:10px;">
    <button onclick="toggleEdit()" id="editBtn" class="btn btn-primary">✏️ Edit Data</button>
</div>

<!-- ================= VIEW MODE ================= -->
<div id="viewMode">

<div class="row">
    <div class="col">
        <div class="card">
            <h5>Data Diri</h5>
            <p>Nama: {{ $siswa->nama }}</p>
            <p>NISN: {{ $siswa->nisn }}</p>
            <p>Sekolah: {{ $siswa->sekolah_asal }}</p>
        </div>
    </div>

    <div class="col">
        <div class="card">
            <h5>Status</h5>
            @if($siswa->status == 'pending')
                <span class="badge bg-warning">Pending</span>
            @elseif($siswa->status == 'diterima')
                <span class="badge bg-success">Diterima</span>
            @else
                <span class="badge bg-danger">Ditolak</span>
            @endif
        </div>
    </div>
</div>

<div class="card">
    <h5>Berkas</h5>
    @if($siswa->berkas)
        <div class="file-item">KK <a href="{{ asset('storage/'.$siswa->berkas->file_kk) }}" target="_blank">Lihat</a></div>
        <div class="file-item">Akta <a href="{{ asset('storage/'.$siswa->berkas->file_akta) }}" target="_blank">Lihat</a></div>
        <div class="file-item">Ijazah <a href="{{ asset('storage/'.$siswa->berkas->file_ijazah) }}" target="_blank">Lihat</a></div>
    @endif
</div>

</div>

<!-- ================= EDIT MODE ================= -->
<div id="editMode" style="display:none;">

<div class="card">
    <h5>Edit Data</h5>

    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama</label>
        <input type="text" name="nama" value="{{ $siswa->nama }}" class="input">

        <label>NISN</label>
        <input type="text" name="nisn" value="{{ $siswa->nisn }}" class="input">

        <label>Sekolah</label>
        <input type="text" name="sekolah_asal" value="{{ $siswa->sekolah_asal }}" class="input">

        <br><br>
        <button type="submit" class="btn btn-success">💾 Simpan</button>

        <div class="card"> <h5>Berkas</h5> @if($siswa->berkas) <div class="file-item">KK <a href="{{ asset('storage/'.$siswa->berkas->file_kk) }}" target="_blank">Lihat</a></div> <div class="file-item">Akta <a href="{{ asset('storage/'.$siswa->berkas->file_akta) }}" target="_blank">Lihat</a></div> <div class="file-item">Ijazah <a href="{{ asset('storage/'.$siswa->berkas->file_ijazah) }}" target="_blank">Lihat</a></div> @endif </div>
    </form>

</div>

</div>

@endif

</div>

<script>
function toggleEdit() {
    let view = document.getElementById('viewMode');
    let edit = document.getElementById('editMode');
    let btn = document.getElementById('editBtn');

    if (edit.style.display === "none") {
        view.style.display = "none";
        edit.style.display = "block";
        btn.innerText = "👁️ Lihat";
    } else {
        view.style.display = "block";
        edit.style.display = "none";
        btn.innerText = "✏️ Edit Data";
    }
}

function toggleDropdown() {
    let menu = document.getElementById("dropdownMenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

window.onclick = function(e) {
    if (!e.target.closest('.profile')) {
        document.getElementById("dropdownMenu").style.display = "none";
    }
}
</script>

</body>
</html>