<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $wisata->nama_wisata }} - Nganjuk Abirupa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --green:      #4CAF50;
            --green-dark: #388E3C;
            --dark:       #2e3338;
            --gray:       #6b7280;
            --nav-bg:     #e1e6ec; 
            --nav-text:   #4b5563; 
            --nav-active: #101827; 
            --bg-body:    #f9fafb; /* DIUBAH: Dari putih murni ke abu-abu sangat muda */
            --bg-gallery: #f4f6f9;
        }
        body { font-family: 'Poppins', sans-serif; background: var(--bg-body); color: var(--dark); overflow-x: hidden; }

        /* ─── ANIMASI MASUK ALA LARAVEL (Fade & Slide Up) ─── */
        @keyframes fadeSlideUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Terapkan animasi ke elemen utama */
        .navbar { animation: fadeIn 0.8s ease-out forwards; opacity: 0; }
        .hero-section { animation: fadeSlideUp 0.8s ease-out 0.2s forwards; opacity: 0; }
        .main-card { animation: fadeSlideUp 0.8s ease-out 0.4s forwards; opacity: 0; }
        .info-container { animation: fadeSlideUp 0.8s ease-out 0.5s forwards; opacity: 0; }
        .rules-container { animation: fadeSlideUp 0.8s ease-out 0.6s forwards; opacity: 0; }
        .cta-container { animation: fadeSlideUp 0.8s ease-out 0.7s forwards; opacity: 0; }
        .gallery-section { animation: fadeIn 1s ease-out 0.8s forwards; opacity: 0; }


        /* ─── NAVBAR ─── */
        .navbar {
            position: absolute; top: 24px; left: 0; right: 0; width: 100%; z-index: 1000;
            display: flex; justify-content: center;
        }
        .navbar-container {
            width: 100%; max-width: 1000px; margin: 0 20px; position: relative;
            background: var(--nav-bg);
            border-radius: 50px; padding: 10px 30px; 
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        
        .nav-logo img { height: 36px; width: auto; display: block; }
        
        /* Menu di tengah persis */
        .navbar-menu-container {
            position: absolute; left: 50%; transform: translateX(-50%);
            display: flex; justify-content: center;
        }
        .nav-links { display: flex; gap: 40px; list-style: none; margin: 0; padding: 0; }
        .nav-links a {
            text-decoration: none; color: var(--nav-text);
            font-weight: 700; font-size: 15px;
            position: relative; transition: color 0.3s;
        }
        .nav-links a:hover,
        .nav-links a.active { color: var(--nav-active); }
        .nav-links a.active::after {
            content: ''; position: absolute; bottom: -10px; left: 0;
            width: 100%; height: 3px; background: #fbbf24; border-radius: 2px;
        }

        /* Dropdown */
        .dropdown-menu { display: none; } 
        .nav-links li { position: relative; }
        .nav-links li:hover .dropdown-menu { 
            display: block; position: absolute; top: 100%; left: 0; 
            background: white; padding: 10px; border-radius: 8px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); min-width: 170px;
            margin-top: 15px;
        }
        .dropdown-menu li { list-style: none; margin-bottom: 5px; }
        .dropdown-menu a { font-weight: 600; font-size: 13px; display: block; padding: 8px 12px; color: var(--dark); border-radius: 6px; }
        .dropdown-menu a:hover { background: #f0fdf4; color: var(--green); }
        .dropdown-menu a::after { display: none; }

        .nav-icons { display: flex; align-items: center; }
        .btn-login {
            padding: 8px 28px; border: 2px solid var(--green);
            border-radius: 50px; color: var(--green);
            font-weight: 600; font-size: 14px; cursor: pointer;
            background: transparent; font-family: 'Poppins', sans-serif;
            transition: all 0.2s; display: inline-block;
        }
        .btn-login:hover { background: var(--green); color: #fff; transform: translateY(-2px); }

        /* ─── HERO SECTION ─── */
        .hero-section {
            max-width: 1200px; margin: 100px auto 0;
            padding: 0 20px;
        }
        .hero-img-wrapper {
            width: 100%; height: 480px;
            border-radius: 24px; overflow: hidden;
            position: relative;
        }
        .hero-img-wrapper img {
            width: 100%; height: 100%; object-fit: cover; object-position: center;
        }

        /* ─── MAIN INFO CARD (Overlap) ─── */
        .main-card {
            background: #ffffff; /* Ubah ke putih mutlak agar terpisah dari body */
            max-width: 900px; margin: -100px auto 40px;
            border-radius: 24px; padding: 40px 50px;
            position: relative; z-index: 10;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            text-align: left;
        }
        .main-card h1 {
            font-size: 32px; font-weight: 800; color: var(--dark);
            text-transform: uppercase; margin-bottom: 8px; letter-spacing: -0.5px;
        }
        .location {
            display: flex; align-items: center; gap: 8px;
            color: var(--gray); font-size: 15px; font-weight: 600; margin-bottom: 24px;
        }
        .location svg { width: 18px; height: 18px; color: var(--dark); }
        .description {
            font-size: 15px; line-height: 1.8; color: #555; font-weight: 500;
        }

        /* ─── INFO BOXES ─── */
        .info-container {
            max-width: 900px; margin: 0 auto 40px;
            display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;
            padding: 0 20px;
        }
        .info-box {
            background: #ffffff; /* Ubah ke putih mutlak agar menonjol */
            border: 1.5px solid #eaeaea;
            border-radius: 16px; padding: 20px 10px;
            width: calc(25% - 15px); min-width: 140px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            transition: transform 0.3s ease;
        }
        .info-box:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.06); }
        .info-box svg { width: 28px; height: 28px; color: var(--dark); margin-bottom: 10px; }
        .info-label { font-size: 11px; font-weight: 600; color: var(--gray); text-transform: uppercase; margin-bottom: 4px; }
        .info-value { font-size: 14px; font-weight: 800; color: var(--dark); }

        /* ─── RULES (Pills) ─── */
        .rules-container {
            max-width: 900px; margin: 0 auto 30px;
            display: grid; grid-template-columns: 1fr 1fr; gap: 16px;
            padding: 0 20px;
        }
        .rule-pill {
            display: flex; align-items: center; gap: 12px;
            padding: 14px 20px; border-radius: 50px;
            font-size: 13px; font-weight: 600; color: #fff;
        }
        .rule-pill svg { width: 18px; height: 18px; flex-shrink: 0; }
        .rule-pill.dark { background: var(--dark); }
        .rule-pill.green { background: var(--green); }

        /* ─── CTA BUTTON ─── */
        .cta-container {
            max-width: 900px; margin: 0 auto 60px; padding: 0 20px;
        }
        .cta-btn {
            display: block; width: 100%; padding: 18px;
            background: var(--green); color: #fff;
            text-align: center; font-size: 15px; font-weight: 700;
            border-radius: 50px; text-decoration: none;
            box-shadow: 0 8px 20px rgba(76,175,80,0.3);
            transition: 0.3s;
        }
        .cta-btn:hover { background: var(--green-dark); transform: translateY(-2px); box-shadow: 0 10px 25px rgba(76,175,80,0.4); }

        /* ─── GALLERY SECTION (UPDATED) ─── */
        .gallery-section {
            background: var(--bg-gallery);
            padding: 60px 20px;
            border-top: 1px solid #e5e7eb;
        }
        .gallery-track {
            max-width: 1200px; margin: 0 auto;
            display: flex; gap: 24px; justify-content: center; flex-wrap: wrap; 
            align-items: flex-start; 
        }
        .gallery-card {
            background: #fff; padding: 10px; border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.06);
            width: 100%; max-width: 350px; flex: 1 1 300px; 
            transition: transform 0.3s;
        }
        .gallery-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        
        .gallery-card img {
            width: 100%; 
            height: auto; 
            border-radius: 10px; 
            display: block;
        }

        /* ─── FOOTER ─── */
        footer {
            background: var(--green); color: white;
            text-align: center; padding: 20px; font-size: 13px; font-weight: 500;
        }

        /* ─── LOGIN MODAL ─── */
        .modal-overlay {
            display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5); z-index: 2000;
            justify-content: center; align-items: center;
            backdrop-filter: blur(5px);
        }
        .modal-overlay.active { display: flex; }
        .modal {
            background: white; border-radius: 20px; padding: 40px;
            width: 90%; max-width: 420px; position: relative;
            animation: modalSlide 0.3s ease;
        }
        @keyframes modalSlide {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .modal-close {
            position: absolute; top: 15px; right: 20px; font-size: 24px;
            cursor: pointer; color: var(--gray); background: none; border: none;
            transition: color 0.3s;
        }
        .modal-close:hover { color: var(--dark); }
        .modal h2 { font-size: 24px; font-weight: 700; color: var(--dark); margin-bottom: 8px; }
        .modal .subtitle { color: var(--gray); font-size: 14px; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label {
            display: block; font-size: 13px; font-weight: 600; color: var(--dark); margin-bottom: 8px;
        }
        .form-group input {
            width: 100%; padding: 12px 16px; border: 2px solid #e0e0e0;
            border-radius: 10px; font-size: 14px; font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s; box-sizing: border-box;
        }
        .form-group input:focus { outline: none; border-color: var(--green); }
        .btn-submit {
            width: 100%; padding: 14px;
            background: linear-gradient(135deg, var(--green), #26A69A);
            color: white; border: none; border-radius: 10px;
            font-size: 16px; font-weight: 600; cursor: pointer;
            font-family: 'Poppins', sans-serif; transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn-submit:hover {
            transform: translateY(-2px); box-shadow: 0 5px 20px rgba(76,175,80,0.4);
        }
        .modal-footer-text { text-align: center; margin-top: 20px; font-size: 13px; color: var(--gray); }
        .modal-footer-text a { color: var(--green); text-decoration: none; font-weight: 600; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            .navbar-menu-container { display: none; }
            .hero-img-wrapper { height: 350px; }
            .main-card { margin: -60px 20px 30px; padding: 30px 24px; width: auto; }
            .main-card h1 { font-size: 24px; }
            .info-box { width: calc(50% - 10px); }
            .rules-container { grid-template-columns: 1fr; }
            .gallery-card { width: 100%; max-width: 100%; }
        }
    </style>
</head>
<body>

    <!-- ════ NAVBAR ════ -->
    <nav class="navbar">
        <div class="navbar-container">
            <!-- Logo Kiri -->
            <a href="{{ route('beranda') }}" class="nav-logo">
                <img src="{{ asset('images/logogedi.png') }}" alt="Nganjuk Abirupa">
            </a>
            
            <!-- Menu Tengah Absolut -->
            <div class="navbar-menu-container">
                <ul class="nav-links">
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle active">Informasi Tiket ▾</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('informasi.harga') }}">Harga Tiket</a></li>
                            <li><a href="{{ route('informasi.cara-pesan') }}">Cara Pesan Tiket</a></li>
                            <li><a href="{{ route('informasi.pesan') }}">Pesan Tiket Wisata</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('riwayat') }}">Riwayat</a></li>
                </ul>
            </div>

            <!-- Login Kanan -->
            <div class="nav-icons">
                <button class="btn-login" onclick="openModal()">Login</button>
            </div>
        </div>
    </nav>

    <!-- ════ HERO SECTION ════ -->
    <div class="hero-section">
        <div class="hero-img-wrapper">
            <img src="{{ asset('images/destinasi/' . $wisata->gambar) }}"
                 alt="{{ $wisata->nama_wisata }}"
                 onerror="this.src='{{ asset('images/fotoberanda.png') }}'">
        </div>
    </div>

    <!-- ════ MAIN INFO CARD ════ -->
    <div class="main-card">
        <h1>{{ strtoupper($wisata->nama_wisata) }}</h1>
        <div class="location">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
            </svg>
            {{ $wisata->lokasi }}
        </div>
        <p class="description">{{ $wisata->deskripsi }}</p>
    </div>

    <!-- ════ INFO BOXES ════ -->
    <div class="info-container">
        <div class="info-box">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <div class="info-label">Jam Buka</div>
            <div class="info-value">{{ $wisata->jam_buka ?? '08:00:00' }}</div>
        </div>
        <div class="info-box">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <div class="info-label">Jam Tutup</div>
            <div class="info-value">{{ $wisata->jam_tutup ?? '16:00:00' }}</div>
        </div>
        <div class="info-box">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
            </svg>
            <div class="info-label">Tiket Dewasa</div>
            <div class="info-value">Rp.{{ number_format($wisata->tiket_dewasa, 0, ',', '.') }}</div>
        </div>
        <div class="info-box">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <div class="info-label">Tiket Anak</div>
            <div class="info-value">Rp.{{ number_format($wisata->tiket_anak, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- ════ RULES ════ -->
    <div class="rules-container">
        <div class="rule-pill dark">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>
            Harga tiket bisa berubah sewaktu-waktu
        </div>
        <div class="rule-pill green">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
            Menjaga kebersihan tempat wisata
        </div>
        <div class="rule-pill green">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
            Setiap pengunjung wajib membeli tiket
        </div>
        <div class="rule-pill dark">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>
            Mengikuti himbauan petunjuk petugas
        </div>
    </div>

    <!-- ════ CTA BUTTON ════ -->
    <div class="cta-container">
        <a href="{{ route('informasi.pesan') }}?id={{ $wisata->id_wisata }}" class="cta-btn">
            Pembelian Tiket Online Pembayaran via Qris
        </a>
    </div>

    <!-- ════ GALLERY SECTION ════ -->
    <div class="gallery-section">
        @if(isset($galeri) && $galeri->count() > 0)
        <div class="gallery-track">
            <!-- Hanya Menampilkan Gambar Utuh Tanpa Teks -->
            @foreach($galeri as $item)
            <div class="gallery-card">
                <img src="{{ asset('images/destinasi/' . $item->gambar_poster) }}"
                     alt="Event {{ $wisata->nama_wisata }}"
                     onerror="this.src='{{ asset('images/fotoberanda.png') }}'">
            </div>
            @endforeach
        </div>
        @else
        <div style="text-align: center; color: var(--gray);"> Belum ada galeri event untuk destinasi ini.</div>
        @endif
    </div>

    <!-- ════ FOOTER ════ -->
    <footer>
        © 2025 Nganjuk Abirupa - Disporabudar Nganjuk. All rights reserved.
    </footer>

    <!-- ════ LOGIN MODAL ════ -->
    <div class="modal-overlay" id="loginModal">
        <div class="modal">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <h2>Masuk ke Akun</h2>
            <p class="subtitle">Silakan login untuk mengakses fitur lengkap</p>
            <form id="formLoginDetail" action="#">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="contoh@email.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
                </div>
                <button type="submit" name="login" class="btn-submit">Masuk</button>
            </form>
            <div class="modal-footer-text">
                Belum punya akun? <a href="#">Daftar Sekarang</a>
            </div>
        </div>
    </div>

    <!-- ════ SCRIPTS ════ -->
    <script>
        // Fungsi Modal Login
        function openModal() {
            document.getElementById('loginModal').classList.add('active');
            document.body.style.overflow = 'hidden'; 
        }

        function closeModal() {
            document.getElementById('loginModal').classList.remove('active');
            document.body.style.overflow = 'auto'; 
        }

        document.getElementById('loginModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('loginModal')) closeModal();
        });

        document.addEventListener('keydown', (e) => { 
            if (e.key === 'Escape') closeModal(); 
        });

        // Proses Form Login via Fetch API
        document.getElementById('formLoginDetail').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const email    = this.querySelector('input[type="email"], input[name="email"]').value.trim();
            const password = this.querySelector('input[type="password"], input[name="password"]').value;
            const CSRF     = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';

            const btn = this.querySelector('button[type="submit"], input[type="submit"]');
            if (btn) { btn.disabled = true; btn.textContent = 'Memproses...'; }

            try {
                const res  = await fetch('{{ route("admin.login.post") }}', {
                    method : 'POST',
                    headers: {
                        'Content-Type'    : 'application/json',
                        'Accept'          : 'application/json',
                        'X-CSRF-TOKEN'    : CSRF,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({ email, password }),
                });
                const data = await res.json();
                if (data.success) {
                    window.location.replace(data.redirect);
                } else {
                    alert('❌ ' + (data.message || 'Login gagal.'));
                    if (btn) { btn.disabled = false; btn.textContent = 'Masuk'; }
                }
            } catch(err) {
                alert('❌ Gagal menghubungi server.');
                if (btn) { btn.disabled = false; btn.textContent = 'Masuk'; }
            }
        });
    </script>
</body>
</html>