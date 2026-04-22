<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Transaksi - Nganjuk Abirupa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root{ --panel:#eef3f9; --brand:#3fb27f; --text:#0f172a; --muted:#667085; --nav:#e1e6ec; }
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
    .riwayat-header{ display:flex; justify-content:space-between; align-items:center; margin:30px 0 20px; }
    .riwayat-title{ font-size:28px; font-weight:800; }
    .back-btn{ background:#6ee7b7; color:#0f172a; border:none; padding:8px 16px; border-radius:8px; font-weight:700; cursor:pointer; text-decoration:none; display:inline-block; }
    .riwayat-table{ width:100%; background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,.07); }
    .riwayat-table table{ width:100%; border-collapse:collapse; }
    .riwayat-table th{ background:#f1f5f9; padding:14px 18px; text-align:left; font-size:13px; color:#64748b; font-weight:600; }
    .riwayat-table td{ padding:14px 18px; font-size:14px; border-bottom:1px solid #f1f5f9; vertical-align:middle; }
    .riwayat-table tr:last-child td{ border-bottom:none; }
    .status-badge{ padding:4px 12px; border-radius:20px; font-size:12px; font-weight:700; background:#d1fae5; color:#065f46; }
    .empty-state{ text-align:center; padding:60px 20px; color:#94a3b8; }
    .empty-state .icon-big{ font-size:48px; margin-bottom:16px; }
    .footer{ text-align:center; color:#fff; font-size:13px; font-weight:500; padding:18px 0; margin-top:60px; background:#5EC292; }
    @media(max-width:768px){
      .riwayat-table table, .riwayat-table thead, .riwayat-table tbody, .riwayat-table th, .riwayat-table td, .riwayat-table tr{ display:block; }
      .riwayat-table thead tr{ display:none; }
      .riwayat-table td{ padding:10px 18px; border:none; }
      .riwayat-table td::before{ content:attr(data-label); font-weight:700; color:#64748b; font-size:11px; display:block; margin-bottom:2px; }
      .riwayat-table tr{ border-bottom:1px solid #f1f5f9; }
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
      <div class="menu">
        <a href="{{ route('beranda') }}">Beranda</a>
        <a href="{{ route('riwayat') }}" class="active">Riwayat</a>
        <a href="#">Tentang Kami</a>
      </div>
    </div>
    <div class="icons">
      <a class="icon" href="{{ route('profil') }}" title="Profil">👤</a>
    </div>
  </nav>

  <div class="riwayat-header">
    <div class="riwayat-title">Riwayat Transaksi</div>
    <a href="{{ route('beranda') }}" class="back-btn">← Kembali</a>
  </div>

  <div class="riwayat-table">
    @if($riwayat->count() > 0)
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Wisata</th>
            <th>Tanggal</th>
            <th>Jumlah Tiket</th>
            <th>Total</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($riwayat as $i => $r)
            <tr>
              <td data-label="No">{{ $i + 1 }}</td>
              <td data-label="Wisata">{{ $r->transaksi->wisata->nama_wisata ?? '-' }}</td>
              <td data-label="Tanggal">{{ \Carbon\Carbon::parse($r->tgl_pesanan)->format('d M Y') }}</td>
              <td data-label="Jumlah Tiket">{{ $r->transaksi->jml_tiket ?? '-' }} tiket</td>
              <td data-label="Total">Rp {{ number_format($r->harga_total, 0, ',', '.') }}</td>
              <td data-label="Status"><span class="status-badge">{{ $r->status }}</span></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="empty-state">
        <div class="icon-big">📋</div>
        <p style="font-size:16px;font-weight:600;color:#475569;margin-bottom:8px;">Belum ada riwayat transaksi</p>
        <p style="font-size:14px;">Yuk pesan tiket wisata pertamamu!</p>
        <a href="{{ route('beranda') }}" style="display:inline-block;margin-top:20px;background:#3fb27f;color:#fff;padding:10px 24px;border-radius:10px;font-weight:700;text-decoration:none;">Jelajahi Wisata</a>
      </div>
    @endif
  </div>

  <div class="footer">© 2025 Nganjuk Abirupa – Disparbudpar Nganjuk. All rights reserved.</div>
</div>
</body>
</html>
