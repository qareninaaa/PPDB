<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #eef2ff, #dbeafe);
    margin: 0;
}

/* CONTAINER */
.container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* CARD */
.card {
    width: 100%;
    max-width: 480px;
    background: white;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
}

/* TITLE */
.title {
    text-align: center;
    margin-bottom: 25px;
}

.title h2 {
    margin: 0;
}

.title p {
    font-size: 14px;
    color: #6b7280;
}

/* LABEL */
label {
    font-size: 13px;
    font-weight: 500;
    color: #374151;
}

/* INPUT */
.input {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: 1px solid #d1d5db;
    margin: 6px 0 16px;
    transition: 0.2s;
    font-size: 14px;
}

.input:focus {
    border-color: #2563eb;
    outline: none;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
}

/* SECTION */
.section {
    margin-top: 10px;
}

.section-title {
    font-weight: 600;
    margin-bottom: 10px;
}

/* DIVIDER */
.divider {
    height: 1px;
    background: #e5e7eb;
    margin: 20px 0;
}

/* BUTTON GROUP */
.actions {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

/* BUTTON */
.btn {
    flex: 1;
    padding: 12px;
    border-radius: 12px;
    border: none;
    font-weight: 500;
    cursor: pointer;
    transition: 0.2s;
}

/* PRIMARY */
.btn-primary {
    background: #2563eb;
    color: white;
}

.btn-primary:hover {
    background: #1e40af;
}

/* SECONDARY */
.btn-secondary {
    background: #e5e7eb;
    color: #374151;
    text-decoration: none;
    text-align: center;
}

.btn-secondary:hover {
    background: #d1d5db;
}

/* ALERT */
.alert {
    background: #dcfce7;
    color: #166534;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 15px;
    font-size: 13px;
}
</style>
</head>

<body>

<div class="container">

<div class="card">

    <div class="title">
        <h2>Profil User</h2>
        <p>Kelola informasi akun kamu</p>
    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profil.update') }}">
        @csrf
        @method('PUT')

        <!-- DATA -->
        <div class="section">
            <label>Nama</label>
            <input type="text" name="name" value="{{ auth()->user()->name }}" class="input">

            <label>Email</label>
            <input type="email" name="email" value="{{ auth()->user()->email }}" class="input">
        </div>

        <div class="divider"></div>

        <!-- PASSWORD -->
        <div class="section">
            <div class="section-title">Ganti Password</div>

            <input type="password" name="password" placeholder="Password baru" class="input">
            <input type="password" name="password_confirmation" placeholder="Konfirmasi password" class="input">
        </div>

        <!-- BUTTON -->
        <div class="actions">
            <button class="btn btn-primary">💾 Simpan</button>

            <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary">
                ← Kembali
            </a>
        </div>

    </form>

</div>

</div>

</body>
</html>