<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Transaksi - Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root{ --panel:#eef3f9; --brand:#3fb27f; --text:#0f172a; --nav:#e1e6ec; }
    *{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',Arial,sans-serif; }
    body{ background:var(--panel); color:var(--text); }
    a{ color:inherit; text-decoration:none; }
    .wrap{ width:92%; max-width:1150px; margin:24px auto 48px; }
    .nav{ display:flex; align-items:center; justify-content:space-between; background:var(--nav); border-radius:52px; padding:14px 22px; box-shadow:0 10px 30px rgba(0,0,0,.06); }
    .logo img{ height:40px; }
    .menu-container{ flex:1; display:flex; justify-content:center; }
    .menu{ display:flex; gap:42px; align-items:center; }
    .menu a{ font-weight:700; color:#4b5563; position:relative; }
    .menu a.active{ color:#101827; }
    .menu a.active::after{ content:""; position:absolute; bottom:-12px; left:0; width:100%; height:4px; border-radius:4px; background:#fbbf24; }
    .icons{ display:flex; gap:12px; }
    .icon{ width:46px; height:46px; border-radius:14px; background:#fff; border:1px solid #eef1f6; display:grid; place-items:center; font-size:20px; }
    .page-header{ display:flex; justify-content:space-between; align-items:center; margin:28px 0 20px; }
    .page-title{ font-size:26px; font-weight:800; }
    /* Search */
    .search-bar{ display:flex; gap:12px; margin-bottom:20px; }
    .search-bar input{ flex:1; padding:10px 16px; border:1.5px solid #d0d5dd; border-radius:10px; font-size:14px; outline:none; font-family:'Poppins',Arial,sans-serif; }
    .search-bar input:focus{ border-color:var(--brand); }
    /* TABLE */
    .table-wrap{ background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,.07); overflow-x:auto; }
    table{ width:100%; border-collapse:collapse; min-width:700px; }
    th{ background:#f1f5f9; padding:14px 18px; text-align:left; font-size:13px; color:#64748b; font-weight:600; }
    td{ padding:14px 18px; font-size:14px; border-bottom:1px solid #f1f5f9; vertical-align:middle; }
    tr:last-child td{ border-bottom:none; }
    tr:hover td{ background:#fafafa; }
    .status-badge{ padding:4px 12px; border-radius:20px; font-size:12px; font-weight:700; background:#d1fae5; color:#065f46; }
    .empty-state{ text-align:center; padding:60px; color:#94a3b8; }
    /* SUMMARY */
    .summary-cards{ display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:24px; }
    .summary-card{ background:#fff; border-radius:14px; padding:18px 22px; box-shadow:0 2px 10px rgba(0,0,0,.06); }
    .summary-label{ font-size:13px; color:#64748b; margin-bottom:4px; }
    .summary-value{ font-size:22px; font-weight:800; }
    .footer{ text-align:center; color:#fff; font-size:13px; padding:18px 0; margin-top:60px; background:#5EC292; }
    @media(max-width:600px){ .summary-cards{ grid-template-columns:1fr; } }
  </style>
</head>
<body>
<div class="wrap">
  <!-- NAVBAR -->
  <nav class="nav">
    <a class="logo" href="{{ route('admin.beranda') }}">
      <img src="{{ asset('images/logo-abirupa.png') }}" alt="Nganjuk Abirupa" />
    </a>
    <div class="menu-container">
      <div class="menu">
        <a href="{{ route('admin.beranda') }}">Kelola Wisata</a>
        <a href="{{ route('admin.riwayat') }}" class="active">Riwayat</a>
        <a href="#">Tentang Kami</a>
      </div>
    </div>
    <div class="icons">
      <a class="icon" href="{{ route('admin.profil') }}" title="Profil">👤</a>
    </div>
  </nav>

  <div class="page-header">
    <div class="page-title">Riwayat Transaksi</div>
  </div>

  <!-- SUMMARY -->
  <div class="summary-cards">
    <div class="summary-card">
      <div class="summary-label">Total Transaksi</div>
      <div class="summary-value">{{ $riwayat->count() }}</div>
    </div>
    <div class="summary-card">
      <div class="summary-label">Total Pendapatan</div>
      <div class="summary-value">Rp {{ number_format($riwayat->sum('harga_total'), 0, ',', '.') }}</div>
    </div>
    <div class="summary-card">
      <div class="summary-label">Transaksi Selesai</div>
      <div class="summary-value">{{ $riwayat->where('status','Selesai')->count() }}</div>
    </div>
  </div>

  <!-- SEARCH -->
  <div class="search-bar">
    <input type="text" id="searchInput" placeholder="🔍 Cari nama customer atau wisata...">
  </div>

  <div class="table-wrap">
    @if($riwayat->count() > 0)
      <table id="riwayatTable">
        <thead>
          <tr>
            <th>No</th>
            <th>Customer</th>
            <th>No. Telepon</th>
            <th>Wisata</th>
            <th>Tanggal</th>
            <th>Tiket</th>
            <th>Total</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($riwayat as $i => $r)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $r->transaksi->nama_customer ?? '-' }}</td>
              <td>{{ $r->transaksi->tlp_costumer ?? '-' }}</td>
              <td>{{ $r->transaksi->wisata->nama_wisata ?? '-' }}</td>
              <td>{{ \Carbon\Carbon::parse($r->tgl_pesanan)->format('d M Y') }}</td>
              <td>{{ $r->transaksi->jml_tiket ?? '-' }} tiket</td>
              <td>Rp {{ number_format($r->harga_total, 0, ',', '.') }}</td>
              <td><span class="status-badge">{{ $r->status }}</span></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="empty-state">
        <p style="font-size:16px;font-weight:600;margin-bottom:8px;">Belum ada riwayat transaksi</p>
      </div>
    @endif
  </div>

  <div class="footer">© 2025 Nganjuk Abirupa – Panel Admin</div>
</div>

<script>
  // Fitur pencarian live
  document.getElementById('searchInput').addEventListener('input', function(){
    const query = this.value.toLowerCase();
    const rows  = document.querySelectorAll('#riwayatTable tbody tr');
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(query) ? '' : 'none';
    });
  });
</script>
</body>
</html>
