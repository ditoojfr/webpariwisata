<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Pesan Tiket - Nganjuk Abirupa</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        /* ============ BASE & VARIABLES ============ */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-green: #4CAF50;
            --dark-green: #2E7D32;
            --light-green: #81C784;
            --bg-light: linear-gradient(160deg, #f0fdf4 0%, #e0f2fe 100%);
            --text-dark: #333;
            --text-gray: #4b5563;
            --nav-bg: #e1e6ec;
            --nav-text: #4b5563;
            --nav-active: #101827;
            --nav-underline: #fbbf24;
            --dark: #2e3338;
            --green: #4CAF50;
        }
        
        body { 
            font-family: 'Poppins', sans-serif; 
            color: var(--text-dark); 
            background: var(--bg-light);
background-attachment: fixed;
            overflow-x: hidden;
        }
        a { text-decoration: none; color: inherit; }

        /* ─── NAVBAR (SAMA PERSIS DENGAN BERANDA.BLADE.PHP) ─── */
        .navbar {
            position: fixed; top: 24px; left: 0; right: 0; width: 100%; z-index: 1000;
            display: flex; justify-content: center; transition: all 0.3s ease;
            animation: fadeIn 0.8s ease-out forwards;
        }
        @keyframes fadeIn { 0% { opacity: 0; } 100% { opacity: 1; } }

        .navbar-container {
            width: 90%; max-width: 1000px; position: relative; 
            background: var(--nav-bg);
            border-radius: 50px; padding: 10px 24px; 
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .nav-brand { display: flex; align-items: center; gap: 12px; }
        .btn-back {
            display: flex; align-items: center; justify-content: center;
            width: 32px; height: 32px; border-radius: 50%;
            background: #fff; color: var(--dark);
            text-decoration: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.2s;
        }
        .btn-back:hover { background: var(--green); color: #fff; }
        .btn-back svg { width: 18px; height: 18px; }
        .nav-logo img { height: 32px; width: auto; display: block; }
        
        .navbar-menu-container {
            position: absolute; left: 50%; transform: translateX(-50%);
            display: flex; justify-content: center;
        }
        .nav-links { display: flex; gap: 40px; list-style: none; margin: 0; padding: 0; align-items: center; }
        
        /* PERBAIKAN: Tambahan padding-bottom untuk area klik yang lebih baik */
        .nav-links li { position: relative; padding-bottom: 10px; }
        
        .nav-links a {
            text-decoration: none; color: var(--nav-text);
            font-weight: 700; font-size: 14px;
            position: relative; transition: color 0.3s;
            cursor: pointer;
        }
        .nav-links a:hover,
        .nav-links a.active { color: var(--nav-active); }
        .nav-links a.active::after {
            content: ''; position: absolute; bottom: -8px; left: 0;
            width: 100%; height: 3px; background: var(--nav-underline); border-radius: 2px;
        }
        
        /* Hilangkan garis kuning untuk dropdown toggle */
        .nav-links .dropdown > a.active::after {
            display: none !important;
        }

        /* ============ DROPDOWN MENU ============ */
        .dropdown-menu { 
            display: none; 
            position: absolute; 
            top: 100%; 
            left: 0; 
            background: white; 
            padding: 10px; 
            border-radius: 8px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
            min-width: 170px;
            margin-top: 0;
            list-style: none;
            z-index: 100;
        }
        
        /* Desktop: Hover to show */
        @media (min-width: 769px) {
            .nav-links li.dropdown:hover .dropdown-menu {
                display: block;
            }
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
        .nav-icons { 
            display: flex; 
            align-items: center; 
            gap: 12px;
            position: relative;
            z-index: 1001;
        }
        .btn-login {
            padding: 8px 24px; border: 2px solid var(--primary-green);
            border-radius: 50px; color: var(--primary-green);
            font-weight: 600; font-size: 13px; cursor: pointer;
            background: transparent; transition: all 0.2s;
            display: inline-block;
            white-space: nowrap;
        }
        .btn-login:hover { background: var(--primary-green); color: #fff; transform: translateY(-2px); }

        /* ============ HAMBURGER ============ */
        .hamburger { 
            display: none; 
            flex-direction: column; 
            justify-content: center;
            align-items: center;
            gap: 5px; 
            cursor: pointer; 
            padding: 8px;
            background: transparent;
            border: none;
            z-index: 1002;
            min-width: 40px;
            min-height: 40px;
        }
        .hamburger span { 
            display: block;
            width: 25px; 
            height: 3px; 
            background: var(--dark) !important; 
            border-radius: 3px;
            transition: all 0.3s;
            margin: 0;
        }

        /* ─── PAGE HEADER & CONTENT ─── */
        @keyframes headerSlideDown {
            from { opacity: 0; transform: translateY(-60px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .page-header {
            margin-top: 0; 
            text-align: center;
            padding: 140px 20px 80px 20px; 
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            color: white;
            border-radius: 0 0 50px 50px;
            position: relative; 
            animation: headerSlideDown 0.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
        }

        .page-header h1 { font-size: 36px; font-weight: 800; margin-bottom: 10px; }
        .page-header p { font-size: 16px; opacity: 0.9; max-width: 600px; margin: 0 auto; }

        .steps-container {
            max-width: 1000px;
            margin: -50px auto 60px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .step-card {
            background: white; border-radius: 20px; padding: 40px; margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); display: flex; gap: 30px;
            align-items: flex-start; transition: all 0.4s ease; opacity: 0;
            transform: translateY(30px); border-left: 5px solid var(--primary-green);
            position: relative; z-index: 2;
        }

        .step-card.visible { opacity: 1; transform: translateY(0); }
        .step-number {
            width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-green), var(--light-green));
            color: white; border-radius: 50%; display: flex; align-items: center;
            justify-content: center; font-size: 32px; font-weight: 800; flex-shrink: 0;
        }

        .steps-container::before {
            content: ''; position: absolute; top: 40px; bottom: 80px; left: 60px;
            width: 0; border-left: 2px dashed var(--light-green); z-index: 0;
        }

        .step-content h3 { font-size: 24px; font-weight: 700; color: var(--text-dark); margin-bottom: 12px; }
        .step-content p { font-size: 15px; color: var(--text-gray); line-height: 1.8; margin-bottom: 15px; }

        .step-features { display: flex; gap: 15px; flex-wrap: wrap; }
        .feature-tag {
            background: #f0fdf4; color: var(--dark-green); padding: 8px 16px;
            border-radius: 20px; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 6px;
        }
        .feature-tag svg { width: 16px; height: 16px; color: var(--primary-green); }

        .info-box {
            max-width: 1000px; margin: 40px auto; padding: 30px;
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border-radius: 20px; border-left: 5px solid var(--primary-green);
        }

        .info-box h4 { font-size: 22px; font-weight: 700; color: var(--dark-green); margin-bottom: 15px; display: flex; align-items: center; gap: 10px; }
        .info-box li { padding: 10px 0; padding-left: 30px; position: relative; color: var(--text-gray); font-size: 14px; list-style: none; }
        .info-box li::before { content: '✓'; position: absolute; left: 0; color: var(--primary-green); font-weight: bold; }

        .cta-section { text-align: center; padding: 60px 20px; background: linear-gradient(135deg, var(--primary-green), var(--dark-green)); color: white; margin-top: 60px; }
        .btn-cta { display: inline-block; background: white; color: var(--primary-green); padding: 15px 40px; border-radius: 30px; font-weight: 700; text-decoration: none; transition: 0.3s; }

        .footer { background: var(--primary-green); color: white; text-align: center; padding: 20px; font-size: 13px; }

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

            /* Mobile Dropdown */
            .nav-links li:hover .dropdown-menu { display: none; }
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
                background: #f8fafc;
            }

            /* Pastikan hamburger terlihat di mobile */
            .hamburger { 
                display: flex !important;
                order: 3;
                margin-left: auto;
            }
            
            .nav-icons { gap: 10px; }
            
            .page-header { padding: 120px 20px 60px; }
            .page-header h1 { font-size: 28px; }
            .step-card { flex-direction: column; padding: 30px 20px; }
            .steps-container::before { left: 50px; top: 30px; }
            .step-number { width: 60px; height: 60px; font-size: 24px; }
            .btn-login { padding: 8px 16px; font-size: 12px; }
        }
    </style>
</head>
<body>

    <!-- ════ NAVBAR (SAMA PERSIS DENGAN BERANDA.BLADE.PHP) ════ -->
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <div class="nav-brand">
                <a href="javascript:history.back()" class="btn-back" title="Kembali">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <a href="{{ route('beranda') }}" class="nav-logo">
                    <img src="{{ asset('images/logogedi.png') }}" alt="Nganjuk Abirupa">
                </a>
            </div>
            
            <div class="navbar-menu-container" id="mobileMenu">
                <ul class="nav-links">
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="dropdown" id="dropdownParent">
                        <a href="javascript:void(0)" class="dropdown-toggle" id="dropdownToggle">Informasi Tiket ▾</a>
                        <ul class="dropdown-menu" id="dropdownMenu">
                            <li><a href="{{ route('informasi.harga') }}">Harga Tiket</a></li>
                            <li><a href="{{ route('informasi.cara-pesan') }}" class="active">Cara Pesan Tiket</a></li>
                            <li><a href="{{ route('informasi.pesan') }}">Pesan Tiket Wisata</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('riwayat') }}">Riwayat</a></li>
                </ul>
            </div>

            <div class="nav-icons">
                <!-- ✅ PERBAIKAN: Login button sekarang mengarah ke beranda -->
                <a href="{{ route('beranda') }}" class="btn-login">Login</a>
                <button class="hamburger" id="hamburger" onclick="toggleMobileMenu()" aria-label="Toggle Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1>🎫 Cara Pesan Tiket Wisata</h1>
        <p>Panduan lengkap pemesanan tiket wisata Nganjuk Abirupa dalam 4 langkah mudah</p>
    </div>

    <!-- STEPS CONTAINER -->
    <div class="steps-container">
        <!-- Step 1 -->
        <div class="step-card">
            <div class="step-number">1</div>
            <div class="step-content">
                <h3>Pilih Destinasi Wisata</h3>
                <p>Tentukan destinasi wisata yang ingin Anda kunjungi di Kabupaten Nganjuk. Tersedia berbagai pilihan wisata alam, budaya, dan edukasi yang menarik.</p>
                <div class="step-features">
                    <span class="feature-tag">Air Terjun Sedudo</span>
                    <span class="feature-tag">Goa Margo Tresno</span>
                    <span class="feature-tag">Roro Kuning</span>
                </div>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="step-card">
            <div class="step-number">2</div>
            <div class="step-content">
                <h3>Isi Form Pemesanan</h3>
                <p>Lengkapi data diri Anda dan tentukan jumlah pengunjung (dewasa dan anak-anak). Pilih tanggal kunjungan yang diinginkan sesuai ketersediaan.</p>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="step-card">
            <div class="step-number">3</div>
            <div class="step-content">
                <h3>Lakukan Pembayaran</h3>
                <p>Selesaikan pembayaran menggunakan QRIS atau metode pembayaran digital lainnya. Sistem akan menampilkan QR code untuk proses pembayaran yang cepat dan aman.</p>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="step-card">
            <div class="step-number">4</div>
            <div class="step-content">
                <h3>Dapatkan E-Ticket</h3>
                <p>Setelah pembayaran berhasil, e-ticket akan otomatis terkirim ke email Anda. Tunjukkan e-ticket kepada petugas di lokasi wisata.</p>
            </div>
        </div>
    </div>

    <!-- INFO BOX -->
    <div class="info-box" data-aos="fade-up">
        <h4>ℹ️ Informasi Penting:</h4>
        <ul>
            <li>Pembayaran harus diselesaikan dalam waktu 12 menit setelah pemesanan</li>
            <li>E-ticket hanya berlaku untuk tanggal yang telah dipilih</li>
            <li>Tiket tidak dapat digunakan setelah tanggal kunjungan</li>
        </ul>
    </div>

    <!-- CTA SECTION -->
    <div class="cta-section">
        <h2>Siap untuk Berwisata?</h2>
        <p>Jelajahi keindahan wisata Nganjuk sekarang juga!</p>
        <a href="{{ route('informasi.pesan') }}" class="btn-cta">🎫 Pesan Tiket Sekarang</a>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; 2026 Nganjuk Abirupa - Disporabudpar Nganjuk. All rights reserved.</p>
    </footer>

    <!-- ════ SCROLL TO TOP ════ -->
    <button class="scroll-top" id="scrollTop" onclick="scrollToTop()">↑</button>

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
            const menu = document.getElementById('mobileMenu');
            const hamburger = document.getElementById('hamburger');
            
            menu.classList.toggle('active');
            hamburger.classList.toggle('active');
            
            // Reset dropdown saat menu ditutup
            if (!menu.classList.contains('active')) {
                const dropdownLi = document.getElementById('dropdownToggle')?.parentElement;
                if (dropdownLi) dropdownLi.classList.remove('open');
            }
        }

        // Toggle Dropdown via Klik (Mobile Only)
        const dropdownToggle = document.getElementById('dropdownToggle');
        const dropdownParent = document.getElementById('dropdownParent');
        
        if (dropdownToggle && dropdownParent) {
            dropdownToggle.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropdownParent.classList.toggle('open');
                }
            });
        }

        // Tutup dropdown saat klik link submenu
        document.querySelectorAll('.dropdown-menu a').forEach(link => {
            link.addEventListener('click', () => {
                const mobileMenu = document.getElementById('mobileMenu');
                const hamburger = document.getElementById('hamburger');
                if (mobileMenu) mobileMenu.classList.remove('active');
                if (hamburger) hamburger.classList.remove('active');
                if (dropdownParent) dropdownParent.classList.remove('open');
            });
        });

        // Tutup dropdown jika klik di luar area (mobile only)
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768 && dropdownParent && dropdownToggle) {
                if (!dropdownParent.contains(e.target) && !dropdownToggle.contains(e.target)) {
                    dropdownParent.classList.remove('open');
                }
            }
        });

        // Reset dropdown state saat resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && dropdownParent) {
                dropdownParent.classList.remove('open');
            }
        });

        // ===== ACTIVE NAV LINK =====
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') && currentPath.includes(link.getAttribute('href').replace('{{ route', '').replace(')', ''))) {
                if (!link.closest('.dropdown-menu')) {
                    link.classList.add('active');
                }
            }
        });

        // ===== INTERSECTION OBSERVER FOR STEPS =====
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.step-card').forEach(card => observer.observe(card));

        // ===== SCROLL TO TOP =====
        const scrollTopBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) scrollTopBtn.classList.add('visible');
            else scrollTopBtn.classList.remove('visible');
        });
        function scrollToTop() { window.scrollTo({ top: 0, behavior: 'smooth' }); }
    </script>
</body>
</html>