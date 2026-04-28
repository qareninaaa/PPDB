<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Profile Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f4f6fb;
}

.sidebar {
    width: 250px;
    height: 100vh;
    background: linear-gradient(180deg, #2b6ef2, #1c4ed8);
    color: white;
    position: fixed;
    padding-top: 20px;
}

.sidebar a {
    color: white;
    display: block;
    padding: 12px 20px;
    text-decoration: none;
}

.sidebar a:hover {
    background: rgba(255,255,255,0.1);
}

.content {
    margin-left: 260px;
    padding: 30px;
}

.card-box {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4 class="px-3">PPDB Admin</h4>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('datasiswa.index') }}">Data Siswa</a>
    <a href="{{ route('pendaftaran.index') }}">Pendaftaran</a>
    <a href="{{ route('pengumuman.index') }}">Pengumuman</a>
    <a href="{{ route('admin.profile') }}">Profile</a>

    <form action="{{ route('logout') }}" method="POST" style="margin: 20px;">
        @csrf
        <button class="btn btn-light w-100">Logout</button>
    </form>
</div>

<!-- CONTENT -->
<div class="content">

    <h4 class="mb-4">Profile Admin</h4>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-box">

        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control">
            </div>

            <hr>

            <h6>Ganti Password</h6>

            <div class="mb-3">
                <label>Password Baru</label>
                <input type="password" name="password" class="form-control">
                <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <button class="btn btn-primary">💾 Update Profile</button>
        </form>

    </div>

</div>

</body>
</html>