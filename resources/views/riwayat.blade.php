<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Nganjuk Abirupa</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        /* ============ BASE & VARIABLES ============ */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-green: #4CAF50;
            --dark-green: #2E7D32;
            --panel:#f8fafc; 
            --white:#ffffff;
            --border:#e2e8f0;
            --text:#0f172a; 
            --muted:#64748b;
            --nav-bg: #e1e6ec;
            --nav-text: #4b5563;
            --nav-active: #101827;
            --nav-underline: #fbbf24;
        }
        *{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins', sans-serif; }
        body{ background:var(--panel); color:var(--text); overflow-x: hidden; }
        a{ color:inherit; text-decoration:none; }

        .wrap{ 
            width:92%; 
            max-width:1100px; 
            margin:0 auto; 
            padding-top: 100px;
            padding-bottom: 40px;
        }

        * ============ NAVBAR ============ */
.navbar {
    position: fixed;
    top: 20px;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 1000;
    display: flex;
    justify-content: center;
}

.navbar-container {
    width: 90%;
    max-width: 1000px;
    position: relative;
    background: var(--nav-bg);
    border-radius: 50px;
    padding: 10px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.nav-brand { display: flex; align-items: center; gap: 12px; }
.nav-logo img { height: 36px; width: auto; display: block; }

.navbar-menu-container {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    justify-content: center;
}

.nav-links {
    display: flex;
    gap: 40px;
    list-style: none;
    margin: 0;
    padding: 0;
    align-items: center;
}

.nav-links li { position: relative; padding-bottom: 10px; }
.nav-links a {
    text-decoration: none;
    color: var(--nav-text);
    font-weight: 700;
    font-size: 14px;
    position: relative;
    transition: color 0.3s;
}
.nav-links a:hover,
.nav-links a.active { color: #101827; }
.nav-links a.active::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 100%;
    height: 3px;
    background: #fbbf24;
    border-radius: 2px;
}

.dropdown-menu { display: none; }
.nav-links li:hover .dropdown-menu {
    display: block;
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    min-width: 170px;
    margin-top: 0;
    list-style: none;
}
.dropdown-menu li { margin-bottom: 5px; padding-bottom: 0; }
.dropdown-menu a {
    font-weight: 600;
    font-size: 13px;
    display: block;
    padding: 8px 12px;
    color: var(--text-dark);
    border-radius: 6px;
}
.dropdown-menu a:hover { background: #f0fdf4; color: var(--primary-green); }
.dropdown-menu a::after { display: none; }

.nav-icons { display: flex; align-items: center; }
.btn-login {
    padding: 8px 24px;
    border: 2px solid var(--primary-green);
    border-radius: 50px;
    color: var(--primary-green);
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    background: transparent;
    font-family: 'Poppins', sans-serif;
    transition: all 0.2s;
    display: inline-block;
}
.btn-login:hover {
    background: var(--primary-green);
    color: white;
    transform: translateY(-2px);
}

.hamburger {
    display: none;
    flex-direction: column;
    gap: 4px;
    cursor: pointer;
    margin-left: 15px;
}
.hamburger span {
    width: 22px;
    height: 2.5px;
    background: var(--text-dark);
    border-radius: 2px;
    transition: 0.3s;
}

        /* ============ CONTENT ============ */
        .riwayat-header{ 
            display:flex; justify-content:space-between; align-items:center; 
            margin:16px 0 24px; flex-wrap:wrap; gap:16px; 
        }
        .riwayat-title{ font-size:26px; font-weight:800; color:var(--text); }
        .back-btn{ 
            background:var(--primary-green); color:var(--white); padding:9px 18px; 
            border-radius:10px; font-weight:600; font-size:14px; transition:all .2s; 
        }
        .back-btn:hover{ background:var(--dark-green); transform:translateY(-2px); }

        .riwayat-table{ 
            width:100%; background:var(--white); border-radius:16px; 
            overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,.06); 
        }
        .riwayat-table table{ width:100%; border-collapse:collapse; }
        .riwayat-table th{ 
            background:#f8fafc; padding:14px 18px; text-align:left; 
            font-size:13px; color:#64748b; font-weight:600; border-bottom:1px solid var(--border); 
        }
        .riwayat-table td{ 
            padding:14px 18px; font-size:14px; border-bottom:1px solid var(--border); 
            vertical-align:middle; color:#334155; 
        }
        .riwayat-table tr:last-child td{ border-bottom:none; }
        .status-badge{ 
            display:inline-block; padding:4px 12px; border-radius:20px; 
            font-size:12px; font-weight:600; background:#d1fae5; color:#065f46; 
        }
        .btn-hapus{ 
            background:#fee2e2; color:#dc2626; border:none; padding:6px 12px; 
            border-radius:8px; font-size:12px; font-weight:600; cursor:pointer; transition:.2s; 
        }
        .btn-hapus:hover{ background:#fecaca; }

        .empty-state{ text-align:center; padding:60px 20px; }
        .empty-state .icon-big{ font-size:48px; margin-bottom:16px; }
        .empty-state p{ color:var(--muted); margin-bottom:8px; }
        .empty-state .btn-jelajah{ 
            display:inline-block; margin-top:16px; background:var(--primary-green); color:var(--white); 
            padding:10px 24px; border-radius:10px; font-weight:600; transition:.2s; 
        }
        .empty-state .btn-jelajah:hover{ background:var(--dark-green); transform:translateY(-2px); }

        .footer{ 
            text-align:center; color:var(--white); font-size:13px; font-weight:500; 
            padding:20px 0; margin-top:40px; background:var(--primary-green); border-radius:12px; 
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 768px) {
            .navbar-container { 
                padding: 10px 16px;
            }
            
            .navbar-menu-container { 
                display: none; 
                position: absolute; 
                top: 100%; 
                left: 0; 
                right: 0; 
                width: 100%; 
                transform: none; 
                background: white; 
                border-radius: 16px; 
                padding: 20px; 
                box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
                flex-direction: column; 
                margin-top: 10px; 
            }
            .navbar-menu-container.active { display: flex; }
            .nav-links { flex-direction: column; gap: 0; text-align: center; width: 100%; }
            .nav-links li { width: 100%; padding: 14px 0; border-bottom: 1px solid #f1f5f9; }
            .nav-links li:last-child { border-bottom: none; }
            .nav-links li:hover .dropdown-menu { display: none; }
            .nav-links li.open .dropdown-menu { 
                display: block; 
                position: relative; 
                top: auto; 
                left: auto; 
                box-shadow: none; 
                margin-top: 10px; 
                background: #f8fafc; 
            }
            .dropdown-menu li { padding: 0; border-bottom: none; }
            .dropdown-menu a { padding: 10px 16px; font-size: 13px; }
            
            /* Tampilkan hamburger di mobile dengan prioritas tinggi */
            .hamburger { 
                display: flex !important;
                order: 3;
                margin-left: auto;
            }
            
            .nav-icons {
                gap: 10px;
            }
            
            .wrap { padding-top: 90px; }
            .btn-login { padding: 8px 16px; font-size: 12px; }
            
            .riwayat-table table, .riwayat-table thead, .riwayat-table tbody, 
            .riwayat-table th, .riwayat-table td, .riwayat-table tr{ display:block; }
            .riwayat-table thead tr{ display:none; }
            .riwayat-table td{ padding:12px 18px; border:none; }
            .riwayat-table td::before{ 
                content:attr(data-label); font-weight:600; color:#64748b; font-size:12px; 
                display:block; margin-bottom:4px; text-transform:uppercase; 
            }
            .riwayat-table tr{ border-bottom:1px solid var(--border); }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
    <div class="navbar-container">
        <div class="nav-brand">
            <a href="{{ route('beranda') }}" class="nav-logo">
                <img src="{{ asset('images/logogedi.png') }}" alt="Nganjuk Abirupa">
            </a>
        </div>

        <div class="navbar-menu-container" id="mobileMenu">
            <ul class="nav-links">
                <li><a href="{{ route('beranda') }}">Beranda</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" id="dropdownToggle">Informasi Tiket ▾</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('informasi.harga') }}">Harga Tiket</a></li>
                        <li><a href="{{ route('informasi.cara-pesan') }}">Cara Pesan Tiket</a></li>
                        <li><a href="{{ route('informasi.pesan') }}">Pesan Tiket Wisata</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('riwayat') }}" class="active">Riwayat</a></li>
            </ul>
        </div>

        <div class="nav-icons">
            <a href="{{ route('beranda') }}" class="btn-login">Login</a>
            <div class="hamburger" onclick="toggleMobileMenu()">
                <span></span><span></span><span></span>
            </div>
        </div>
    </div>
</nav>

<div class="wrap">
    <div class="riwayat-header">
        <div class="riwayat-title">Riwayat Transaksi</div>
        <a href="{{ route('beranda') }}" class="back-btn">← Kembali</a>
    </div>

    <div class="riwayat-table" id="riwayatContainer">
        <div style="text-align:center; padding:40px; color:#94a3b8;">Memuat riwayat...</div>
    </div>

    <div class="footer">© 2026 Nganjuk Abirupa – Disporabudpar Nganjuk. All rights reserved.</div>
</div>

<script>
// Toggle Mobile Menu
function toggleMobileMenu() {
    document.getElementById('mobileMenu').classList.toggle('active');
    if (!document.getElementById('mobileMenu').classList.contains('active')) {
        document.getElementById('dropdownToggle').parentElement.classList.remove('open');
    }
}

// Tambahkan efek scroll untuk bayangan navbar
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.style.boxShadow = '0 10px 40px rgba(0,0,0,0.1)';
    } else {
        navbar.style.boxShadow = '0 10px 30px rgba(0,0,0,0.05)';
    }
});

// Toggle Dropdown via Klik (Mobile Only)
const dropdownToggle = document.getElementById('dropdownToggle');
if (dropdownToggle) {
    dropdownToggle.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            e.preventDefault();
            e.stopPropagation();
            this.parentElement.classList.toggle('open');
        }
    });
}

// Tutup dropdown saat klik link submenu
document.querySelectorAll('.dropdown-menu a').forEach(link => {
    link.addEventListener('click', () => {
        const mobileMenu = document.getElementById('mobileMenu');
        const hamburger = document.getElementById('hamburger');
        if (mobileMenu) mobileMenu.classList.remove('active');
        if (hamburger) hamburger.classList.remove('active');
        const dropdownLi = document.getElementById('dropdownToggle')?.parentElement;
        if (dropdownLi) dropdownLi.classList.remove('open');
    });
});

// Format functions
function formatRupiah(angka) {
    return 'Rp ' + parseInt(angka || 0).toLocaleString('id-ID');
}

function formatTanggal(tanggalStr) {
    if (!tanggalStr) return '-';
    const tgl = new Date(tanggalStr);
    return tgl.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
}

function renderRiwayat() {
    const container = document.getElementById('riwayatContainer');
    const riwayat = JSON.parse(localStorage.getItem('riwayat_transaksi') || '[]');
    
    if (riwayat.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <div class="icon-big">📋</div>
                <p style="font-size:16px;font-weight:600;color:#475569;margin-bottom:8px;">Belum ada riwayat transaksi</p>
                <p style="font-size:14px;">Yuk pesan tiket wisata pertamamu!</p>
                <a href="{{ route('beranda') }}" class="btn-jelajah">Jelajahi Wisata</a>
            </div>
        `;
        return;
    }
    
    let html = `<table><thead><tr>
        <th>No</th>
        <th>Wisata</th>
        <th>Tanggal</th>
        <th>Pengunjung</th>
        <th>Total</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr></thead><tbody>`;
    
    riwayat.forEach((item, index) => {
        html += `
            <tr>
                <td data-label="No">${index + 1}</td>
                <td data-label="Wisata"><strong>${item.wisata || '-'}</strong></td>
                <td data-label="Tanggal">${formatTanggal(item.tanggal)}</td>
                <td data-label="Pengunjung">${item.dewasa || 0} Dewasa, ${item.anak || 0} Anak</td>
                <td data-label="Total"><strong>${formatRupiah(item.total)}</strong></td>
                <td data-label="Status"><span class="status-badge">${item.status || 'Lunas'}</span></td>
                <td data-label="Aksi">
                    <button class="btn-hapus" onclick="hapusTransaksi('${item.id}')">✕ Hapus</button>
                </td>
            </tr>
        `;
    });
    
    html += `</tbody></table>`;
    container.innerHTML = html;
}

function hapusTransaksi(id) {
    if (!confirm('Hapus riwayat transaksi ini?')) return;
    let riwayat = JSON.parse(localStorage.getItem('riwayat_transaksi') || '[]');
    riwayat = riwayat.filter(item => item.id !== id);
    localStorage.setItem('riwayat_transaksi', JSON.stringify(riwayat));
    renderRiwayat();
}

// Initialize
document.addEventListener('DOMContentLoaded', renderRiwayat);
</script>
</body>
</html>