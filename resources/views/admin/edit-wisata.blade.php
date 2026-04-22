<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Wisata - Admin</title>
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
    .form-container{ background:#fff; border-radius:20px; padding:36px; box-shadow:0 4px 20px rgba(0,0,0,.07); max-width:700px; margin:32px auto; }
    .form-title{ font-size:24px; font-weight:800; margin-bottom:6px; }
    .form-sub{ font-size:13px; color:#667085; margin-bottom:24px; }
    .form-group{ margin-bottom:20px; }
    .form-label{ display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:8px; }
    .form-input, .form-textarea{
      width:100%; padding:11px 14px; border:1.5px solid #d0d5dd; border-radius:10px;
      font-size:14px; outline:none; transition:all 0.3s; font-family:'Poppins',Arial,sans-serif;
    }
    .form-input:focus, .form-textarea:focus{ border-color:var(--brand); box-shadow:0 0 0 3px rgba(63,178,127,.12); }
    .form-textarea{ min-height:100px; resize:vertical; }
    .form-row{ display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    @media(max-width:600px){ .form-row{ grid-template-columns:1fr; } }
    .current-image{ margin-bottom:10px; }
    .current-image img{ width:100%; height:200px; object-fit:cover; border-radius:10px; border:1px solid #e5e7eb; }
    .file-preview{ margin-top:10px; width:100%; height:180px; border-radius:10px; background:#f1f5f9; display:none; align-items:center; justify-content:center; overflow:hidden; border:2px dashed #cbd5e1; }
    .file-preview.show{ display:flex; }
    .file-preview img{ width:100%; height:100%; object-fit:cover; }
    .alert-success{ background:#d1fae5; border:1px solid #6ee7b7; color:#065f46; padding:12px 18px; border-radius:10px; margin-bottom:20px; font-weight:600; display:none; }
    .alert-error{ background:#fee2e2; border:1px solid #fca5a5; color:#dc2626; padding:12px 18px; border-radius:10px; margin-bottom:20px; display:none; }
    .btn-group{ display:flex; gap:12px; margin-top:28px; }
    .btn-submit{ background:var(--brand); color:#fff; border:none; padding:12px 28px; border-radius:10px; font-weight:700; font-size:15px; cursor:pointer; transition:all 0.2s; }
    .btn-submit:hover{ background:#2f9a6e; }
    .btn-back{ background:#f1f5f9; color:#475569; border:none; padding:12px 28px; border-radius:10px; font-weight:700; font-size:15px; cursor:pointer; }
    .btn-back:hover{ background:#e2e8f0; }
    .icons{ display:flex; gap:12px; }
    .icon{ width:46px; height:46px; border-radius:14px; background:#fff; border:1px solid #eef1f6; display:grid; place-items:center; font-size:20px; }
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
      </div>
    </div>
    <div class="icons">
      <a class="icon" href="{{ route('admin.profil') }}" title="Profil">👤</a>
    </div>
  </nav>

  <div class="form-container">
    <h2 class="form-title">Edit Wisata</h2>
    <p class="form-sub">Mengedit: <strong>{{ $wisata->nama_wisata }}</strong></p>

    <div id="alertSuccess" class="alert-success"></div>
    <div id="alertError"   class="alert-error"></div>

    <form id="editForm" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id_wisata" value="{{ $wisata->id_wisata }}">

      <div class="form-group">
        <label class="form-label">Nama Wisata <span style="color:red">*</span></label>
        <input type="text" name="nama_wisata" class="form-input"
               value="{{ $wisata->nama_wisata }}" required />
      </div>

      <div class="form-group">
        <label class="form-label">Lokasi <span style="color:red">*</span></label>
        <input type="text" name="lokasi" class="form-input"
               value="{{ $wisata->lokasi }}" required />
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Harga Tiket Dewasa (Rp)</label>
          <input type="number" name="tiket_dewasa" class="form-input"
                 value="{{ $wisata->tiket_dewasa }}" min="0" />
        </div>
        <div class="form-group">
          <label class="form-label">Harga Tiket Anak (Rp)</label>
          <input type="number" name="tiket_anak" class="form-input"
                 value="{{ $wisata->tiket_anak }}" min="0" />
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Biaya Asuransi per orang (Rp)</label>
        <input type="number" name="biaya_asuransi" class="form-input"
               value="{{ $wisata->biaya_asuransi }}" min="0" />
      </div>

      <div class="form-group">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-textarea">{{ $wisata->deskripsi }}</textarea>
      </div>

      <div class="form-group">
        <label class="form-label">Fasilitas</label>
        <textarea name="fasilitas" class="form-textarea">{{ $wisata->fasilitas }}</textarea>
      </div>

      <div class="form-group">
        <label class="form-label">Foto Wisata (kosongkan jika tidak ingin mengubah)</label>
        @if($wisata->gambar)
          <div class="current-image">
            <p style="font-size:12px;color:#667085;margin-bottom:6px;">Foto saat ini:</p>
            <img src="{{ asset('storage/destinasi/' . $wisata->gambar) }}" alt="Foto saat ini" id="currentImg">
          </div>
        @endif
        <input type="file" name="gambar" class="form-input" accept=".jpg,.jpeg,.png,.webp" id="gambarInput" />
        <small style="color:#667085;font-size:12px;">Max 5MB, format JPG/PNG/WEBP</small>
        <div class="file-preview" id="filePreview">
          <img id="previewImg" src="" alt="Preview">
        </div>
      </div>

      <div class="btn-group">
        <button type="submit" class="btn-submit">💾 Simpan Perubahan</button>
        <a href="{{ route('admin.beranda') }}" class="btn-back">← Batal</a>
      </div>
    </form>
  </div>
</div>

<script>
  // Preview gambar baru
  document.getElementById('gambarInput').addEventListener('change', function(){
    const file = this.files[0];
    if(file){
      const reader = new FileReader();
      const preview = document.getElementById('filePreview');
      reader.onload = e => {
        document.getElementById('previewImg').src = e.target.result;
        preview.classList.add('show');
        const curr = document.getElementById('currentImg');
        if(curr) curr.style.opacity = '0.4';
      };
      reader.readAsDataURL(file);
    }
  });

  // Submit AJAX
  document.getElementById('editForm').addEventListener('submit', async function(e){
    e.preventDefault();
    const btn   = this.querySelector('.btn-submit');
    const alertS= document.getElementById('alertSuccess');
    const alertE= document.getElementById('alertError');
    btn.textContent = 'Menyimpan...'; btn.disabled = true;
    alertS.style.display = 'none'; alertE.style.display = 'none';

    const formData = new FormData(this);
    try {
      const res  = await fetch('{{ route("admin.wisata.update", $wisata->id_wisata) }}', {
        method:'POST', body:formData
      });
      const data = await res.json();
      if(data.success){
        alertS.textContent = '✅ ' + data.message;
        alertS.style.display = 'block';
        setTimeout(() => window.location.href = '{{ route("admin.beranda") }}', 1500);
      } else {
        alertE.textContent = '❌ ' + data.message;
        alertE.style.display = 'block';
      }
    } catch(err){
      alertE.textContent = '❌ Terjadi kesalahan koneksi.';
      alertE.style.display = 'block';
    }
    btn.textContent = '💾 Simpan Perubahan'; btn.disabled = false;
  });
</script>
</body>
</html>
