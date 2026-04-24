<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harga Tiket - Nganjuk Abirupa</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        /* ============ BASE & VARIABLES ============ */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-green: #4CAF50;
            --accent-blue: #26A69A;
            --bg-light: #f5faf5;
            --text-dark: #333;
            --text-gray: #666;
            --shadow: 0 4px 20px rgba(0,0,0,0.08);
            --shadow-hover: 0 8px 30px rgba(0,0,0,0.15);
            --nav-bg: #e1e6ec;
            --nav-text: #4b5563;
            --nav-active: #101827;
            --nav-underline: #fbbf24;
        }
        body { font-family: 'Poppins', sans-serif; color: var(--text-dark); background: var(--bg-light); overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }

        /* ============ NAVBAR ============ */
        .navbar { position: fixed; top: 20px; left: 0; right: 0; width: 100%; z-index: 1000; background: transparent; padding: 0; transition: all 0.3s ease; }
        .navbar-container { max-width: 1000px; margin: 0 auto; background: var(--nav-bg); border-radius: 50px; padding: 12px 30px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .navbar-logo img { height: 40px; width: auto; }
        .navbar-menu-container { flex: 1; display: flex; justify-content: center; }
        .navbar-menu { display: flex; gap: 50px; align-items: center; list-style: none; }
        .navbar-menu a { font-weight: 700; font-size: 15px; position: relative; transition: color 0.3s; }
        .navbar-menu a:hover, .navbar-menu a.active { color: var(--nav-active); }
        .navbar-menu a.active::after { content: ''; position: absolute; bottom: -12px; left: 0; width: 100%; height: 4px; border-radius: 4px; background: var(--nav-underline); }
        .btn-login { padding: 10px 32px; border: 2px solid var(--primary-green); border-radius: 25px; color: var(--primary-green); font-weight: 600; cursor: pointer; background: transparent; transition: all 0.3s; }
        .btn-login:hover { background: var(--primary-green); color: white; transform: translateY(-2px); }
        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; }
        .hamburger span { width: 25px; height: 3px; background: var(--text-dark); border-radius: 3px; }

        /* ============ DROPDOWN ============ */
        .navbar-menu li { position: relative; }
        .dropdown-menu { position: absolute; top: 100%; left: 50%; transform: translateX(-50%) translateY(10px); background: white; min-width: 180px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); padding: 8px 0; opacity: 0; visibility: hidden; transition: all 0.3s ease; z-index: 100; list-style: none; }
        .dropdown:hover .dropdown-menu { opacity: 1; visibility: visible; transform: translateX(-50%) translateY(0); }
        .dropdown-menu li a { display: block; padding: 10px 20px; color: #333; font-weight: 500; font-size: 14px; white-space: nowrap; }
        .dropdown-menu li a:hover { background-color: #f0f8f4; color: var(--primary-green); padding-left: 25px; }
        .dropdown-menu li a::after { display: none; }

        /* ============ MAIN CONTENT ============ */
        .main-wrapper { margin-top: 110px; padding: 40px 20px 80px; }
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
            .navbar-menu { display: none; position: absolute; top: 100%; left: 20px; right: 20px; background: white; flex-direction: column; padding: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); gap: 15px; margin-top: 10px; }
            .navbar-menu.active { display: flex; }
            .hamburger { display: flex; }
            .price-grid { grid-template-columns: 1fr; }
            .section-title h1 { font-size: 26px; }
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
            <div class="navbar-menu-container">
                <ul class="navbar-menu" id="navMenu">
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="dropdown">
                        <a href="#" class="active">Informasi Tiket ▾</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('informasi.harga') }}" style="color: var(--primary-green); font-weight: 700;">Harga Tiket</a></li>
                            <li><a href="{{ route('informasi.pesan') }}">Pesan Tiket Wisata</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('riwayat') }}">Riwayat</a></li>
                </ul>
            </div>
            <div>
                <button class="btn-login" onclick="alert('Fitur Login akan segera hadir!')">Login</button>
            </div>
            <div class="hamburger" onclick="document.getElementById('navMenu').classList.toggle('active')">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="main-wrapper">
        <div class="section-title" data-aos="fade-down">
            <h1>DAFTAR HARGA TIKET</h1>
            <p class="section-subtitle">Informasi lengkap harga tiket masuk wisata Nganjuk. Harga dapat berubah sewaktu-waktu sesuai kebijakan pengelola.</p>
        </div>

        <div class="price-grid">
            <!-- 1. Air Terjun Sedudo -->
            <div class="price-card" data-aos="fade-up" data-aos-delay="100">
                <div class="price-header">
                    <h3>Air Terjun Sedudo</h3>
                    <span class="price-badge">Wisata Alam</span>
                </div>
                <div class="price-body">
                    <div class="price-row">
                        <span class="price-label">Tiket Dewasa</span>
                        <span class="price-value">Rp 10.000</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Tiket Anak-anak</span>
                        <span class="price-value">Rp 8.000</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Asuransi Perjalanan</span>
                        <span class="price-value">Rp 1.000</span>
                    </div>
                    <div class="price-total">
    <span class="label">🕐 Jam Buka</span>
    <span class="amount">08:00 - 17:00</span>
</div>
                </div>
            </div>

            <!-- 2. Air Terjun Roro Kuning -->
            <div class="price-card" data-aos="fade-up" data-aos-delay="200">
                <div class="price-header">
                    <h3>Air Terjun Roro Kuning</h3>
                    <span class="price-badge">Wisata Alam</span>
                </div>
                <div class="price-body">
                    <div class="price-row">
                        <span class="price-label">Tiket Dewasa</span>
                        <span class="price-value">Rp 8.000</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Tiket Anak-anak</span>
                        <span class="price-value">Rp 6.000</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Asuransi Perjalanan</span>
                        <span class="price-value">Rp 1.000</span>
                    </div>
                    <div class="price-total">
    <span class="label">🕐 Jam Buka</span>
    <span class="amount">08:00 - 17:00</span>
</div>
                </div>
            </div>

            <!-- 3. Goa Margo Tresno -->
            <div class="price-card" data-aos="fade-up" data-aos-delay="300">
                <div class="price-header">
                    <h3>Goa Margo Tresno</h3>
                    <span class="price-badge">Wisata Sejarah & Alam</span>
                </div>
                <div class="price-body">
                    <div class="price-row">
                        <span class="price-label">Tiket Dewasa</span>
                        <span class="price-value">Rp 9.000</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Tiket Anak-anak</span>
                        <span class="price-value">Rp 7.000</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Asuransi Perjalanan</span>
                        <span class="price-value">Rp 1.000</span>
                    </div>
                    <div class="price-total">
    <span class="label">🕐 Jam Buka</span>
    <span class="amount">08:00 - 17:00</span>
</div>
                </div>
            </div>

            <!-- 4. Sri Tanjung -->
            <div class="price-card" data-aos="fade-up" data-aos-delay="400">
                <div class="price-header">
                    <h3>Sri Tanjung</h3>
                    <span class="price-badge">Wisata Religi & Alam</span>
                </div>
                <div class="price-body">
                    <div class="price-row">
                        <span class="price-label">Tiket Dewasa</span>
                        <span class="price-value">Rp 10.000</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Tiket Anak-anak</span>
                        <span class="price-value">Rp 7.000</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Asuransi Perjalanan</span>
                        <span class="price-value">Rp 500</span>
                    </div>
                    <div class="price-total">
    <span class="label">🕐 Jam Buka</span>
    <span class="amount">08:00 - 17:00</span>
</div>
                </div>
            </div>

            <!-- 5. Taman Rekreasi Anjuk Ladang -->
            <div class="price-card" data-aos="fade-up" data-aos-delay="500">
                <div class="price-header">
                    <h3>Taman Rekreasi Anjuk Ladang</h3>
                    <span class="price-badge">Wisata Keluarga</span>
                </div>
                <div class="price-body">
                    <div class="price-row">
                        <span class="price-label">Tiket Dewasa</span>
                        <span class="price-value">Rp 8.000</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Tiket Anak-anak</span>
                        <span class="price-value">Rp 5.000</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Asuransi Perjalanan</span>
                        <span class="price-value">Rp 500</span>
                    </div>
                    <div class="price-total">
                        <span class="label">Total Mulai Dari</span>
                        <span class="amount">Rp 5.500</span>
                    </div>
                </div>
            </div>
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
        AOS.init({ duration: 800, easing: 'ease-out-cubic', once: true, offset: 50 });
        
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.padding = '10px 0';
            } else {
                navbar.style.padding = '0';
            }
        });
    </script>
</body>
</html>