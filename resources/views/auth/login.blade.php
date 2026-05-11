<!DOCTYPE html>
<html lang="id">
<head>
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Nganjuk Abirupa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  {{-- CSRF token di meta tag — cara standar Laravel --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    :root{
      --bg:#f9fafb; --ink:#0f172a; --muted:#667085; --line:#e6edf5;
      --brand:#3fb27f; --brand-d:#2f9a6e; --card:#ffffff;
      --shadow:0 8px 24px rgba(0,0,0,.08);
    }
    *{ box-sizing:border-box; margin:0; padding:0; font-family:'Poppins',Arial,sans-serif; }
    body{
      min-height:100vh;
      background:linear-gradient(135deg,#f0f9ff 0%,#e6f7ee 100%);
      display:flex; align-items:center; justify-content:center;
    }
    .container{
      width:min(1150px,96vw); background:#fff; border-radius:24px;
      overflow:hidden; box-shadow:var(--shadow);
      display:grid; grid-template-columns:1fr 1fr;
    }
    @media(max-width:980px){ .container{ grid-template-columns:1fr; } }
    .left{
      background:linear-gradient(135deg,#e6f7ee 0%,#f0f9ff 100%);
      display:flex; flex-direction:column; justify-content:center;
      padding:40px 32px; text-align:center;
    }
    .left .logo{ margin-bottom:24px; }
    .left .logo img{ height:40px; }
    .left h1{ font-size:32px; font-weight:800; margin-bottom:12px; color:var(--ink); }
    .left p{ font-size:15px; line-height:1.6; color:var(--muted); }
    .right{ background:var(--card); padding:40px 32px; display:flex; flex-direction:column; gap:20px; }
    .header{
      background:linear-gradient(90deg,#34a36f,#1f8adf); color:#fff;
      padding:20px 24px; text-align:center; border-radius:16px;
    }
    .header h1{ font-size:28px; font-weight:800; }
    .header p{ font-size:14px; opacity:.95; margin-top:6px; }
    .tabs{ display:flex; justify-content:center; gap:10px; margin-top:12px; }
    .tab{
      background:rgba(255,255,255,.2); border:1px solid rgba(255,255,255,.4);
      padding:10px 18px; border-radius:12px; font-weight:700; font-size:14px;
      color:#fff; cursor:pointer; transition:all 0.2s; user-select:none;
    }
    .tab.active{ background:#fff; color:var(--brand); border-color:#fff; }
    .tab:hover:not(.active){ background:rgba(255,255,255,.35); }
    .card{ background:#fff; border:1px solid var(--line); border-radius:16px; padding:24px; box-shadow:var(--shadow); }
    .form-group{ margin-bottom:20px; }
    label{ display:block; font-size:13.5px; color:#1f2937; font-weight:600; margin-bottom:8px; }
    .input-wrap{
      display:flex; align-items:center; gap:10px;
      border:1.6px solid #d0d5dd; border-radius:12px;
      background:#fff; padding:12px 14px; transition:all 0.3s;
    }
    .input-wrap:focus-within{ border-color:var(--brand); box-shadow:0 0 0 3px rgba(63,178,127,.2); }
    .input-wrap input{ border:0; outline:0; width:100%; font-size:15px; background:transparent; color:var(--ink); }
    .input-wrap svg{ flex:none; opacity:.55; width:18px; height:18px; }
    .input-wrap button.eye-btn{ background:none; border:none; cursor:pointer; padding:0; display:flex; }
    .btn{
      width:100%; border:0; border-radius:12px; background:var(--brand); color:#fff;
      font-weight:800; padding:13px 16px; font-size:16px; cursor:pointer;
      margin-top:14px; transition:all 0.3s;
    }
    .btn:hover:not(:disabled){ background:var(--brand-d); transform:translateY(-1px); }
    .btn:disabled{ opacity:.7; cursor:not-allowed; transform:none; }
    .below{ text-align:center; margin-top:14px; font-size:14px; color:var(--muted); }
    .below a{ color:var(--brand); text-decoration:none; font-weight:700; }
    .below a:hover{ text-decoration:underline; }
    .alert{ display:none; padding:10px 14px; border-radius:10px; font-size:13px; font-weight:600; margin-bottom:14px; }
    .alert-error{ background:#fee2e2; color:#dc2626; border:1px solid #fca5a5; }
    .spinner{ display:inline-block; width:14px; height:14px; border:2px solid rgba(255,255,255,.4); border-radius:50%; border-top-color:#fff; animation:spin .7s linear infinite; vertical-align:middle; margin-right:6px; }
    @keyframes spin{ to{ transform:rotate(360deg); } }
    @media(max-width:980px){ .left{ padding:24px 16px; } .right{ padding:28px 20px; } }
  </style>
</head>
<body>
  <div class="container">
    <aside class="left">
      <div class="logo">
        <img src="{{ asset('images/logo-light.png') }}" alt="Nganjuk Abirupa">
      </div>
      <h1>Selamat Datang di Nganjuk Abirupa</h1>
      <p>Temukan dan pesan tiket wisata terbaik di Kabupaten Nganjuk dengan mudah. Masuk untuk melanjutkan!</p>
    </aside>

    <main class="right">
      <div class="header">
        <h1>Login Nganjuk Abirupa</h1>
        <p>Masuk ke akunmu untuk melanjutkan perjalanan wisatamu</p>
      </div>

      <div class="card">
        <div class="alert alert-error" id="alertBox"></div>

        <form id="loginForm" autocomplete="off" novalidate>
          {{-- @csrf tidak diperlukan di sini karena kita kirim lewat header X-CSRF-TOKEN --}}
          <input type="hidden" name="role" id="roleField" value="admin">

          <div class="form-group">
            <label for="email">Email</label>
            <div class="input-wrap">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
              <input id="email" name="email" type="email" placeholder="Masukkan email" required>
            </div>
          </div>

          <div class="form-group">
            <label for="password">Kata Sandi</label>
            <div class="input-wrap">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
              <input id="password" name="password" type="password" placeholder="Masukkan kata sandi" required>
              <button type="button" class="eye-btn" id="togglePassword" title="Tampilkan/sembunyikan">
                <svg viewBox="0 0 24 24" fill="currentColor" style="width:18px;height:18px;opacity:.6;">
                  <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                </svg>
              </button>
            </div>
          </div>

          <button class="btn" type="submit" id="btnSubmit">Login</button>

          <div id="googleSection" style="margin-top:20px;text-align:center;display:none;">
            <p style="font-size:13px;color:var(--muted);margin-bottom:10px;">— Atau masuk dengan —</p>
            <div id="g_id_onload"
                 data-client_id="{{ config('services.google.client_id') }}"
                 data-context="signin"
                 data-ux_mode="popup"
                 data-callback="handleCredentialResponse"
                 data-auto_prompt="false">
            </div>
            <div class="g_id_signin"
                 data-type="standard" data-shape="rectangular"
                 data-theme="outline" data-text="continue_with"
                 data-size="large" data-logo_alignment="left">
            </div>
          </div>

          
        </form>
      </div>
    </main>
  </div>

  <script>
    // ── 1. Ambil CSRF token dari meta tag ──────────────────────────────────
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;

    // ── 3. Toggle tampilkan / sembunyikan password ─────────────────────────
    document.getElementById('togglePassword').addEventListener('click', () => {
      const inp = document.getElementById('password');
      inp.type  = inp.type === 'password' ? 'text' : 'password';
    });

    // ── 4. Helper alert ────────────────────────────────────────────────────
    const alertBox = document.getElementById('alertBox');
    const showAlert = (msg) => {
      alertBox.textContent   = msg;
      alertBox.style.display = 'block';
    };
    const hideAlert = () => { alertBox.style.display = 'none'; };

    // ── 5. Submit login ────────────────────────────────────────────────────
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      hideAlert();

      const email    = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value;
      const role     = roleField.value;

      if (!email || !password) {
        showAlert('⚠️ Email dan kata sandi wajib diisi.');
        return;
      }

      const btn = document.getElementById('btnSubmit');
      btn.disabled  = true;
      btn.innerHTML = '<span class="spinner"></span> Memproses...';

      try {
        const res = await fetch('{{ route("admin.login.post") }}', {
          method : 'POST',
          headers: {
            // Tiga header ini WAJIB agar Laravel:
            // (a) menerima request JSON
            // (b) mengembalikan JSON bukan redirect HTML
            // (c) CSRF token valid
            'Content-Type'    : 'application/json',
            'Accept'          : 'application/json',
            'X-CSRF-TOKEN'    : CSRF,
            'X-Requested-With': 'XMLHttpRequest',
          },
          body: JSON.stringify({ email, password, role }),
        });

        // Cek content-type sebelum JSON.parse — cegah error "<!DOCTYPE not valid JSON"
        const ct = res.headers.get('content-type') || '';
        if (!ct.includes('application/json')) {
          const html = await res.text();
          console.error('Response bukan JSON. Status:', res.status);
          console.error('Response body (awal):', html.slice(0, 500));
          showAlert('❌ Server error (' + res.status + '). Lihat console untuk detail.');
          return;
        }

        const data = await res.json();

        if (data.success) {
          btn.innerHTML = '✓ Berhasil! Mengalihkan...';
          window.location.href = data.redirect;
        } else {
          showAlert('❌ ' + (data.message || 'Login gagal.'));
          btn.innerHTML = 'Login';
          btn.disabled  = false;
        }

      } catch (err) {
        console.error('Fetch error:', err);
        showAlert('❌ Gagal menghubungi server. Periksa koneksi.');
        btn.innerHTML = 'Login';
        btn.disabled  = false;
      }
    });

    // ── 6. Google Login ────────────────────────────────────────────────────
    async function handleCredentialResponse(response) {
      try {
        const res = await fetch('{{ url("/auth/google/token") }}', {
          method : 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept'      : 'application/json',
            'X-CSRF-TOKEN': CSRF,
          },
          body: JSON.stringify({ google_token: response.credential }),
        });
        const data = await res.json();
        if (data.success) window.location.href = data.redirect;
        else showAlert('❌ ' + (data.message || 'Login Google gagal.'));
      } catch (err) {
        showAlert('❌ Gagal login via Google.');
      }
    }
  </script>
</body>
</html>
