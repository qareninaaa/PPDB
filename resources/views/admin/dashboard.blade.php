<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard PPDB</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body {
    background: #f4f6fb;
}

/* SIDEBAR */
.sidebar {
    width: 250px;
    height: 100vh;
    background: linear-gradient(180deg, #2b6ef2, #1c4ed8);
    color: white;
    position: fixed;
    padding-top: 20px;
}

.sidebar h4 {
    padding-left: 20px;
}

.sidebar a {
    color: white;
    display: block;
    padding: 12px 20px;
    text-decoration: none;
}

.sidebar a:hover {
    background: rgba(255,255,255,0.1);
    border-radius: 8px;
}

/* CONTENT */
.content {
    margin-left: 260px;
    padding: 30px;
}

/* CARD */
.card-box {
    border-radius: 15px;
    padding: 20px;
    background: white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

/* ICON */
.icon-box {
    width: 50px;
    height: 50px;
    background: #2b6ef2;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
}

/* STATUS */
.status-diterima {
    background: #d1fae5;
    color: #059669;
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 12px;
}

.status-pending {
    background: #fef3c7;
    color: #d97706;
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 12px;
}

.status-ditolak {
    background: #fee2e2;
    color: #dc2626;
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 12px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4>PPDB Admin</h4>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('datasiswa.index') }}">Data Siswa</a>
    <a href="{{ route('pendaftaran.index') }}">Pendaftaran</a>
    <a href="{{ route('pengumuman.index') }}">Pengumuman</a>
    <a href="{{ route('admin.profile') }}">Profile</a>
    

    <form action="{{ route('logout') }}" method="POST" style="margin: 20px;">
        @csrf
        <button type="submit" class="btn btn-light w-100">Logout</button>
    </form>
</div>

<!-- CONTENT -->
<div class="content">

    <h4 class="mb-4">Dashboard</h4>

    <!-- STATISTIK -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card-box d-flex justify-content-between">
                <div>
                    <p>Total Siswa</p>
                    <h3>{{ $totalSiswa }}</h3>
                </div>
                <div class="icon-box">👥</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box d-flex justify-content-between">
                <div>
                    <p>Pendaftar Baru</p>
                    <h3>{{ $pendaftarBaru }}</h3>
                </div>
                <div class="icon-box">📝</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box d-flex justify-content-between">
                <div>
                    <p>Diterima</p>
                    <h3>{{ $diterima }}</h3>
                </div>
                <div class="icon-box">✅</div>
            </div>
        </div>

    </div>

    <!-- TABEL -->
    <div class="card-box mb-4">
        <div class="d-flex justify-content-between mb-3">
            <h5>Data Siswa Terbaru</h5>
            <a href="{{ route('datasiswa.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswaTerbaru as $siswa)
                <tr>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>
                        @if($siswa->status == 'diterima')
                            <span class="status-diterima">Diterima</span>
                        @elseif($siswa->status == 'ditolak')
                            <span class="status-ditolak">Ditolak</span>
                        @else
                            <span class="status-pending">Pending</span>
                        @endif
                    </td>
                    <td>{{ $siswa->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- GRAFIK (SUDAH DI PALING BAWAH) -->
    <div class="card-box">
        <h5 class="mb-3">Grafik Status Pendaftaran PPDB</h5>
        <canvas id="ppdbChart" height="100"></canvas>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('ppdbChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pending', 'Diterima', 'Ditolak'],
            datasets: [{
                label: 'Jumlah Siswa',
                data: [
                    {{ $pendaftar }},
                    {{ $diterima }},
                    {{ $ditolak }}
                ],
                backgroundColor: [
                    '#f59e0b',
                    '#16a34a',
                    '#dc2626'
                ],
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

});
</script>

</body>
</html>