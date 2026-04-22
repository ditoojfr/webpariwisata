<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar - Nganjuk Abirupa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    * { font-family:'Poppins',Arial,sans-serif; box-sizing:border-box; margin:0; padding:0; }
    body { background:#eef3f9; min-height:100vh; display:flex; align-items:center; justify-content:center; padding:10px; }
    .container{
      width:92%; max-width:1150px; background:#fff; border-radius:22px;
      overflow:hidden; box-shadow:0 10px 40px rgba(0,0,0,.12); display:flex;
    }
    .left{
      position:relative; flex:1; min-height:540px; color:#fff;
      background:linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),
        url('{{ asset("images/nganjuk.jpg") }}') center/cover no-repeat;
      padding:28px 34px;
    }
    .left .logo{ position:absolute; top:20px; left:20px; }
    .left .logo img{ width:140px; }
    .welcome{ position:absolute; left:34px; right:34px; bottom:120px; }
    .welcome h1{ font-size:40px; line-height:1.2; margin-bottom:12px; }
    .welcome p{ opacity:.95; line-height:1.6; }
    .right{ flex:1; padding:64px 56px; background:#f7f9fc; }
    .right h2{ font-size:36px; margin-bottom:8px; color:#1f2937; }
    .right p.lead{ color:#667085; margin-bottom:28px; }
    .form-group{ margin-bottom:18px; }
    label{ display:block; font-size:14px; font-weight:600; color:#1f2937; margin-bottom:6px; }
    input{
      width:100%; padding:12px 14px; border:1.6px solid #d0d5dd;
      border-radius:12px; font-size:15px; outline:none; transition:all 0.3s;
    }
    input:focus{ border-color:#3fb27f; box-shadow:0 0 0 3px rgba(63,178,127,.15); }
    button.btn{
      width:100%; padding:12px 16px; border:none; border-radius:12px;
      background:#3fb27f; color:#fff; font-weight:700; font-size:16px;
      cursor:pointer; transition:all 0.3s;
    }
    button.btn:hover{ background:#359e71; transform:translateY(-2px); }
    .signup{ text-align:center; margin-top:18px; color:#667085; font-size:14px; }
    .signup a{ color:#3fb27f; text-decoration:none; font-weight:600; }
    @media(max-width:980px){
      .container{ flex-direction:column; }
      .left{ min-height:280px; }
      .right{ padding:34px 24px; }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <div class="logo">
        <img src="{{ asset('images/logo-light.png') }}" alt="Logo Nganjuk Abirupa">
      </div>
      <div class="welcome">
        <h1>Buat Akun Baru</h1>
        <p>Bergabunglah bersama ribuan wisatawan lainnya!<br>
        Nikmati kemudahan pemesanan tiket wisata di Nganjuk Abirupa.</p>
      </div>
    </div>

    <div class="right">
      <h2>Buat Akun</h2>
      <p class="lead">Nikmati kemudahan dalam memesan tiket wisata favoritmu secara online.</p>

      <form id="registerForm" autocomplete="off">
        @csrf
        <div class="form-group">
          <label for="fullname">Nama Lengkap</label>
          <input id="fullname" name="fullname" type="text" placeholder="Masukkan nama lengkap" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" placeholder="Masukkan email" required>
        </div>
        <div class="form-group">
          <label for="phone">No Telepon</label>
          <input id="phone" name="phone" type="tel" placeholder="Masukkan no telepon" required>
        </div>
        <div class="form-group">
          <label for="password">Kata Sandi</label>
          <input id="password" name="password" type="password" placeholder="Minimal 6 karakter" minlength="6" required>
        </div>
        <div class="form-group">
          <label for="confirm-password">Konfirmasi Kata Sandi</label>
          <input id="confirm-password" name="confirm-password" type="password" placeholder="Ulangi kata sandi" required>
        </div>

        <button class="btn" type="submit">Daftar</button>
        <div class="signup">Sudah memiliki akun? <a href="{{ route('login') }}">Login</a></div>
      </form>
    </div>
  </div>

  <script>
    let isSubmitting = false;
    document.getElementById('registerForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      if (isSubmitting) return;
      isSubmitting = true;
      const btn = document.querySelector('.btn');
      btn.disabled = true; btn.textContent = 'Memproses...';

      const password = document.getElementById('password').value;
      const confirm  = document.getElementById('confirm-password').value;
      if (password !== confirm) { alert('❌ Kata sandi tidak cocok.'); reset(); return; }
      if (password.length < 6) { alert('❌ Minimal 6 karakter.'); reset(); return; }

      const formData = new FormData(this);
      try {
        const res  = await fetch('{{ route("register") }}', { method:'POST', body:formData });
        const data = await res.json();
        if (data.success) {
          alert('✅ ' + data.message);
          window.location.href = '{{ route("login") }}';
        } else {
          alert('❌ ' + data.message);
        }
      } catch(err) {
        alert('❌ Gagal menghubungi server.');
      }
      reset();
      function reset(){ isSubmitting=false; btn.disabled=false; btn.textContent='Daftar'; }
    });
  </script>
</body>
</html>
