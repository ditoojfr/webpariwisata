<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profil Saya - Nganjuk Abirupa</title>
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
    /* PROFILE LAYOUT */
    .profile-container{ display:flex; gap:28px; margin-top:32px; align-items:flex-start; }
    .sidebar{ width:280px; flex-shrink:0; background:#fff; border-radius:20px; padding:28px 22px; box-shadow:0 4px 20px rgba(0,0,0,.07); }
    .avatar{ width:100px; height:100px; border-radius:50%; overflow:hidden; margin:0 auto 14px; border:3px solid var(--brand); }
    .avatar img{ width:100%; height:100%; object-fit:cover; }
    .user-name{ text-align:center; font-weight:800; font-size:17px; margin-bottom:6px; }
    .nav-links{ margin-top:20px; display:flex; flex-direction:column; gap:8px; }
    .nav-link{ display:block; padding:10px 14px; border-radius:10px; font-weight:600; color:#4b5563; font-size:14px; transition:all 0.2s; }
    .nav-link:hover,.nav-link.active{ background:rgba(63,178,127,.1); color:var(--brand); }
    .btn-group-vertical{ display:flex; flex-direction:column; gap:10px; margin-top:20px; }
    .btn{ padding:10px 16px; border-radius:10px; font-weight:700; font-size:14px; cursor:pointer; border:none; width:100%; transition:all 0.2s; }
    .btn-primary{ background:var(--brand); color:#fff; }
    .btn-primary:hover{ background:#2f9a6e; }
    .btn-danger{ background:#fee2e2; color:#dc2626; }
    .btn-danger:hover{ background:#fecaca; }
    .btn-secondary{ background:#f1f5f9; color:#475569; }
    .btn-secondary:hover{ background:#e2e8f0; }
    /* MAIN CONTENT */
    .main-content{ flex:1; background:#fff; border-radius:20px; padding:32px; box-shadow:0 4px 20px rgba(0,0,0,.07); }
    .main-content h2{ font-size:22px; font-weight:800; margin-bottom:24px; color:#0f172a; }
    .form-group{ margin-bottom:20px; }
    .form-label{ display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:8px; }
    .form-input{ width:100%; padding:11px 14px; border:1.5px solid #d0d5dd; border-radius:10px; font-size:14px; outline:none; transition:all 0.3s; background:#f9fafb; color:#0f172a; }
    .form-input:focus{ border-color:var(--brand); background:#fff; box-shadow:0 0 0 3px rgba(63,178,127,.12); }
    .form-input:disabled{ background:#f3f4f6; color:#9ca3af; cursor:not-allowed; }
    .btn-group{ display:flex; gap:12px; margin-top:24px; }
    @media(max-width:768px){
      .profile-container{ flex-direction:column; }
      .sidebar{ width:100%; }
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
        <a href="{{ route('riwayat') }}">Riwayat</a>
        <a href="#">Tentang Kami</a>
      </div>
    </div>
    <div class="icons">
      <a class="icon active" href="{{ route('profil') }}" title="Profil">👤</a>
    </div>
  </nav>

  <div class="profile-container">
    <!-- SIDEBAR -->
    <aside class="sidebar">
      <div class="avatar">
        <img id="avatarPreview"
             src="{{ $data->foto ? asset('storage/profil/' . $data->foto) : asset('images/placeholder.jpg') }}"
             alt="Foto Profil" />
      </div>
      <div class="user-name">{{ $data->nama_customer }}</div>
      <div class="nav-links">
        <a href="{{ route('profil') }}" class="nav-link active">Profil</a>
      </div>
      <div class="btn-group-vertical">
        <button type="button" id="editBtn" class="btn btn-primary">Edit</button>
        <button type="button" id="deleteBtn" class="btn btn-danger">Hapus Akun</button>
        <button type="button" id="logoutBtn" class="btn btn-secondary">Logout</button>
      </div>
    </aside>

    <!-- FORM PROFIL -->
    <main class="main-content">
      <h2>Data Profil</h2>
      <form id="profileForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ session('user_id') }}">

        <div class="form-group">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" id="name" name="name" class="form-input"
                 value="{{ $data->nama_customer }}" placeholder="Masukkan nama lengkap" disabled required>
        </div>
        <div class="form-group">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" name="email" class="form-input"
                 value="{{ $data->email_customer }}" placeholder="Masukkan email" disabled required>
        </div>
        <div class="form-group">
          <label for="no_tlp" class="form-label">Nomor Telepon</label>
          <input type="text" id="no_tlp" name="no_tlp" class="form-input"
                 value="{{ $data->no_tlp ?? '' }}" placeholder="Masukkan nomor telepon" disabled required>
        </div>
        <div class="form-group">
          <label for="foto_profil" class="form-label">Foto Profil</label>
          <input type="file" id="foto_profil" name="foto_profil" class="form-input"
                 accept="image/*" disabled>
          <small style="color:#667085;">Maksimal 2MB, format JPG/PNG</small>
        </div>

        <div class="btn-group">
          <button type="submit" id="saveBtn" class="btn btn-primary" style="display:none;">Simpan Perubahan</button>
          <button type="button" id="cancelBtn" class="btn btn-secondary" style="display:none;">Batal</button>
        </div>
      </form>
    </main>
  </div>
</div>

<script>
  const editBtn   = document.getElementById('editBtn');
  const saveBtn   = document.getElementById('saveBtn');
  const cancelBtn = document.getElementById('cancelBtn');
  const deleteBtn = document.getElementById('deleteBtn');
  const logoutBtn = document.getElementById('logoutBtn');
  const profileForm = document.getElementById('profileForm');
  const inputs    = profileForm.querySelectorAll('input:not([type="hidden"])');

  // Simpan nilai awal
  const originalValues = {
    name:  document.getElementById('name').value,
    email: document.getElementById('email').value,
    no_tlp:document.getElementById('no_tlp').value,
    foto:  document.getElementById('avatarPreview').src,
  };

  editBtn.addEventListener('click', () => {
    inputs.forEach(i => i.disabled = false);
    editBtn.style.display  = 'none';
    saveBtn.style.display  = 'inline-block';
    cancelBtn.style.display= 'inline-block';
  });

  cancelBtn.addEventListener('click', () => {
    inputs.forEach(i => i.disabled = true);
    document.getElementById('name').value   = originalValues.name;
    document.getElementById('no_tlp').value = originalValues.no_tlp;
    document.getElementById('avatarPreview').src = originalValues.foto;
    editBtn.style.display  = 'inline-block';
    saveBtn.style.display  = 'none';
    cancelBtn.style.display= 'none';
  });

  // Preview foto
  document.getElementById('foto_profil').addEventListener('change', function(){
    const file = this.files[0];
    if(file) {
      const reader = new FileReader();
      reader.onload = e => document.getElementById('avatarPreview').src = e.target.result;
      reader.readAsDataURL(file);
    }
  });

  // Submit simpan profil
  profileForm.addEventListener('submit', async function(e){
    e.preventDefault();
    const formData = new FormData(this);
    try {
      const res  = await fetch('{{ route("profil") }}', { method:'POST', body:formData });
      const data = await res.json();
      if(data.success){
        alert('✅ ' + data.message);
        inputs.forEach(i => i.disabled = true);
        editBtn.style.display  = 'inline-block';
        saveBtn.style.display  = 'none';
        cancelBtn.style.display= 'none';
      } else {
        alert('❌ ' + data.message);
      }
    } catch(err){ alert('❌ Gagal menghubungi server.'); }
  });

  // Hapus akun
  deleteBtn.addEventListener('click', async () => {
    if(!confirm('Yakin ingin menghapus akun? Tindakan ini tidak bisa dibatalkan.')) return;
    try {
      const res  = await fetch('{{ route("profil") }}', {
        method:'DELETE',
        headers:{ 'Content-Type':'application/x-www-form-urlencoded', 'X-CSRF-TOKEN':'{{ csrf_token() }}' },
        body:'user_id={{ session("user_id") }}&role=user'
      });
      const data = await res.json();
      if(data.success) window.location.href = '{{ route("login") }}';
      else alert('❌ Gagal menghapus akun.');
    } catch(err){ alert('❌ Terjadi kesalahan.'); }
  });

  // Logout
  logoutBtn.addEventListener('click', () => {
    window.location.href = '{{ route("logout") }}';
  });
</script>
</body>
</html>
