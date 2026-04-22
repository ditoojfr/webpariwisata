<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin - Nganjuk Abirupa</title>
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
    /* HERO */
    .hero{ margin-top:18px; position:relative; background:linear-gradient(rgba(0,0,0,.35),rgba(0,0,0,.35)),url('{{ asset("images/nganjuk-abirupa.png") }}') center/cover no-repeat; height:300px; border-radius:24px; overflow:hidden; }
    .hero .text{ position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); color:#fff; text-align:center; }
    .hero h1{ font-size:32px; font-weight:800; }
    /* SECTION */
    .section-header{ display:flex; justify-content:space-between; align-items:center; margin:28px 0 16px; }
    .section-header h2{ font-size:24px; font-weight:800; }
    .add-btn{ background:var(--brand); color:#fff; padding:10px 20px; border-radius:12px; font-weight:700; font-size:14px; transition:all 0.2s; }
    .add-btn:hover{ background:#2f9a6e; transform:translateY(-1px); }
    .grid{ display:grid; gap:22px; }
    .grid.destinasi{ grid-template-columns:repeat(3,minmax(0,1fr)); }
    @media(max-width:1000px){ .grid.destinasi{ grid-template-columns:repeat(2,minmax(0,1fr)); } }
    @media(max-width:700px){ .grid.destinasi{ grid-template-columns:1fr; } }
    /* CARD */
    .card{ background:#fff; border-radius:18px; overflow:hidden; box-shadow:0 10px 26px rgba(0,0,0,.08); position:relative; }
    .thumb{ width:100%; height:200px; background-size:cover; background-position:center; }
    .content{ padding:12px 14px; }
    .title{ font-weight:700; font-size:15px; margin-bottom:4px; }
    .loc{ color:#6b7280; font-size:12px; margin-bottom:8px; }
    .action-buttons{ display:flex; gap:8px; }
    .btn-edit{ background:#fef3c7; color:#92400e; border:none; padding:6px 14px; border-radius:8px; font-weight:700; font-size:12px; cursor:pointer; transition:all 0.2s; }
    .btn-edit:hover{ background:#fde68a; }
    .btn-hapus{ background:#fee2e2; color:#dc2626; border:none; padding:6px 14px; border-radius:8px; font-weight:700; font-size:12px; cursor:pointer; transition:all 0.2s; }
    .btn-hapus:hover{ background:#fecaca; }
    .empty-state{ grid-column:1/-1; text-align:center; padding:60px; color:#94a3b8; }
    .footer{ text-align:center; color:#fff; font-size:13px; padding:18px 0; margin-top:60px; background:#5EC292; }
    @if(session('success'))
    .alert-success{ background:#d1fae5; border:1px solid #6ee7b7; color:#065f46; padding:12px 18px; border-radius:12px; margin-bottom:20px; font-weight:600; }
    @endif
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
        <a href="{{ route('admin.beranda') }}" class="active">Kelola Wisata</a>
        <a href="{{ route('admin.riwayat') }}">Riwayat</a>
        <a href="#">Tentang Kami</a>
      </div>
    </div>
    <div class="icons">
      <a class="icon" href="{{ route('admin.profil') }}" title="Profil">👤</a>
    </div>
  </nav>

  <!-- HERO -->
  <div class="hero">
    <div class="text">
      <h1>Panel Admin Nganjuk Abirupa</h1>
      <p style="opacity:.9;margin-top:8px;">Kelola destinasi wisata Kabupaten Nganjuk</p>
    </div>
  </div>

  @if(session('success'))
    <div class="alert-success" style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:12px 18px;border-radius:12px;margin-top:20px;font-weight:600;">
      ✅ {{ session('success') }}
    </div>
  @endif

  <!-- DAFTAR WISATA -->
  <div class="section-header">
    <h2>Daftar Destinasi Wisata</h2>
    <a href="{{ route('admin.wisata.create') }}" class="add-btn">+ Tambah Wisata</a>
  </div>

  <div class="grid destinasi">
    @forelse($destinasi as $d)
      <article class="card">
        <div class="thumb" style="background-image:url('{{ asset("storage/destinasi/" . ($d->gambar ?: "placeholder.jpg")) }}')"></div>
        <div class="content">
          <div class="title">{{ $d->nama_wisata }}</div>
          <div class="loc">📍 {{ $d->lokasi }}</div>
          <div class="action-buttons">
            <a href="{{ route('admin.wisata.edit', $d->id_wisata) }}" class="btn-edit">✏️ Edit</a>
            <button class="btn-hapus" onclick="hapusWisata({{ $d->id_wisata }}, '{{ $d->nama_wisata }}')">🗑️ Hapus</button>
          </div>
        </div>
      </article>
    @empty
      <div class="empty-state">
        📌 Belum ada destinasi. <a href="{{ route('admin.wisata.create') }}" style="color:#5EC292;font-weight:700;">+ Tambah Wisata</a>
      </div>
    @endforelse
  </div>

  <div class="footer">© 2025 Nganjuk Abirupa – Panel Admin</div>
</div>

<script>
  async function hapusWisata(id, nama) {
    if (!confirm(`Yakin ingin menghapus wisata "${nama}"?`)) return;
    window.location.href = `{{ url('/admin/wisata') }}/${id}/hapus`;
  }
</script>
</body>
</html>
