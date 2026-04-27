<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Beranda - Admin Nganjuk Abirupa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* ===== RESET & GLOBAL ===== */
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Poppins', sans-serif; background: #f5f6f8; color: #333; }

/* ===== LAYOUT ===== */
.container { display: flex; min-height: 100vh; }

/* ===== SIDEBAR (Default Desktop) ===== */
.sidebar {
    width: 220px;
    background: #eef2ef;
    min-height: 100vh;
    padding: 20px 15px;
    position: fixed;
    left: 0; top: 0;
    transition: all 0.3s ease;
    z-index: 1000;
}
.logo { display: flex; justify-content: center; margin-bottom: 30px; }
.logo img { width: 100px; }

/* Menu Links */
.menu { display: flex; flex-direction: column; gap: 10px; }
.menu a {
    text-decoration: none;
    padding: 12px 18px;
    border-radius: 15px;
    font-weight: 600;
    font-size: 14px;
    display: flex; align-items: center; gap: 12px;
    color: #333; background: white;
    transition: all 0.3s ease;
}
.menu a i { font-size: 16px; width: 20px; text-align: center; }
.menu a.active { background: #52C396; color: white; box-shadow: 0 3px 10px rgba(82,195,150,0.3); }
.menu a:hover:not(.active) { transform: translateX(5px); background: #dff5ec; }

/* ===== MAIN CONTENT ===== */
.main {
    flex: 1;
    margin-left: 220px; /* Space for sidebar */
    padding: 25px;
    transition: all 0.3s ease;
}

/* ===== TOP CARDS (Grid) ===== */
.cards-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 Kolom Desktop */
    gap: 20px;
    margin-bottom: 25px;
}
.card {
    background: white; border-radius: 15px; padding: 20px;
    display: flex; align-items: center; gap: 15px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    transition: transform 0.3s;
}
.card:hover { transform: translateY(-3px); }
.card-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
.card-icon.pendapatan { background: #e8f5f0; color: #52C396; }
.card-icon.tiket { background: #fff3e0; color: #ff9800; }
.card-icon.transaksi { background: #e3f2fd; color: #2196f3; }
.card-content h4 { margin: 0 0 5px 0; font-size: 12px; color: #888; }
.card-content p { margin: 0; font-size: 18px; font-weight: 700; }

/* ===== MIDDLE SECTION (Chart + Date) ===== */
.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr; /* Chart lebar, Kalender kecil */
    gap: 20px;
    margin-bottom: 25px;
}
.chart-box, .date-box {
    background: white; border-radius: 20px; padding: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
}
.chart-header { display: flex; justify-content: space-between; margin-bottom: 15px; }
.chart-container { position: relative; height: 250px; } /* Chart Height */

/* Calendar */
.date-display { background: #f0f7ff; padding: 12px; border-radius: 10px; display: flex; align-items: center; gap: 10px; cursor: pointer; margin-bottom: 15px; }
.calendar { border: 1px solid #eee; border-radius: 10px; padding: 10px; display: none; }
.calendar.active { display: block; }
.calendar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
.calendar-header select { padding: 5px; border-radius: 5px; border: 1px solid #ddd; }
.calendar-days { display: grid; grid-template-columns: repeat(7, 1fr); gap: 5px; text-align: center; font-size: 12px; }
.day { padding: 8px; border-radius: 5px; cursor: pointer; }
.day:hover { background: #eee; }
.day.active { background: #52C396; color: white; }
.day-label { font-weight: bold; color: #888; font-size: 10px; }

/* ===== TABLE ===== */
.table-box {
    background: white; border-radius: 20px; padding: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
}
.table-header { display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center; }
.table-responsive { overflow-x: auto; } /* Agar tabel bisa scroll di HP */
table { width: 100%; border-collapse: collapse; min-width: 800px; } /* Min-width agar tidak hancur */
thead { background: #a5e7c0; }
th, td { padding: 12px 10px; text-align: left; font-size: 13px; white-space: nowrap; }
td { border-bottom: 1px solid #eee; }
.status-badge { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
.status-sukses { background: #d4edda; color: #155724; }
.status-pending { background: #fff3cd; color: #856404; }

/* ===== HAMBURGER BUTTON (Hidden by default on Desktop) ===== */
.menu-toggle {
    display: none;
    position: fixed; top: 15px; left: 15px; z-index: 1001;
    background: #52C396; color: white; border: none;
    width: 45px; height: 45px; border-radius: 10px;
    font-size: 20px; cursor: pointer; box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}
.overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.5); z-index: 999;
}

/* ================= RESPONSIVE BREAKPOINTS ================= */

/* Tablet & Mobile (Max 1024px) */
@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr; /* Stack Chart & Calendar */
    }
    .cards-container {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* Mobile Portrait (Max 768px) */
@media (max-width: 768px) {
    /* Sidebar Logic */
    .sidebar {
        transform: translateX(-100%); /* Sembunyikan sidebar */
    }
    .sidebar.active {
        transform: translateX(0); /* Tampilkan sidebar */
    }
    
    /* Main Content Logic */
    .main {
        margin-left: 0; /* Full width */
        padding: 15px;
        padding-top: 70px; /* Space for top bar/toggle */
    }

    /* Show Hamburger */
    .menu-toggle { display: block; }
    .overlay.active { display: block; }

    /* Stack Cards */
    .cards-container {
        grid-template-columns: 1fr; /* 1 Kolom di HP */
    }
    
    /* Table Header */
    .table-header { flex-direction: column; align-items: flex-start; gap: 10px; }
}

/* Small Mobile (Max 480px) */
@media (max-width: 480px) {
    .card { flex-direction: column; text-align: center; }
    .card-content h4 { font-size: 14px; }
    .chart-container { height: 200px; }
    th, td { font-size: 11px; padding: 8px 5px; }
}
</style>
</head>

<body>

<!-- Tombol Hamburger (Muncul hanya di HP) -->
<button class="menu-toggle" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>
<div class="overlay" onclick="toggleSidebar()"></div>

<div class="container">

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="logo">
        <img src="{{ asset('images/logo-abirupa.png') }}" alt="Logo">
    </div>
    <div class="menu">
        <a href="{{ route('admin.beranda') }}" class="active">
            <i class="fas fa-home"></i> Beranda
        </a>
        <a href="{{ route('admin.edit') }}">
            <i class="fas fa-edit"></i> Edit Wisata
        </a>
        <a href="{{ route('admin.profil') }}">
            <i class="fas fa-user"></i> Profil
        </a>
    </div>
</div>

<!-- MAIN -->
<div class="main">
    
    <!-- Cards -->
    <div class="cards-container">
        <div class="card">
            <div class="card-icon pendapatan"><i class="fas fa-wallet"></i></div>
            <div class="card-content">
                <h4>Total Pendapatan</h4>
                <p>Rp 1.000.000</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon tiket"><i class="fas fa-ticket-alt"></i></div>
            <div class="card-content">
                <h4>Tiket Hari Ini</h4>
                <p>20 Tiket</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon transaksi"><i class="fas fa-check-circle"></i></div>
            <div class="card-content">
                <h4>Transaksi Hari Ini</h4>
                <p>10 Transaksi</p>
            </div>
        </div>
    </div>

    <!-- Chart & Calendar -->
    <div class="content-grid">
        <div class="chart-box">
            <div class="chart-header">
                <h3>Pendapatan</h3>
                <span style="color:#52C396; font-weight:bold;">↑ 72%</span>
            </div>
            <div class="chart-container">
                <canvas id="chart"></canvas>
            </div>
        </div>
        <div class="date-box">
            <h3>Pilih Tanggal</h3>
            <div class="date-display" onclick="toggleCalendar()">
                <i class="fas fa-calendar-alt"></i>
                <span id="selectedDate">17 April 2026</span>
            </div>
            <div class="calendar" id="calendar">
                <div class="calendar-header">
                    <select><option>April</option></select>
                    <select><option>2026</option></select>
                </div>
                <div class="calendar-days">
                    <div class="day-label">Min</div><div class="day-label">Sen</div><div class="day-label">Sel</div>
                    <div class="day-label">Rab</div><div class="day-label">Kam</div><div class="day-label">Jum</div>
                    <div class="day-label">Sab</div>
                    <!-- Contoh tanggal -->
                    <div class="day">12</div><div class="day">13</div><div class="day">14</div>
                    <div class="day">15</div><div class="day">16</div><div class="day active">17</div>
                    <div class="day">18</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-box">
        <div class="table-header">
            <h3>Tabel Pendapatan Hari Ini</h3>

        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pesan</th>
                        <th>Customer</th>
                        <th>Destinasi</th>
                        <th>Tgl</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td><td>#ORD01</td><td>Budi</td><td>Wisata A</td><td>17 Apr</td><td>Rp 100.000</td>
                        <td><span class="status-badge status-sukses">Sukses</span></td>
                    </tr>
                    <tr>
                        <td>2</td><td>#ORD02</td><td>Siti</td><td>Wisata B</td><td>17 Apr</td><td>Rp 50.000</td>
                        <td><span class="status-badge status-pending">Pending</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>

<script>
// Toggle Sidebar Mobile
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
    document.querySelector('.overlay').classList.toggle('active');
}

// Toggle Calendar
function toggleCalendar() {
    document.getElementById('calendar').classList.toggle('active');
}

// Chart Setup
const ctx = document.getElementById('chart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['08', '09', '10', '11', '12', '13', '14'],
        datasets: [{
            label: 'Pendapatan',
            data: [10, 25, 20, 40, 35, 60, 80],
            borderColor: '#52C396',
            backgroundColor: 'rgba(82, 195, 150, 0.1)',
            fill: true, tension: 0.4
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});
</script>
</body>
</html>