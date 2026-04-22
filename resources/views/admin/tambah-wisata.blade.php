<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Wisata - Admin</title>
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
    /* FORM */
    .form-container{ background:#fff; border-radius:20px; padding:36px; box-shadow:0 4px 20px rgba(0,0,0,.07); max-width:700px; margin:32px auto; }
    .form-title{ font-size:24px; font-weight:800; margin-bottom:24px; }
    .form-group{ margin-bottom:20px; }
    .form-label{ display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:8px; }
    .form-input, .form-textarea, .form-select{
      width:100%; padding:11px 14px; border:1.5px solid #d0d5dd; border-radius:10px;
      font-size:14px; outline:none; transition:all 0.3s; font-family:'Poppins',Arial,sans-serif;
    }
    .form-input:focus, .form-textarea:focus, .form-select:focus{
      border-color:var(--brand); box-shadow:0 0 0 3px rgba(63,178,127,.12);
    }
    .form-textarea{ min-height:100px; resize:vertical; }
    .form-row{ display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    @media(max-width:600px){ .form-row{ grid-template-columns:1fr; } }
    .file-preview{ margin-top:10px; width:100%; height:180px; border-radius:10px; background:#f1f5f9; display:flex; align-items:center; justify-content:center; overflow:hidden; border:2px dashed #cbd5e1; }
    .file-preview img{ width:100%; height:100%; object-fit:cover; display:none; }
    .alert-error{ background:#fee2e2; border:1px solid #fca5a5; color:#dc2626; padding:12px 18px; border-radius:10px; margin-bottom:20px; font-weight:600; }
    .btn-group{ display:flex; gap:12px; margin-top:28px; }
    .btn-submit{ background:var(--brand); color:#fff; border:none; padding:12px 28px; border-radius:10px; font-weight:700; font-size:15px; cursor:pointer; transition:all 0.2s; }
    .btn-submit:hover{ background:#2f9a6e; }
    .btn-back{ background:#f1f5f9; color:#475569; border:none; padding:12px 28px; border-radius:10px; font-weight:700; font-size:15px; cursor:pointer; }
    .btn-back:hover{ background:#e2e8f0; }
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

  <div class="form-container">
    <h2 class="form-title">Tambah Wisata Baru</h2>

    @if($errors->any())
      <div class="alert-error">
        @foreach($errors->all() as $err)
          <div>⚠️ {{ $err }}</div>
        @endforeach
      </div>
    @endif

    <form id="addForm" method="POST" action="{{ route('admin.wisata.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label for="nama_wisata" class="form-label">Nama Wisata <span style="color:red">*</span></label>
        <input type="text" id="nama_wisata" name="nama_wisata" class="form-input"
               placeholder="Contoh: Air Terjun Sedudo" value="{{ old('nama_wisata') }}" required />
      </div>

      <div class="form-group">
        <label for="lokasi" class="form-label">Lokasi <span style="color:red">*</span></label>
        <input type="text" id="lokasi" name="lokasi" class="form-input"
               placeholder="Contoh: Sawahan, Nganjuk" value="{{ old('lokasi') }}" required />
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="harga_dewasa" class="form-label">Harga Tiket Dewasa (Rp)</label>
          <input type="number" id="harga_dewasa" name="harga_dewasa" class="form-input"
                 placeholder="Contoh: 10000" min="0" value="{{ old('harga_dewasa') }}" />
        </div>
        <div class="form-group">
          <label for="harga_anak" class="form-label">Harga Tiket Anak (Rp)</label>
          <input type="number" id="harga_anak" name="harga_anak" class="form-input"
                 placeholder="Contoh: 8000" min="0" value="{{ old('harga_anak') }}" />
        </div>
      </div>

      <div class="form-group">
        <label for="biaya_asuransi" class="form-label">Biaya Asuransi per orang (Rp)</label>
        <input type="number" id="biaya_asuransi" name="biaya_asuransi" class="form-input"
               placeholder="Contoh: 500" min="0" value="{{ old('biaya_asuransi', 500) }}" />
      </div>

      <div class="form-group">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" class="form-textarea"
                  placeholder="Deskripsi singkat tentang wisata ini...">{{ old('deskripsi') }}</textarea>
      </div>

      <div class="form-group">
        <label for="fasilitas" class="form-label">Fasilitas</label>
        <textarea id="fasilitas" name="fasilitas" class="form-textarea"
                  placeholder="Contoh: Toilet, Parkir, Warung Makan...">{{ old('fasilitas') }}</textarea>
      </div>

      <div class="form-group">
        <label for="gambar" class="form-label">Foto Wisata <span style="color:red">*</span></label>
        <input type="file" id="gambar" name="gambar" class="form-input"
               accept=".jpg,.jpeg,.png,.webp" required />
        <small style="color:#667085;font-size:12px;">Max 5MB, format JPG/PNG/WEBP</small>
        <div class="file-preview" id="filePreview">
          <img id="previewImg" src="" alt="Preview gambar">
          <span id="previewText" style="color:#94a3b8;font-size:13px;">Preview gambar akan muncul di sini</span>
        </div>
      </div>

      <div class="btn-group">
        <button type="submit" class="btn-submit">💾 Simpan Wisata</button>
        <a href="{{ route('admin.beranda') }}" class="btn-back">← Batal</a>
      </div>
    </form>
  </div>
</div>

<script>
  // Preview gambar sebelum upload
  document.getElementById('gambar').addEventListener('change', function(){
    const file = this.files[0];
    if(file){
      const reader = new FileReader();
      reader.onload = e => {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('previewImg').style.display = 'block';
        document.getElementById('previewText').style.display = 'none';
      };
      reader.readAsDataURL(file);
    }
  });
</script>
</body>
</html>
