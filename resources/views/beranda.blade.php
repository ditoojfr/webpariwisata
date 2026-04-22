<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Beranda - Nganjuk Abirupa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root{ --panel:#eef3f9; --brand:#3fb27f; --text:#0f172a; --muted:#667085; --nav:#e1e6ec; }
    *{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',Arial,sans-serif; }
    body{ background:var(--panel); color:var(--text); }
    a{ color:inherit; text-decoration:none; }
    .wrap{ width:92%; max-width:1150px; margin:24px auto 48px; }
    /* NAVBAR */
    .nav{ display:flex; align-items:center; justify-content:space-between; background:var(--nav); border-radius:52px; padding:14px 22px; box-shadow:0 10px 30px rgba(0,0,0,.06); }
    .logo img{ height:40px; }
    .menu-container{ flex:1; display:flex; justify-content:center; }
    .menu{ display:flex; gap:42px; align-items:center; }
    .menu a{ font-weight:700; color:#4b5563; position:relative; }
    .menu a.active{ color:#101827; }
    .menu a.active::after{ content:""; position:absolute; bottom:-12px; left:0; width:100%; height:4px; border-radius:4px; background:#fbbf24; }
    .icons{ display:flex; gap:12px; }
    .icon{ width:46px; height:46px; border-radius:14px; background:#fff; border:1px solid #eef1f6; display:grid; place-items:center; font-size:20px; color:#5b5fad; }
    /* HERO */
    .hero{ margin-top:18px; position:relative; background:linear-gradient(rgba(0,0,0,.35),rgba(0,0,0,.35)),url('{{ asset("images/nganjuk-abirupa.png") }}') center/cover no-repeat; height:460px; border-radius:24px; overflow:hidden; }
    .hero .text{ position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); color:#fff; text-align:center; max-width:700px; padding:0 20px; }
    .hero h1{ font-size:38px; line-height:1.2; margin-bottom:8px; text-shadow:0 3px 14px rgba(0,0,0,.5); }
    .hero p{ font-size:15px; opacity:.95; text-shadow:0 2px 10px rgba(0,0,0,.5); }
    /* INFO */
    .info-card{ position:relative; margin:-26px auto 0; width:92%; max-width:1150px; padding:22px 34px; background:rgba(245,246,248,.95); border-radius:22px; box-shadow:0 10px 30px rgba(0,0,0,.1); display:flex; flex-direction:column; gap:10px; }
    .info-top{ display:flex; justify-content:center; align-items:flex-start; flex-wrap:wrap; gap:20px; }
    .info-title{ font-weight:800; font-size:20px; margin-bottom:6px; }
    .info-sub{ font-size:14px; color:#4b5563; line-height:1.5; }
    .ig-row{ display:flex; gap:14px; justify-content:center; }
    .ig-chip{ display:inline-flex; align-items:center; gap:8px; padding:8px 14px; border-radius:12px; background:#fff; border:1px solid #e5e7eb; color:#374151; font-weight:600; font-size:13.5px; }
    .info-addr{ color:#94a3b8; font-size:12.5px; text-align:center; margin-top:4px; }
    /* GRID */
    .section{ margin-top:8px; }
    .section h2{ font-size:30px; margin:28px 4px 6px; }
    .section small{ color:#6b7280; margin-left:4px; }
    .grid{ display:grid; gap:22px; }
    .grid.populer{ grid-template-columns:repeat(2,minmax(0,400px)); justify-content:start; }
    .grid.destinasi{ grid-template-columns:repeat(3,minmax(0,1fr)); }
    @media(max-width:1000px){ .grid.destinasi{ grid-template-columns:repeat(2,minmax(0,1fr)); } }
    @media(max-width:700px){ .hero{ height:300px; } .grid.populer,.grid.destinasi{ grid-template-columns:1fr; } }
    /* CARD */
    .card{ background:#fff; border-radius:18px; overflow:hidden; box-shadow:0 10px 26px rgba(0,0,0,.08); }
    .thumb{ width:100%; height:240px; background-size:cover; background-position:center; }
    .content{ padding:6px 10px 8px; }
    .title{ font-weight:700; margin-bottom:2px; font-size:15px; }
    .loc{ display:flex; align-items:center; gap:6px; color:#6b7280; font-size:12px; }
    .meta{ display:flex; justify-content:space-between; align-items:center; margin-top:6px; }
    .badge{ background:#f3f4f6; border-radius:12px; padding:4px 8px; font-size:12px; font-weight:600; }
    .selengkapnya{ background:#3fb27f; color:white; border:none; padding:6px 16px; border-radius:8px; font-weight:700; font-size:13px; cursor:pointer; }
    .selengkapnya:hover{ background:#2f9a6e; }
    /* FOOTER */
    .footer{ text-align:center; color:#fff; font-size:13px; font-weight:500; padding:18px 0; margin-top:90px; background:#5EC292; }
    /* MODAL */
    .modal{ position:fixed; inset:0; display:none; align-items:center; justify-content:center; background:rgba(0,0,0,.35); z-index:50; padding:24px; }
    .modal.open{ display:flex; }
    .modal-card{ width:100%; max-width:1000px; background:#fff; border-radius:18px; box-shadow:0 20px 50px rgba(0,0,0,.2); display:grid; grid-template-columns:1.2fr .9fr; gap:18px; padding:18px; }
    @media(max-width:900px){ .modal-card{ grid-template-columns:1fr; } }
    .modal-header{ display:flex; align-items:center; gap:12px; margin-bottom:8px; position:relative; }
    .modal-title{ font-weight:800; font-size:20px; }
    .modal-sub{ color:#6b7280; font-size:12px; }
    .modal-photo{ width:120px; height:120px; border-radius:12px; background:#eee; background-size:cover; background-position:center; }
    .xclose{ margin-left:auto; width:36px; height:36px; border-radius:10px; background:#f3f4f6; border:1px solid #e5e7eb; display:grid; place-items:center; cursor:pointer; }
    .box{ background:#f9fafb; border:1px solid #eef; border-radius:14px; padding:14px; }
    .muted{ color:#6b7280; font-size:12px; }
    .price{ font-weight:700; color:#0f172a; }
    .form{ display:grid; gap:10px; }
    .input,.select{ width:100%; padding:8px 10px; border-radius:8px; border:1px solid #e5e7eb; outline:none; font-size:13px; background:#fff; }
    .btn-primary{ background:#5EC292; border:none; color:#fff; font-weight:700; padding:10px 12px; border-radius:10px; cursor:pointer; font-size:14px; width:100%; }
    .btn-primary:hover{ background:#4FB17F; }
    .right-col{ background:#f6faf8; border:1px solid #e7f4ed; border-radius:14px; padding:14px; display:flex; flex-direction:column; justify-content:center; gap:10px; }
    .pill{ background:#eef7f2; border:1px solid #d9efe4; border-radius:10px; padding:6px 10px; }
    .pill-row{ display:flex; gap:12px; flex-wrap:wrap; }
    .row-price{ display:flex; gap:14px; font-size:13px; }
    .info-row{ display:grid; grid-template-columns:1fr 1fr; gap:14px; margin:8px 0 12px; }
    .info-box{ background:#fff; border:1px solid #e6ebf2; border-radius:12px; padding:12px 14px; }
    .info-label{ font-weight:700; color:#0f172a; margin-bottom:8px; font-size:14px; }
    .subtotal{ display:flex; justify-content:space-between; align-items:center; margin:8px 0 2px; font-size:13px; }
    .date-input{ width:100%; background:#fff; border:1px solid #e6ebf2; border-radius:10px; padding:10px 12px; font-size:14px; }
    /* PICKER */
    .picker-overlay{ position:fixed; inset:0; background:rgba(2,6,23,.45); display:none; z-index:60; align-items:center; justify-content:center; }
    .picker-overlay.show{ display:flex; }
    .picker-card{ width:min(520px,92vw); background:#f7fafc; border:1px solid #e6edf5; border-radius:16px; padding:18px; }
    .picker-title{ font-weight:800; text-align:center; margin-bottom:10px; }
    .sep{ height:1px; background:#e9eff6; margin:10px 0; }
    .row-pick{ display:flex; align-items:center; justify-content:space-between; padding:10px 0; }
    .ctrl{ display:flex; align-items:center; gap:8px; }
    .btn-ctr{ width:32px; height:32px; border-radius:8px; border:1px solid #dbe6ee; background:#fff; display:grid; place-items:center; cursor:pointer; }
    .num{ min-width:34px; text-align:center; border:1px solid #dbe6ee; background:#fff; border-radius:8px; padding:6px 10px; }
    .picker-save{ margin-top:10px; width:100%; padding:12px 14px; border:0; border-radius:10px; background:#5EC292; color:#fff; font-weight:700; cursor:pointer; }
    .picker-trigger{ width:100%; display:flex; align-items:center; justify-content:space-between; border:1px solid #e5e7eb; background:#fff; border-radius:10px; padding:10px 12px; cursor:pointer; }
    .spinner{ display:inline-block; width:20px; height:20px; border:2px solid rgba(63,178,127,.3); border-radius:50%; border-top-color:#3fb27f; animation:spin 1s infinite; }
    @keyframes spin{ to{ transform:rotate(360deg); } }
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
        <a href="{{ route('beranda') }}" class="active">Beranda</a>
        <a href="{{ route('riwayat') }}">Riwayat</a>
        <a href="#">Tentang Kami</a>
      </div>
    </div>
    <div class="icons">
      <a class="icon" href="{{ route('profil') }}" title="Profil">👤</a>
    </div>
  </nav>

  <!-- HERO -->
  <div class="hero">
    <div class="text">
      <h1>Selamat Datang di Nganjuk Abirupa</h1>
      <p>Jelajahi destinasi terbaik dengan kemudahan digital. Temukan tiket, event, dan pengalaman wisata hanya dalam satu platform.</p>
    </div>
  </div>

  <!-- INFO -->
  <div class="info-card">
    <div class="info-top">
      <div>
        <div class="info-title">Akses informasi</div>
        <div class="info-sub">Informasi terkait Dinas Kepemudaan, Olahraga, Kebudayaan dan Pariwisata Kabupaten Nganjuk</div>
      </div>
      <div>
        <div class="ig-row">
          <a href="https://www.instagram.com/dinasporabudpar_nganjuk/" target="_blank" style="color:#3fb27f;" class="ig-chip">IG: @dinasporabudpar_nganjuk</a>
          <a href="mailto:disbudparda@nganjukkab.go.id" style="color:#3fb27f;" class="ig-chip">📧 disbudparda@nganjukkab.go.id</a>
        </div>
        <div class="info-addr">Mangundikaran, Nganjuk, East Java 64419</div>
      </div>
    </div>
  </div>

  <!-- WISATA POPULER -->
  <section class="section">
    <h2>Wisata Populer</h2>
    <small>Let's enjoy heaven on Nganjuk</small>
    <div class="grid populer">
      @foreach($destinasi->take(2) as $d)
        <article class="card">
          <div class="thumb" style="background-image:url('{{ asset("storage/destinasi/" . $d->gambar) }}')"></div>
          <div class="content">
            <div class="title">{{ $d->nama_wisata }}</div>
            <div class="loc">📍 {{ $d->lokasi }}</div>
            <div class="meta"><span class="badge">⭐ 4/5</span></div>
          </div>
        </article>
      @endforeach
    </div>
  </section>

  <!-- SEMUA DESTINASI -->
  <section class="section">
    <h2>Destinasi Wisata Nganjuk</h2>
    <div class="grid destinasi">
      @forelse($destinasi as $d)
        <article class="card">
          <div class="thumb" style="background-image:url('{{ asset("storage/destinasi/" . ($d->gambar ?: "placeholder.jpg")) }}')"></div>
          <div class="content">
            <div class="title">{{ $d->nama_wisata }}</div>
            <div class="loc">📍 {{ $d->lokasi }}</div>
            <div class="meta">
              <span class="badge">⭐ 4/5</span>
              <button class="selengkapnya"
                data-id="{{ $d->id_wisata }}"
                data-title="{{ $d->nama_wisata }}"
                data-lokasi="{{ $d->lokasi }}"
                data-foto="{{ asset('storage/destinasi/' . $d->gambar) }}"
                data-dewasa="{{ $d->tiket_dewasa }}"
                data-anak="{{ $d->tiket_anak }}"
                data-asuransi="{{ $d->biaya_asuransi ?? 500 }}"
                data-deskripsi="{{ $d->deskripsi }}"
                data-fasilitas="{{ $d->fasilitas }}">
                Selengkapnya
              </button>
            </div>
          </div>
        </article>
      @empty
        <div style="grid-column:1/-1;text-align:center;padding:40px;color:#6b7280;">
          📌 Belum ada destinasi.
        </div>
      @endforelse
    </div>
  </section>

  <div class="footer">© 2025 Nganjuk Abirupa – Disparbudpar Nganjuk. All rights reserved.</div>
</div>

<!-- MODAL DETAIL WISATA -->
<div class="modal" id="detailModal">
  <div class="modal-card">
    <div class="left-col">
      <div class="modal-header">
        <div class="modal-photo" id="mPhoto"></div>
        <div>
          <div class="modal-title" id="mTitle"></div>
          <div class="modal-sub" id="mLoc"></div>
        </div>
        <button class="xclose" id="btnClose">✕</button>
      </div>
      <div class="info-row">
        <div class="info-box">
          <div class="info-label">Tanggal Kunjungan</div>
          <input type="date" id="detailDate" class="date-input">
        </div>
        <div class="info-box">
          <div class="info-label">Harga Tiket</div>
          <div class="pill-row">
            <div class="pill">Dewasa: <span class="price" id="mAdult">Rp 0</span></div>
            <div class="pill">Anak: <span class="price" id="mChild">Rp 0</span></div>
          </div>
        </div>
      </div>
      <div class="box" style="margin-bottom:10px">
        <div style="font-weight:700;margin-bottom:6px">Deskripsi</div>
        <div class="muted" id="mDesc">—</div>
      </div>
      <div class="box">
        <div style="font-weight:700;margin-bottom:6px">Fasilitas</div>
        <div class="muted" id="mFac">—</div>
      </div>
    </div>
    <div class="right-col">
      <div style="font-weight:800;margin-bottom:8px;text-align:center;">Detail Pesanan</div>
      <form class="form" id="formOrder">
        @csrf
        <div>
          <label class="muted">Nama Lengkap *</label>
          <input class="input" type="text" name="nama_customer" placeholder="Nama kamu" required>
        </div>
        <div>
          <label class="muted">No Telepon *</label>
          <input class="input" type="tel" name="tlp_customer" placeholder="08xxxxxxxxxx" required>
        </div>
        <div>
          <label class="muted">Pengunjung *</label>
          <button type="button" class="picker-trigger" id="openPicker">
            <span>Atur jumlah pengunjung</span>
            <strong id="pickerSummary">Dewasa 0 · Anak 0</strong>
          </button>
          <input type="hidden" id="qtyAdult" value="0">
          <input type="hidden" id="qtyChild" value="0">
        </div>
        <div class="subtotal"><span class="muted">Sub total :</span><strong id="mSubtotal">Rp 0</strong></div>
        <div class="subtotal"><span class="muted">Biaya Asuransi :</span><strong id="mAsuransi">Rp 0</strong></div>
        <div class="subtotal" style="margin-top:16px;padding-top:12px;border-top:1px solid #e2e8f0;">
          <span style="font-weight:700;">Total Pembayaran :</span>
          <strong id="mTotalAkhir" style="color:#0f172a;font-size:18px;">Rp 0</strong>
        </div>
        <button class="btn-primary" type="submit">Pesan Sekarang</button>
      </form>
    </div>
  </div>
</div>

<!-- PICKER PENGUNJUNG -->
<div class="picker-overlay" id="picker">
  <div class="picker-card">
    <div class="picker-title">Pilih Pengunjung</div>
    <div class="sep"></div>
    <div class="row-pick">
      <div><strong>Dewasa</strong><br><small style="color:#94a3b8">10 tahun ke atas</small></div>
      <div class="ctrl">
        <button type="button" class="btn-ctr" id="aMin">−</button>
        <div class="num" id="aNum">00</div>
        <button type="button" class="btn-ctr" id="aPlus">+</button>
      </div>
    </div>
    <div class="sep"></div>
    <div class="row-pick">
      <div><strong>Anak</strong><br><small style="color:#94a3b8">Dibawah 10 tahun</small></div>
      <div class="ctrl">
        <button type="button" class="btn-ctr" id="cMin">−</button>
        <div class="num" id="cNum">00</div>
        <button type="button" class="btn-ctr" id="cPlus">+</button>
      </div>
    </div>
    <div class="sep"></div>
    <button class="picker-save" id="savePick">Simpan</button>
  </div>
</div>

<!-- MODAL QRIS -->
<div class="modal" id="qrisModal">
  <div class="modal-card" style="max-width:420px;display:block;padding:0;">
    <div style="background:linear-gradient(135deg,#f0f9ff,#e6f7ee);padding:20px 24px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #dbeafe;">
      <div>
        <div style="font-size:14px;font-weight:700;">QRIS</div>
        <div style="font-weight:800;font-size:18px;">Nganjuk Abirupa</div>
      </div>
      <button class="xclose" id="btnCloseQris">✕</button>
    </div>
    <div style="background:#fff;padding:24px;display:flex;flex-direction:column;gap:20px;">
      <div id="qrisBarcodeContainer" style="text-align:center;display:none;">
        <img id="qrisBarcodeImg" src="" alt="QRIS" style="width:140px;height:140px;border:2px solid #e2e8f0;border-radius:12px;object-fit:cover;">
      </div>
      <div style="font-size:14px;color:#4b5563;line-height:1.5;">
        <div><strong id="qrisDestinasi"></strong></div>
        <div>Tanggal: <span id="qrisTanggal"></span></div>
        <div>Pengunjung: <span id="qrisPengunjung"></span></div>
        <div style="margin-top:12px;font-weight:800;font-size:17px;background:#f0fdf4;padding:8px 12px;border-radius:10px;border:1px solid #bbf7d0;">
          Total: <span id="qrisTotal"></span>
        </div>
      </div>
      <div style="text-align:center;color:#6b7280;font-size:13px;">
        Scan barcode dan masukkan jumlah nominal yang sudah tertera.
      </div>
      <div style="display:flex;gap:8px;">
        <button class="btn-primary" id="btnConfirmPayment" style="flex:1;background:#3fb27f;padding:12px;border-radius:10px;">Konfirmasi</button>
        <button class="btn-primary" id="btnCancelPayment" style="flex:1;background:#e2e8f0;color:#1e293b;padding:12px;border-radius:10px;">Batal</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL SUKSES -->
<div class="modal" id="successModal">
  <div class="modal-card" style="max-width:360px;display:block;padding:20px;text-align:center;">
    <div style="width:60px;height:60px;background:#3fb27f;border-radius:50%;display:grid;place-items:center;margin:0 auto 16px;">
      <span style="font-size:30px;color:#fff;font-weight:800;">✓</span>
    </div>
    <h3 style="font-weight:800;font-size:20px;margin-bottom:8px;">Pembayaran Berhasil!</h3>
    <p style="color:#6b7280;font-size:14px;margin-bottom:20px;">Terima kasih telah menggunakan Nganjuk Abirupa.</p>
    <button class="btn-primary" id="btnSuccessOk" style="padding:12px;font-weight:700;background:#6ee7b7;color:#0f172a;border-radius:10px;">Oke, Tutup</button>
  </div>
</div>

<script>
  // Data destinasi dari Laravel (JSON)
  const DESTINASI = @json($destinasi->keyBy(fn($d) => 'wisata_' . $d->id_wisata)->map(fn($d) => [
    'id'           => $d->id_wisata,
    'title'        => $d->nama_wisata,
    'lokasi'       => $d->lokasi,
    'foto'         => asset('storage/destinasi/' . $d->gambar),
    'harga_dewasa' => (int)$d->tiket_dewasa,
    'harga_anak'   => (int)$d->tiket_anak,
    'harga_asuransi'=> (int)($d->biaya_asuransi ?? 500),
    'deskripsi'    => $d->deskripsi ?? '',
    'fasilitas'    => $d->fasilitas ?? '',
  ]));

  const ID_CUSTOMER = {{ session('id_customer', 0) }};
  const rupiah = n => "Rp " + (n|0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

  let currentId = null;
  const modal         = document.getElementById("detailModal");
  const qrisModal     = document.getElementById("qrisModal");
  const successModal  = document.getElementById("successModal");
  const picker        = document.getElementById("picker");
  const detailDate    = document.getElementById("detailDate");
  const qtyAdultInput = document.getElementById("qtyAdult");
  const qtyChildInput = document.getElementById("qtyChild");

  function rupiah2(n){ return "Rp " + (n|0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); }

  function recalc(){
    const A = parseInt(qtyAdultInput.value||"0",10);
    const C = parseInt(qtyChildInput.value||"0",10);
    const d = DESTINASI[currentId];
    const subtotal = A*d.harga_dewasa + C*d.harga_anak;
    const asuransi = (A+C)*d.harga_asuransi;
    document.getElementById("mSubtotal").textContent  = rupiah2(subtotal);
    document.getElementById("mAsuransi").textContent  = rupiah2(asuransi);
    document.getElementById("mTotalAkhir").textContent= rupiah2(subtotal+asuransi);
    document.getElementById("pickerSummary").textContent = `Dewasa ${A} · Anak ${C}`;
    document.getElementById("aNum").textContent = String(A).padStart(2,"0");
    document.getElementById("cNum").textContent = String(C).padStart(2,"0");
  }

  function openModal(id){
    const d = DESTINASI[id]; if(!d) return;
    currentId = id;
    document.getElementById("mPhoto").style.backgroundImage = `url('${d.foto}')`;
    document.getElementById("mTitle").textContent = d.title;
    document.getElementById("mLoc").textContent   = d.lokasi;
    document.getElementById("mAdult").textContent = rupiah2(d.harga_dewasa);
    document.getElementById("mChild").textContent = rupiah2(d.harga_anak);
    document.getElementById("mDesc").textContent  = d.deskripsi;
    document.getElementById("mFac").textContent   = d.fasilitas;
    qtyAdultInput.value = "0"; qtyChildInput.value = "0";
    detailDate.value = ""; detailDate.min = new Date().toISOString().split("T")[0];
    recalc();
    modal.classList.add("open");
  }
  function closeModal(){ modal.classList.remove("open"); }
  function closeQrisModal(){ qrisModal.classList.remove("open"); }
  function closeSuccessModal(){ successModal.classList.remove("open"); }

  function openQrisModal(){
    const d = DESTINASI[currentId];
    const A = parseInt(qtyAdultInput.value||"0",10);
    const C = parseInt(qtyChildInput.value||"0",10);
    const subtotal = A*d.harga_dewasa + C*d.harga_anak;
    const asuransi = (A+C)*d.harga_asuransi;
    const total    = subtotal + asuransi;
    const tanggal  = detailDate.value ? new Date(detailDate.value).toLocaleDateString('id-ID',{day:'numeric',month:'short',year:'numeric'}) : "Belum dipilih";
    let pengunjung = [];
    if(A>0) pengunjung.push(`${A} Dewasa`);
    if(C>0) pengunjung.push(`${C} Anak`);

    document.getElementById("qrisDestinasi").textContent  = d.title;
    document.getElementById("qrisTanggal").textContent    = tanggal;
    document.getElementById("qrisPengunjung").textContent = pengunjung.join(", ") || "0 Pengunjung";
    document.getElementById("qrisTotal").textContent      = rupiah2(total);

    const container = document.getElementById("qrisBarcodeContainer");
    const img       = document.getElementById("qrisBarcodeImg");
    const idNum     = currentId.replace("wisata_","");
    if(d.title.toLowerCase().includes("roro kuning")){
      container.style.display = "none";
    } else {
      container.style.display = "block";
      img.src = `{{ asset('images/qrisss') }}/${idNum}.png`;
      img.onerror = () => { img.src = "{{ asset('images/qrisss/default.png') }}"; };
    }
    qrisModal.classList.add("open");
  }

  // Event: tombol selengkapnya
  document.querySelectorAll(".selengkapnya[data-id]").forEach(btn => {
    btn.addEventListener("click", () => openModal("wisata_" + btn.dataset.id));
  });

  document.getElementById("btnClose").addEventListener("click", closeModal);
  modal.addEventListener("click", e => { if(e.target===modal) closeModal(); });
  document.getElementById("btnCloseQris").addEventListener("click", closeQrisModal);
  document.getElementById("btnCancelPayment").addEventListener("click", closeQrisModal);
  qrisModal.addEventListener("click", e => { if(e.target===qrisModal) closeQrisModal(); });
  document.getElementById("btnSuccessOk").addEventListener("click", closeSuccessModal);

  document.getElementById("openPicker").addEventListener("click", () => picker.classList.add("show"));
  document.getElementById("savePick").addEventListener("click", () => { picker.classList.remove("show"); recalc(); });
  picker.addEventListener("click", e => { if(e.target===picker) picker.classList.remove("show"); });

  ["aMin","aPlus","cMin","cPlus"].forEach(id => {
    document.getElementById(id).addEventListener("click", () => {
      const isAdult  = id.startsWith("a");
      const isPlus   = id.endsWith("Plus");
      const input    = isAdult ? qtyAdultInput : qtyChildInput;
      const val      = parseInt(input.value||"0",10);
      input.value    = isPlus ? Math.min(20,val+1) : Math.max(0,val-1);
      recalc();
    });
  });

  // Submit form order → buka qris
  document.getElementById("formOrder").addEventListener("submit", function(e){
    e.preventDefault();
    if(!detailDate.value){ alert("Pilih tanggal kunjungan!"); return; }
    const A = parseInt(qtyAdultInput.value||"0",10);
    const C = parseInt(qtyChildInput.value||"0",10);
    if(A+C===0){ alert("Tentukan jumlah pengunjung minimal 1 orang."); return; }
    openQrisModal();
  });

  // Konfirmasi pembayaran → simpan transaksi
  document.getElementById("btnConfirmPayment").addEventListener("click", async () => {
    if(ID_CUSTOMER === 0){ alert("⚠️ Anda belum login."); return; }
    const btn = document.getElementById("btnConfirmPayment");
    const d   = DESTINASI[currentId];
    const nama    = document.querySelector('#formOrder input[name="nama_customer"]').value.trim();
    const telepon = document.querySelector('#formOrder input[name="tlp_customer"]').value.trim();
    const tanggal = detailDate.value;
    const A = parseInt(qtyAdultInput.value||"0",10);
    const C = parseInt(qtyChildInput.value||"0",10);
    const subtotal = A*d.harga_dewasa + C*d.harga_anak;
    const asuransi = (A+C)*d.harga_asuransi;
    const total    = subtotal + asuransi;
    const idWisata = currentId.replace("wisata_","");

    btn.innerHTML = '<span class="spinner"></span> Memproses...';
    btn.disabled  = true;

    try {
      const res  = await fetch("{{ route('transaksi.store') }}", {
        method: "POST",
        headers: { "Content-Type":"application/x-www-form-urlencoded" },
        body: new URLSearchParams({
          _token:        "{{ csrf_token() }}",
          nama_customer: nama,
          tlp_customer:  telepon,
          tanggal_pesan: tanggal,
          jml_tiket:     A + C,
          harga_total:   total,
          id_wisata:     idWisata,
          id_customer:   ID_CUSTOMER,
        })
      });
      const data = await res.json();
      if(data.success){
        closeQrisModal(); closeModal();
        successModal.classList.add("open");
      } else {
        alert("❌ " + data.message);
      }
    } catch(err){
      alert("❌ Terjadi kesalahan koneksi.");
    }

    btn.innerHTML = "Konfirmasi"; btn.disabled = false;
  });
</script>
</body>
</html>
