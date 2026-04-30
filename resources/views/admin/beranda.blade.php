<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Beranda - Admin {{ session('user_name') }}</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Poppins', sans-serif; background: #f5f6f8; color: #333; }
.container { display: flex; min-height: 100vh; }

/* SIDEBAR */
.sidebar {
    width: 220px; background: #eef2ef; min-height: 100vh;
    padding: 20px 15px; position: fixed; left: 0; top: 0;
    transition: all 0.3s ease; z-index: 1000;
}
.logo { display: flex; justify-content: center; margin-bottom: 30px; }
.logo img { width: 100px; }
.menu { display: flex; flex-direction: column; gap: 10px; }
.menu a {
    text-decoration: none; padding: 12px 18px; border-radius: 15px;
    font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 12px;
    color: #333; background: white; transition: all 0.3s ease;
}
.menu a i { font-size: 16px; width: 20px; text-align: center; }
.menu a.active { background: #52C396; color: white; box-shadow: 0 3px 10px rgba(82,195,150,0.3); }
.menu a:hover:not(.active) { transform: translateX(5px); background: #dff5ec; }
.menu a.logout { background: #fee2e2; color: #dc2626; margin-top: 10px; }
.menu a.logout:hover { background: #fecaca; transform: translateX(5px); }

/* MAIN */
.main { flex: 1; margin-left: 220px; padding: 25px; transition: all 0.3s ease; }

/* TOP BAR */
.topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
.topbar h2 { font-size: 20px; font-weight: 700; color: #1f2937; }
.topbar .admin-info { font-size: 13px; color: #6b7280; }
.topbar .admin-info span { font-weight: 700; color: #374151; }

/* WISATA CARD */
.wisata-card {
    background: white; border-radius: 18px; padding: 24px;
    box-shadow: 0 3px 10px rgba(0,0,0,.06); margin-bottom: 24px;
    display: flex; gap: 24px; align-items: flex-start; flex-wrap: wrap;
}
.wisata-img { width: 260px; height: 180px; object-fit: cover; border-radius: 14px; flex-shrink: 0; }
.wisata-info { flex: 1; min-width: 200px; }
.wisata-info h3 { font-size: 20px; font-weight: 800; margin-bottom: 6px; }
.wisata-info .lokasi { color: #6b7280; font-size: 13px; margin-bottom: 14px; }
.harga-pills { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 14px; }
.pill { padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }
.pill-green { background: #e6f7ee; color: #065f46; }
.pill-amber { background: #fef3c7; color: #92400e; }
.wisata-desc { font-size: 13px; color: #4b5563; line-height: 1.6; margin-bottom: 18px; }
.btn-edit {
    display: inline-block; background: #52C396; color: white;
    padding: 10px 24px; border-radius: 10px; font-weight: 700;
    text-decoration: none; font-size: 14px; transition: all .2s;
}
.btn-edit:hover { background: #3fb27f; transform: translateY(-1px); }

/* CARDS */
.cards-container { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 24px; }
.card {
    background: white; border-radius: 15px; padding: 20px;
    display: flex; align-items: center; gap: 15px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05); transition: transform 0.3s;
}
.card:hover { transform: translateY(-3px); }
.card-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
.card-icon.pendapatan { background: #e8f5f0; color: #52C396; }
.card-icon.tiket { background: #fff3e0; color: #ff9800; }
.card-icon.transaksi { background: #e3f2fd; color: #2196f3; }
.card-content h4 { margin: 0 0 4px; font-size: 12px; color: #888; }
.card-content p { margin: 0; font-size: 18px; font-weight: 700; color: #1f2937; }

/* CHART & DATE */
.content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 24px; }
.chart-box, .date-box { background: white; border-radius: 20px; padding: 20px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); }
.chart-header { display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center; }
.chart-container { position: relative; height: 250px; }
.date-display {
    background: #f0f7ff; padding: 12px; border-radius: 10px;
    display: flex; align-items: center; gap: 10px; cursor: pointer; margin-bottom: 15px;
}

/* TABLE */
.table-box { background: white; border-radius: 20px; padding: 20px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); }
.table-header { display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center; }
.table-responsive { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; min-width: 700px; }
thead { background: #a5e7c0; }
th, td { padding: 12px 10px; text-align: left; font-size: 13px; white-space: nowrap; }
td { border-bottom: 1px solid #eee; }
.status-badge { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
.status-sukses { background: #d4edda; color: #155724; }
.empty-row td { text-align: center; color: #9ca3af; padding: 32px; }

/* HAMBURGER */
.menu-toggle {
    display: none; position: fixed; top: 15px; left: 15px; z-index: 1001;
    background: #52C396; color: white; border: none;
    width: 45px; height: 45px; border-radius: 10px;
    font-size: 20px; cursor: pointer;
}
.overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999; }

/* ALERT */
.alert-success {
    background: #d1fae5; border: 1px solid #6ee7b7; color: #065f46;
    padding: 12px 18px; border-radius: 12px; margin-bottom: 20px; font-weight: 600;
}

@media (max-width: 1024px) { .content-grid { grid-template-columns: 1fr; } }
@media (max-width: 768px) {
    .sidebar { transform: translateX(-100%); }
    .sidebar.active { transform: translateX(0); }
    .main { margin-left: 0; padding: 15px; padding-top: 70px; }
    .menu-toggle { display: block; }
    .overlay.active { display: block; }
    .cards-container { grid-template-columns: 1fr; }
    .wisata-card { flex-direction: column; }
    .wisata-img { width: 100%; height: 200px; }
}
</style>
</head>
<body>

<button class="menu-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
<div class="overlay" onclick="toggleSidebar()"></div>

<div class="container">
<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="logo">
        <img src="{{ asset('images/logo-abirupa.png') }}" alt="Logo">
    </div>
    <div class="menu">
        <a href="{{ route('admin.beranda') }}" class="active"><i class="fas fa-home"></i> Beranda</a>
        @if($wisata)
        <a href="{{ route('admin.edit') }}"><i class="fas fa-edit"></i> Edit Wisata</a>
        @endif
        <a href="{{ route('admin.profil') }}"><i class="fas fa-user"></i> Profil</a>
        <a href="#" class="logout" onclick="confirmLogout(event)"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">

    <!-- TOP BAR -->
    <div class="topbar">
        <div>
            <h2>Dashboard Admin</h2>
            <div class="admin-info">Halo, <span>{{ session('user_name') }}</span> 👋</div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
    @endif

    {{-- WISATA MILIK ADMIN --}}
    @if($wisata)
    <div class="wisata-card">
<img class="wisata-img"
     src="{{ $wisata->gambar && file_exists(public_path('images/destinasi/' . $wisata->gambar)) 
            ? asset('images/destinasi/' . $wisata->gambar) 
            : asset('images/icon/Generic_avatar.png') }}"
     alt="{{ $wisata->nama_wisata }}"
     onerror="this.src='{{ asset('images/icon/Generic_avatar.png') }}'">
     
        <div class="wisata-info">
            <h3>{{ $wisata->nama_wisata }}</h3>
            <div class="lokasi">📍 {{ $wisata->lokasi }}</div>
            <div class="harga-pills">
                <span class="pill pill-green">Dewasa: Rp {{ number_format($wisata->tiket_dewasa, 0, ',', '.') }}</span>
                <span class="pill pill-green">Anak: Rp {{ number_format($wisata->tiket_anak, 0, ',', '.') }}</span>
                <span class="pill pill-amber">Asuransi: Rp {{ number_format($wisata->biaya_asuransi ?? 500, 0, ',', '.') }}/org</span>
            </div>
            <div class="wisata-desc">{{ $wisata->deskripsi ?: 'Belum ada deskripsi.' }}</div>
            <a href="{{ route('admin.edit') }}" class="btn-edit">✏️ Edit Wisata Saya</a>
        </div>
    </div>
    @else
    <div style="text-align:center;padding:60px;background:white;border-radius:18px;margin-bottom:24px;color:#9ca3af;">
        <p style="font-size:40px;margin-bottom:12px;">🏔️</p>
        <p style="font-size:16px;font-weight:600;color:#475569;">Belum ada wisata yang dipegang</p>
        <p style="font-size:13px;margin-top:8px;">Hubungi super admin untuk assign wisata ke akun ini.</p>
    </div>
    @endif

    {{-- STATISTIK CARDS --}}
    <div class="cards-container">
        <div class="card">
            <div class="card-icon pendapatan"><i class="fas fa-wallet"></i></div>
            <div class="card-content">
                <h4>Total Pendapatan</h4>
                <p>Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon tiket"><i class="fas fa-ticket-alt"></i></div>
            <div class="card-content">
                <h4>Tiket Hari Ini</h4>
                <p>{{ $tiketHariIni ?? 0 }} Tiket</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon transaksi"><i class="fas fa-check-circle"></i></div>
            <div class="card-content">
                <h4>Transaksi Hari Ini</h4>
                <p>{{ $transaksiHariIni ?? 0 }} Transaksi</p>
            </div>
        </div>
    </div>

    {{-- CHART & DATE --}}
    <div class="content-grid">
        <div class="chart-box">
            <div class="chart-header">
                <h3>Pendapatan 7 Hari Terakhir</h3>
            </div>
            <div class="chart-container">
                <canvas id="chart"></canvas>
            </div>
        </div>
        <div class="date-box">
            <h3 style="margin-bottom:14px;">Filter Tanggal</h3>
            <div class="date-display">
                <i class="fas fa-calendar-alt" style="color:#2196f3;"></i>
                <span id="selectedDate">{{ now()->translatedFormat('d F Y') }}</span>
            </div>
            <input type="date" id="filterDate" value="{{ now()->format('Y-m-d') }}"
                style="width:100%;padding:10px;border-radius:10px;border:1px solid #ddd;font-family:'Poppins',sans-serif;font-size:13px;">
        </div>
    </div>

    {{-- TABEL TRANSAKSI --}}
    <div class="table-box">
        <div class="table-header">
            <h3>Tabel Transaksi Wisata Ini</h3>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pesan</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Jumlah Tiket</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse($transaksi ?? [] as $i => $t)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>#{{ str_pad($t->id_pemesanan, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $t->nama_customer }}</td>
                        <td>{{ \Carbon\Carbon::parse($t->tanggal_pesan)->format('d M Y') }}</td>
                        <td>{{ $t->jml_tiket }} tiket</td>
                        <td>Rp {{ number_format($t->harga_total, 0, ',', '.') }}</td>
                        <td><span class="status-badge status-sukses">Selesai</span></td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="7">Belum ada transaksi untuk wisata ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
    document.querySelector('.overlay').classList.toggle('active');
}
function confirmLogout(event) {
    event.preventDefault();
    
    Swal.fire({
        title: 'Yakin ingin logout?',
        text: "Anda akan keluar dari sistem",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#52C396',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('admin.logout') }}";
        }
    })
}

// Chart data dari Laravel
const chartLabels = @json($chartLabels ?? []);
const chartData   = @json($chartData ?? []);

new Chart(document.getElementById('chart').getContext('2d'), {
    type: 'line',
    data: {
        labels: chartLabels,
        datasets: [{
            label: 'Pendapatan',
            data: chartData,
            borderColor: '#52C396',
            backgroundColor: 'rgba(82,195,150,0.1)',
            fill: true, tension: 0.4, pointRadius: 4,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

// Filter tanggal
document.getElementById('filterDate').addEventListener('change', function() {
    document.getElementById('selectedDate') .textContent = new Date(this.value)
        .toLocaleDateString('id-ID', { day:'numeric', month:'long', year:'numeric' });
});
</script>
</body>
</html>
