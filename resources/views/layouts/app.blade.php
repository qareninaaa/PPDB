<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PPDB Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, #2b6ef2, #1c4ed8);
            color: white;
        }

        .sidebar h4 {
            padding: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .card-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        /* ===== BODY ===== */
body {
    background: #f4f6fb;
    font-family: 'Poppins', sans-serif;
}

/* ===== SIDEBAR ===== */
.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    background: linear-gradient(180deg, #2b6ef2, #1c4ed8);
    color: white;
    padding-top: 20px;
}

.sidebar h4 {
    padding: 15px 20px;
    font-weight: 600;
}

.sidebar a {
    display: block;
    color: white;
    padding: 12px 20px;
    text-decoration: none;
    transition: 0.3s;
}

.sidebar a:hover {
    background: rgba(255,255,255,0.15);
    border-radius: 10px;
}

/* ===== CONTENT ===== */
.content {
    margin-left: 260px;
    padding: 20px;
}

/* ===== CARD ===== */
.card-box {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}

/* ===== TABLE ===== */
.table {
    background: white;
    border-radius: 10px;
    overflow: hidden;
}

.table th {
    background: #2b6ef2;
    color: white;
    text-align: center;
}

.table td {
    vertical-align: middle;
}

/* ===== BADGE STATUS ===== */
.badge {
    padding: 6px 10px;
    border-radius: 10px;
    font-size: 12px;
}

.bg-success {
    background-color: #16a34a !important;
}

.bg-warning {
    background-color: #f59e0b !important;
    color: black;
}

.bg-danger {
    background-color: #dc2626 !important;
}

/* ===== BUTTON ===== */
.btn {
    border-radius: 10px;
    font-size: 13px;
}

.btn-info {
    background: #0ea5e9;
    color: white;
}

.btn-warning {
    background: #f59e0b;
    color: white;
}

.btn-danger {
    background: #dc2626;
}

.btn-success {
    background: #16a34a;
}

/* ===== FORM ===== */
input, select {
    border-radius: 10px !important;
    padding: 10px !important;
}

input:focus, select:focus {
    border-color: #2b6ef2 !important;
    box-shadow: 0 0 0 0.2rem rgba(43,110,242,0.25);
}

/* ===== HEADER ===== */
h3 {
    font-weight: 600;
    margin-bottom: 20px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .sidebar {
        width: 200px;
    }

    .content {
        margin-left: 210px;
    }
}
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="p-3">PPDB Admin</h4>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('datasiswa.index') }}">Data Siswa</a>
    <a href="{{ route('pendaftaran.index') }}">Pendaftaran</a>
    <a href="#">Pengumuman</a>
    <form action="{{ route('logout') }}" method="POST" style="margin: 20px;">
    @csrf
    <button type="submit" class="btn btn-light w-100">Logout</button>
</form>
</div>

<!-- Content -->
<div class="content">
    @yield('content')
</div>

</body>
</html>