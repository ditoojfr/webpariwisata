<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Pesan Tiket - Nganjuk Abirupa</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-green: #4CAF50;
            --dark-green: #2E7D32;
            --light-green: #81C784;
            --bg-light: #f5faf5;
            --text-dark: #333;
            --text-gray: #4b5563; /* Ini yang kita ubah jadi lebih gelap */
            --nav-bg: #e1e6ec;
            --nav-text: #4b5563;
            --nav-active: #101827;
            --nav-underline: #fbbf24;
        }
        
        body { 
            font-family: 'Poppins', sans-serif; 
            color: var(--text-dark); 
            background: var(--bg-light);
            overflow-x: hidden;
        }

        /* ============ NAVBAR ============ */
        .navbar {
            position: fixed;
            top: 20px;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
            background: transparent;
            padding: 0;
        }

        .navbar-container {
            max-width: 1000px;
            margin: 0 auto;
            /* UBAH BACKGROUND & TAMBAH BACKDROP FILTER: */
            background: rgba(225, 230, 236, 0.85); 
            backdrop-filter: blur(10px);
            border-radius: 50px;
            padding: 12px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* PERTEGAS SHADOW SEDIKIT: */
            box-shadow: 0 4px 30px rgba(0,0,0,0.08); 
        }

        .navbar-logo img { height: 40px; }
        
        /* Dropdown Menu CSS */
        .navbar-menu { display: flex; gap: 50px; list-style: none; }
        .navbar-menu a {
            text-decoration: none;
            color: var(--nav-text);
            font-weight: 700;
            font-size: 15px;
            position: relative;
        }
        .navbar-menu a:hover, .navbar-menu a.active { color: var(--nav-active); }
        .navbar-menu a.active::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 0;
            width: 100%;
            height: 4px;
            border-radius: 4px;
            background: var(--nav-underline);
        }
        
        /* Dropdown Styles */
        .navbar-menu li.dropdown { position: relative; }
        
        .navbar-menu .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            background: white;
            min-width: 220px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 8px 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 100;
            list-style: none;
            margin-top: 12px;
        }
        
        .navbar-menu li.dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }
        
        .dropdown-menu li a {
            display: block;
            padding: 10px 20px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
            white-space: nowrap;
            transition: all 0.2s;
            text-decoration: none;
        }
        
        .dropdown-menu li a:hover {
            background-color: #f0f8f4;
            color: var(--primary-green);
            padding-left: 25px;
        }
        
        .dropdown-menu li a::after {
            display: none;
        }
        
        /* Panah dropdown dari CSS (HANYA 1 PANAH) */
        .dropdown-toggle::after {
            content: '';
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: 5px;
            vertical-align: middle;
            border-top: 5px solid currentColor;
            border-right: 5px solid transparent;
            border-left: 5px solid transparent;
            transition: transform 0.2s;
        }
        
        .dropdown:hover .dropdown-toggle::after {
            transform: rotate(180deg);
        }
        
        .btn-login {
            padding: 10px 32px;
            border: 2px solid var(--primary-green);
            border-radius: 25px;
            color: var(--primary-green);
            font-weight: 600;
            cursor: pointer;
            background: transparent;
            transition: all 0.3s;
        }
        .btn-login:hover { background: var(--primary-green); color: white; }

        /* PAGE HEADER */

        @keyframes headerSlideDown {
            from {
                opacity: 0;
                transform: translateY(-60px); /* Mulai dari posisi agak ke atas */
            }
            to {
                opacity: 1;
                transform: translateY(0); /* Turun ke posisi normal */
            }
        }

        .page-header {
            margin-top: 0; 
            text-align: center;
            padding: 140px 20px 80px 20px; 
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            color: white;
            border-radius: 0 0 50px 50px;
            /* WAJIB DITAMBAHKAN AGAR EFEK LENGKUNGAN BERHASIL */
            position: relative; 

            animation: headerSlideDown 0.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
        }

        

        .page-header h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .page-header p {
            font-size: 16px;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        /* ============ STEPS CONTAINER ============ */
        .steps-container {
            max-width: 1000px;
            margin: -50px auto 60px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .step-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            gap: 30px;
            align-items: flex-start;
            transition: all 0.4s ease;
            opacity: 0;
            transform: translateY(30px);
            border-left: 5px solid var(--primary-green);
            position: relative;
            z-index: 2;
        }

        .step-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .step-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .step-number {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-green), var(--light-green));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 800;
            flex-shrink: 0;
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .steps-container::before {
            content: '';
            position: absolute;
            top: 40px; /* Mulai dari tengah lingkaran pertama */
            bottom: 80px; 
            left: 60px; /* Menyesuaikan posisi tengah lingkaran (20px padding + 40px jari-jari) */
            width: 0;
            border-left: 2px dashed var(--light-green);
            z-index: 0; /* Berada di belakang card */
        }

        @media (max-width: 768px) {
            .steps-container::before {
                left: 50px; /* Disesuaikan dengan ukuran step-number mobile */
                top: 30px;
            }
        }

        .step-content {
            flex: 1;
        }

        .step-content h3 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 12px;
        }

        .step-content p {
            font-size: 15px;
            color: var(--text-gray);
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .step-features {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .feature-tag {
            background: #f0fdf4;
            color: var(--dark-green);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .feature-tag svg {
            width: 16px;
            height: 16px;
            color: var(--primary-green);
        }

        .info-icon-bg {
            background: #c6f6d5;
            color: var(--dark-green);
            padding: 8px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* ============ INFO BOX ============ */
        .info-box {
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border-radius: 20px;
            border-left: 5px solid var(--primary-green);
        }

        .info-box h4 {
            font-size: 22px;
            font-weight: 700;
            color: var(--dark-green);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-box ul {
            list-style: none;
            padding: 0;
        }

        .info-box li {
            padding: 10px 0;
            padding-left: 30px;
            position: relative;
            color: var(--text-gray);
            font-size: 14px;
            line-height: 1.6;
        }

        .info-box li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary-green);
            font-weight: bold;
            font-size: 18px;
        }

        /* ============ CTA SECTION ============ */
        .cta-section {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            color: white;
            margin-top: 60px;
        }

        .cta-section h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .cta-section p {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .btn-cta {
            display: inline-block;
            background: white;
            color: var(--primary-green);
            padding: 15px 40px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        .btn-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        /* ============ FOOTER ============ */
        .footer {
            background: var(--primary-green);
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 13px;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 768px) {
            .navbar-menu { display: none; }
            .page-header h1 { font-size: 28px; }
            .step-card {
                flex-direction: column;
                padding: 30px 20px;
            }
            .step-number {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }
            .step-content h3 { font-size: 20px; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('beranda') }}" class="navbar-logo">
                <img src="{{ asset('images/logo-abirupa.png') }}" alt="Nganjuk Abirupa">
            </a>
            <ul class="navbar-menu">
                <li><a href="{{ route('beranda') }}">Beranda</a></li>
                
                <!-- Dropdown Informasi Tiket -->
                <li class="dropdown">
                    <!-- ✅ HAPUS KARAKTER ▾, PANAH HANYA DARI CSS -->
                    <a href="#" class="dropdown-toggle">Informasi Tiket</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('informasi.harga') }}">Harga Tiket</a></li>
                        <li><a href="{{ route('informasi.cara-pesan') }}" class="active">Cara Pesan Tiket</a></li>
                        <li><a href="{{ route('informasi.pesan') }}">Pesan Tiket Wisata</a></li>
                    </ul>
                </li>
                
                <li><a href="{{ route('riwayat') }}">Riwayat</a></li>
            </ul>
            <button class="btn-login" onclick="window.location.href='{{ route('beranda') }}'">Login</button>
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
        <div class="step-card" data-aos="fade-up" data-aos-delay="100">
            <div class="step-number">1</div>
            <div class="step-content">
                <h3>Pilih Destinasi Wisata</h3>
                <p>Tentukan destinasi wisata yang ingin Anda kunjungi di Kabupaten Nganjuk. Tersedia berbagai pilihan wisata alam, budaya, dan edukasi yang menarik.</p>
                <div class="step-features">
                    <span class="feature-tag">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        Air Terjun Sedudo
                    </span>
                    <span class="feature-tag">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        Goa Margo Tresno
                    </span>
                    <span class="feature-tag">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        Roro Kuning
                    </span>
                </div>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="step-card" data-aos="fade-up" data-aos-delay="200">
            <div class="step-number">2</div>
            <div class="step-content">
                <h3>Isi Form Pemesanan</h3>
                <p>Lengkapi data diri Anda dan tentukan jumlah pengunjung (dewasa dan anak-anak). Pilih tanggal kunjungan yang diinginkan sesuai ketersediaan.</p>
                <div class="step-features">
                    <span class="feature-tag">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Data Diri Lengkap
                    </span>
                    <span class="feature-tag">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Pilih Tanggal
                    </span>
                    <span class="feature-tag">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Jumlah Pengunjung
                    </span>
                </div>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="step-card" data-aos="fade-up" data-aos-delay="300">
            <div class="step-number">3</div>
            <div class="step-content">
                <h3>Lakukan Pembayaran</h3>
                <p>Selesaikan pembayaran menggunakan QRIS atau metode pembayaran digital lainnya. Sistem akan menampilkan QR code untuk proses pembayaran yang cepat dan aman.</p>
                <div class="step-features">
                    <span class="feature-tag">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        QRIS
                    </span>
                    <span class="feature-tag">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Aman & Cepat
                    </span>
                    <span class="feature-tag">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        12 Menit
                    </span>
                </div>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="step-card" data-aos="fade-up" data-aos-delay="400">
            <div class="step-number">4</div>
            <div class="step-content">
                <h3>Dapatkan E-Ticket</h3>
                <p>Setelah pembayaran berhasil, e-ticket akan otomatis terkirim ke email Anda. Tunjukkan e-ticket (bisa dalam bentuk screenshot atau PDF) kepada petugas di lokasi wisata.</p>
                <div class="step-features">
                    <span class="feature-tag">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        E-Ticket via Email
                    </span>
                    <span class="feature-tag">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Download PDF
                    </span>
                    <span class="feature-tag">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Siap Digunakan
                    </span>
                </div>
            </div>
        </div>

    </div>

    <!-- INFO BOX -->
    <div class="info-box" data-aos="fade-up">
        <h4>
            <!-- ICON DIBUNGKUS CLASS BARU -->
            <span class="info-icon-bg">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </span>
            Informasi Penting:
        </h4>
        <ul>
            <li>Pembayaran harus diselesaikan dalam waktu 12 menit setelah pemesanan</li>
            <li>E-ticket hanya berlaku untuk tanggal yang telah dipilih</li>
            <li>Pastikan data yang diisi sudah benar sebelum melakukan pembayaran</li>
            <li>Tiket tidak dapat digunakan setelah tanggal kunjungan</li>
            <li>Untuk pembatalan, hubungi customer service minimal 1 hari sebelum kunjungan</li>
            <li>Tunjukkan e-ticket dalam kondisi jelas (tidak blur) kepada petugas</li>
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

    <!-- AOS Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, easing: 'ease-out-cubic', once: true });

        // Scroll animation for step cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.step-card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>