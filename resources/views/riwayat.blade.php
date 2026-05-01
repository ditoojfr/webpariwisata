<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Transaksi - Nganjuk Abirupa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root{ 
      --primary-green: #4CAF50;
      --dark-green: #2E7D32;
      --panel:#f8fafc; 
      --nav-bg:#e8ecf1; 
      --white:#ffffff;
      --border:#e2e8f0;
      --text:#0f172a; 
      --muted:#64748b; 
    }
    *{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins', sans-serif; }
    body{ background:var(--panel); color:var(--text); }
    a{ color:inherit; text-decoration:none; }

    /* ============ LAYOUT ============ */
    .wrap{ width:92%; max-width:1100px; margin:0 auto; padding-top:24px; }

    /* ============ NAVBAR (KAPSUL) ============ */
    .nav{ 
      display:flex; align-items:center; justify-content:space-between; 
      background:var(--nav-bg); border-radius:52px; padding:14px 28px; 
      box-shadow:0 8px 24px rgba(0,0,0,.06); position:relative; z-index:50;
    }
    .logo img{ height:40px; }
    .menu-container{ flex:1; display:flex; justify-content:center; }
    .menu{ display:flex; gap:36px; align-items:center; list-style:none; }
    .menu > li{ position:relative; }
    .menu a{ font-weight:600; color:#475569; transition:color .2s; }
    .menu a:hover, .menu a.active{ color:var(--text); }
    .menu a.active::after{ 
      content:""; position:absolute; bottom:-14px; left:0; width:100%; height:4px; 
      border-radius:4px; background:#fbbf24; 
    }

    /* Dropdown Styles */
    .dropdown-menu{
      position:absolute; top:100%; left:50%; transform:translateX(-50%) translateY(10px);
      background:var(--white); min-width:210px; border-radius:12px;
      box-shadow:0 10px 30px rgba(0,0,0,.12); padding:8px 0;
      opacity:0; visibility:hidden; transition:all .25s ease; z-index:100; list-style:none;
    }
    .dropdown:hover .dropdown-menu{ opacity:1; visibility:visible; transform:translateX(-50%) translateY(0); }
    .dropdown-menu li a{ display:block; padding:10px 20px; font-size:14px; font-weight:500; white-space:nowrap; }
    .dropdown-menu li a:hover{ background:#f0fdf4; color:var(--primary-green); padding-left:24px; }

    /* Login Button */
    .icons{ display:flex; gap:12px; }
    .btn-login {
      padding: 10px 32px;
      border: 2px solid var(--primary-green);
      border-radius: 25px;
      color: var(--primary-green);
      font-weight: 600;
      cursor: pointer;
      background: transparent;
      transition: all 0.3s;
      display: inline-block;
    }
    .btn-login:hover {
      background: var(--primary-green);
      color: white;
      transform: translateY(-2px);
    }

    /* ============ CONTENT ============ */
    .riwayat-header{ 
      display:flex; justify-content:space-between; align-items:center; 
      margin:32px 0 24px; flex-wrap:wrap; gap:16px; 
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

    /* Empty State */
    .empty-state{ text-align:center; padding:60px 20px; }
    .empty-state .icon-big{ font-size:48px; margin-bottom:16px; }
    .empty-state p{ color:var(--muted); margin-bottom:8px; }
    .empty-state .btn-jelajah{ 
      display:inline-block; margin-top:16px; background:var(--primary-green); color:var(--white); 
      padding:10px 24px; border-radius:10px; font-weight:600; transition:.2s; 
    }
    .empty-state .btn-jelajah:hover{ background:var(--dark-green); transform:translateY(-2px); }

    /* Footer */
    .footer{ 
      text-align:center; color:var(--white); font-size:13px; font-weight:500; 
      padding:20px 0; margin-top:40px; background:var(--primary-green); border-radius:12px; 
    }

    /* Responsive */
    @media(max-width:768px){
      .menu{ gap:20px; }
      .riwayat-table table, .riwayat-table thead, .riwayat-table tbody, 
      .riwayat-table th, .riwayat-table td, .riwayat-table tr{ display:block; }
      .riwayat-table thead tr{ display:none; }
      .riwayat-table td{ padding:12px 18px; border:none; }
      .riwayat-table td::before{ 
        content:attr(data-label); font-weight:600; color:#64748b; font-size:12px; 
        display:block; margin-bottom:4px; text-transform:uppercase; 
      }
      .riwayat-table tr{ border-bottom:1px solid var(--border); }
      .btn-login{ padding: 8px 20px; font-size: 13px; }
    }
  </style>
</head>
<body>
<div class="wrap">
  <!-- NAVBAR -->
  <nav class="nav">
    <a class="logo" href="{{ route('beranda') }}">
      <img src="{{ asset('images/logo-abirupa.png') }}" alt="Nganjuk Abirupa" />
    </a>
    <div class="menu-container">
      <ul class="menu">
        <li><a href="{{ route('beranda') }}">Beranda</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle">Informasi Tiket ▾</a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('informasi.harga') }}">Harga Tiket</a></li>
            <li><a href="{{ route('informasi.cara-pesan') }}">Cara Pesan Tiket</a></li>
            <li><a href="{{ route('informasi.pesan') }}">Pesan Tiket Wisata</a></li>
          </ul>
        </li>
        <li><a href="{{ route('riwayat') }}" class="active">Riwayat</a></li>
      </ul>
    </div>
    <div class="icons">
      <a class="btn-login" href="{{ route('beranda') }}">Login</a>
    </div>
  </nav>

  <!-- HEADER -->
  <div class="riwayat-header">
    <div class="riwayat-title">Riwayat Transaksi</div>
    <a href="{{ route('beranda') }}" class="back-btn">← Kembali</a>
  </div>

  <!-- TABLE CONTAINER -->
  <div class="riwayat-table" id="riwayatContainer">
    <div style="text-align:center; padding:40px; color:#94a3b8;">Memuat riwayat...</div>
  </div>

  <!-- FOOTER -->
  <div class="footer">© 2026 Nganjuk Abirupa – Disporabudpar Nganjuk. All rights reserved.</div>
</div>

<script>
// === FORMAT RUPIAH ===
function formatRupiah(angka) {
  return 'Rp ' + parseInt(angka || 0).toLocaleString('id-ID');
}

// === FORMAT TANGGAL ===
function formatTanggal(tanggalStr) {
  if (!tanggalStr) return '-';
  const tgl = new Date(tanggalStr);
  return tgl.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
}

// === RENDER TABEL ===
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

// === HAPUS TRANSAKSI ===
function hapusTransaksi(id) {
  if (!confirm('Hapus riwayat transaksi ini?')) return;
  let riwayat = JSON.parse(localStorage.getItem('riwayat_transaksi') || '[]');
  riwayat = riwayat.filter(item => item.id !== id);
  localStorage.setItem('riwayat_transaksi', JSON.stringify(riwayat));
  renderRiwayat();
}

// === INIT ===
document.addEventListener('DOMContentLoaded', renderRiwayat);
</script>
</body>
</html>