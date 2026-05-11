<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harga Tiket - Nganjuk Abirupa</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        /* ============ BASE & VARIABLES ============ */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-green: #4CAF50;
            --accent-blue: #26A69A;
            --bg-light: linear-gradient(160deg, #f0fdf4 0%, #e0f2fe 100%);
            --text-dark: #333;
            --text-gray: #666;
            --shadow: 0 4px 20px rgba(0,0,0,0.08);
            --shadow-hover: 0 8px 30px rgba(0,0,0,0.15);
            --nav-bg: #e1e6ec;
            --nav-text: #4b5563;
            --nav-active: #101827;
        }
        body { font-family: 'Poppins', sans-serif; color: var(--text-dark); background: var(--bg-light); background-attachment: fixed; overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }

        /* ─── NAVBAR (SAMA PERSIS DENGAN BERANDA.BLADE.PHP) ─── */
        .navbar {
            position: fixed; top: 24px; left: 0; right: 0; width: 100%; z-index: 1000;
            display: flex; justify-content: center; transition: all 0.3s ease;
        }
        .navbar-container {
            width: 90%; max-width: 1000px; position: relative; 
            background: var(--nav-bg);
            border-radius: 50px; padding: 10px 24px; 
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .nav-brand { display: flex; align-items: center; gap: 12px; }
        .nav-logo img { height: 32px; width: auto; display: block; }
        
        .navbar-menu-container {
            position: absolute; left: 50%; transform: translateX(-50%);
            display: flex; justify-content: center;
        }
        .nav-links { display: flex; gap: 40px; list-style: none; margin: 0; padding: 0; align-items: center; }
        
        /* PERBAIKAN: Tambahan padding-bottom untuk mencegah area klik terputus */
        .nav-links li { position: relative; padding-bottom: 10px; }
        
        .nav-links a {
            text-decoration: none; color: var(--nav-text);
            font-weight: 700; font-size: 14px;
            position: relative; transition: color 0.3s;
        }
        .nav-links a:hover,
        .nav-links a.active { color: var(--nav-active); }
        

        /* ============ DROPDOWN MENU ============ */
        .dropdown-menu { display: none; }
        
        /* Desktop Dropdown - Hover */
        .nav-links li:hover .dropdown-menu {
            display: block;
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            min-width: 170px;
            margin-top: 0; /* PERBAIKAN: Ubah jadi 0 agar tidak ada celah kosong */
            list-style: none;
        }
        
        .dropdown-menu li { margin-bottom: 5px; padding-bottom: 0; }
        .dropdown-menu a {
            font-weight: 600;
            font-size: 13px;
            display: block;
            padding: 8px 12px;
            color: var(--text-dark);
            border-radius: 6px;
        }
        .dropdown-menu a:hover { background: #f0fdf4; color: var(--primary-green); }
        .dropdown-menu a::after { display: none; }

        /* ============ NAV ICONS ============ */
        .nav-icons { display: flex; align-items: center; }

        .btn-login {
            padding: 8px 24px; border: 2px solid var(--primary-green);
            border-radius: 50px; color: var(--primary-green);
            font-weight: 600; font-size: 13px; cursor: pointer;
            background: transparent; transition: all 0.2s;
            display: inline-block;
        }
        .btn-login:hover { background: var(--primary-green); color: #fff; transform: translateY(-2px); }

        /* ============ HAMBURGER ============ */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 4px;
            cursor: pointer;
            margin-left: 15px;
        }
        .hamburger span {
            width: 22px;
            height: 2.5px;
            background: var(--text-dark);
            border-radius: 2px;
            transition: 0.3s;
        }

        /* ============ MAIN CONTENT ============ */
        .main-wrapper { margin-top: 130px; padding: 40px 20px 80px; }
        .section-title { text-align: center; margin-bottom: 50px; }
        .section-title h1 { font-size: 32px; font-weight: 800; color: var(--text-dark); position: relative; display: inline-block; }
        .section-title h1::after { content: ''; position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 60px; height: 4px; background: linear-gradient(90deg, var(--primary-green), var(--accent-blue)); border-radius: 2px; }
        .section-subtitle { text-align: center; color: var(--text-gray); margin-top: 15px; font-size: 15px; max-width: 600px; margin-left: auto; margin-right: auto; }

        /* ============ PRICE CARDS ============ */
        .price-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px; max-width: 1150px; margin: 0 auto; }
        .price-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: var(--shadow); transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.05); }
        .price-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-hover); }
        .price-header { background: linear-gradient(135deg, var(--primary-green), var(--accent-blue)); padding: 22px; color: white; text-align: center; position: relative; overflow: hidden; }
        .price-header::before { content: ''; position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(255,255,255,0.1); border-radius: 50%; }
        .price-header h3 { font-size: 20px; font-weight: 700; margin-bottom: 6px; position: relative; z-index: 1; }
        .price-badge { background: rgba(255,255,255,0.25); padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 500; display: inline-block; position: relative; z-index: 1; }
        .price-body { padding: 25px; }
        .price-row { display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px dashed #eee; }
        .price-row:last-of-type { border-bottom: none; }
        .price-label { color: var(--text-gray); font-size: 14px; font-weight: 500; }
        .price-value { font-weight: 600; color: var(--text-dark); font-size: 15px; }
        .price-total { margin-top: 15px; padding-top: 15px; border-top: 2px solid var(--primary-green); display: flex; justify-content: space-between; align-items: center; background: #f9fdf9; padding: 12px 15px; border-radius: 10px; }
        .price-total .label { font-size: 13px; color: var(--text-gray); font-weight: 500; }
        .price-total .amount { font-weight: 800; color: var(--primary-green); font-size: 18px; }

        /* ============ FOOTER ============ */
        .footer { background: linear-gradient(135deg, #4CAF50 0%, #26A69A 100%); color: white; padding: 40px 0 20px; margin-top: 60px; }
        .footer-content { max-width: 1150px; margin: 0 auto; padding: 0 20px; text-align: center; }
        .footer-logo { font-size: 20px; font-weight: 700; margin-bottom: 10px; }
        .footer-text { font-size: 13px; opacity: 0.9; margin-bottom: 20px; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.2); padding-top: 15px; font-size: 12px; opacity: 0.8; }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 768px) {
            .navbar { top: 12px; padding: 0 12px; }
            .navbar-container { padding: 10px 16px; }

            .navbar-menu-container {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                width: 100%;
                transform: none;
                background: white;
                border-radius: 16px;
                padding: 20px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                flex-direction: column;
                margin-top: 10px;
            }
            .navbar-menu-container.active { display: flex; }

            .nav-links {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
            .nav-links li { padding-bottom: 0; }

            /* Dropdown di mobile: relative agar tidak overlap */
            .nav-links li:hover .dropdown-menu {
                position: relative;
                box-shadow: none;
                margin-top: 10px;
                border: 1px solid #eaeaea;
            }

            /* Matikan hover dropdown di mobile, gunakan class open via JS */
            .nav-links li .dropdown-menu { display: none !important; }
            .nav-links li.open .dropdown-menu {
                display: block !important;
                position: relative;
                box-shadow: none;
                margin-top: 10px;
                border: 1px solid #eaeaea;
                left: auto;
                min-width: unset;
                padding: 8px 0;
            }

            .hamburger { display: flex; }
            .price-grid { grid-template-columns: 1fr; }
            .section-title h1 { font-size: 26px; }
            .main-wrapper { margin-top: 100px; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR (SAMA PERSIS DENGAN BERANDA.BLADE.PHP) -->
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <div class="nav-brand">
                <a href="{{ route('beranda') }}" class="nav-logo">
                    <img src="{{ asset('images/logogedi.png') }}" alt="Nganjuk Abirupa">
                </a>
            </div>

            <div class="navbar-menu-container" id="mobileMenu">
                <ul class="nav-links">
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" id="dropdownToggle">Informasi Tiket ▾</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('informasi.harga') }}">Harga Tiket</a></li>
                            <li><a href="{{ route('informasi.cara-pesan') }}">Cara Pesan Tiket</a></li>
                            <li><a href="{{ route('informasi.pesan') }}">Pesan Tiket Wisata</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('riwayat') }}">Riwayat</a></li>
                </ul>
            </div>

            <div class="nav-icons">
                <a href="{{ route('beranda') }}" class="btn-login">Login</a>
                <div class="hamburger" onclick="toggleMobileMenu()">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>
    </nav>

<!-- MAIN CONTENT -->
    <div class="main-wrapper">
        <div class="section-title" data-aos="fade-down">
            <h1>DAFTAR HARGA TIKET</h1>
            <p class="section-subtitle">Informasi lengkap harga tiket masuk wisata Nganjuk. Harga dapat berubah sewaktu-waktu sesuai kebijakan pengelola.</p>
        </div>

        <!-- HANYA ADA SATU CLASS PRICE-GRID -->
        <div class="price-grid">
            
            <!-- MULAI LOOPING DI SINI -->
            @foreach ($wisatas as $index => $wisata)
            <div class="price-card" data-aos="fade-up" data-aos-delay="{{ ($index % 3 + 1) * 100 }}">
                <div class="price-header">
                    <h3>{{ $wisata->nama_wisata }}</h3>
                    <span class="price-badge">Wisata Nganjuk</span>
                </div>
                <div class="price-body">
                    <div class="price-row">
                        <span class="price-label">Tiket Dewasa</span>
                        <span class="price-value">Rp {{ number_format($wisata->tiket_dewasa, 0, ',', '.') }}</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Tiket Anak-anak</span>
                        <span class="price-value">Rp {{ number_format($wisata->tiket_anak, 0, ',', '.') }}</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Asuransi Perjalanan</span>
                        <span class="price-value">Rp {{ number_format($wisata->biaya_asuransi, 0, ',', '.') }}</span>
                    </div>
                    <div class="price-total">
                        <span class="label">🕒 Jam Buka</span>
                        <span class="amount">08:00 - 17:00</span>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- AKHIR LOOPING -->

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">Nganjuk Abirupa</div>
            <p class="footer-text">Platform resmi pemesanan tiket wisata Kabupaten Nganjuk. Nikmati kemudahan digital untuk menjelajahi keindahan Nganjuk.</p>
            <div class="footer-bottom">© 2026 Nganjuk Abirupa. All rights reserved.</div>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // ===== INIT AOS ANIMATION =====
        AOS.init({ duration: 800, easing: 'ease-out-cubic', once: true, offset: 50 });

        // ===== NAVBAR SCROLL EFFECT =====
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.style.boxShadow = '0 10px 40px rgba(0,0,0,0.1)';
            } else {
                navbar.style.boxShadow = '0 10px 30px rgba(0,0,0,0.06)';
            }
        });

        // ===== HAMBURGER & MOBILE MENU =====
        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('active');
            // Tutup dropdown saat menu ditutup
            if (!document.getElementById('mobileMenu').classList.contains('active')) {
                const dropdownLi = document.getElementById('dropdownToggle')?.parentElement;
                if (dropdownLi) dropdownLi.classList.remove('open');
            }
        }

        // Toggle dropdown di mobile saat di-klik
        const dropdownToggle = document.getElementById('dropdownToggle');
        if (dropdownToggle) {
            dropdownToggle.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.parentElement.classList.toggle('open');
                }
            });
        }

        // Tutup menu saat link diklik (kecuali dropdown toggle)
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', (e) => {
                // Cegah aksi default jika klik menu "Informasi Tiket" agar dropdown tidak hilang
                if (link.id === 'dropdownToggle') {
                    e.preventDefault();
                    return;
                }
                
                // Tutup menu jika klik selain tombol dropdown
                const mobileMenu = document.getElementById('mobileMenu');
                if (mobileMenu) mobileMenu.classList.remove('active');
                const dropdownLi = document.getElementById('dropdownToggle')?.parentElement;
                if (dropdownLi) dropdownLi.classList.remove('open');
            });
        });

        // ===== ACTIVE NAV LINK =====
        const sections = document.querySelectorAll('section[id], .main-wrapper');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                if (scrollY >= sectionTop) current = section.getAttribute('id') || '';
            });
            document.querySelectorAll('.nav-links a').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes(current) || link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>