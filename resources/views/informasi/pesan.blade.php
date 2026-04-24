<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket Wisata - Nganjuk Abirupa</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* ============ BASE & VARIABLES ============ */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-green: #4CAF50;
            --dark-green: #2E7D32;
            --accent-blue: #26A69A;
            --bg-light: #f5faf5;
            --text-dark: #333;
            --text-gray: #666;
            --shadow: 0 4px 20px rgba(0,0,0,0.08);
            --nav-bg: #e1e6ec;
            --nav-text: #4b5563;
            --nav-underline: #fbbf24;
        }
        body { font-family: 'Poppins', sans-serif; color: var(--text-dark); background: var(--bg-light); overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }

       /* ============ NAVBAR (FLOATING CAPSULE) ============ */
.navbar {
    position: fixed;
    top: 20px;          /* Jarak dari atas (biar melayang) */
    left: 0;
    right: 0;
    width: 100%;
    z-index: 1000;      /* Pastikan di atas elemen lain */
    
    /* ✅ KUNCI: Background harus TRANSPARAN (hapus warna putih) */
    background: transparent !important;
    box-shadow: none !important; /* Hapus bayangan luar */
    border: none !important;
    
    padding: 0;
    transition: all 0.3s ease;
}

.navbar-container {
    max-width: 1000px;  /* Ukuran kapsul (sesuaikan kalau mau lebih lebar/sempit) */
    margin: 0 auto;     /* Tengah-tengah */
    
    /* ✅ KUNCI: Background abu-abu ditaruh DI SINI (di kapsulnya) */
    background: var(--nav-bg); 
    
    border-radius: 50px; /* Bentuk kapsul */
    padding: 12px 30px;  /* Padding dalam kapsul */
    display: flex;
    align-items: center;
    justify-content: space-between;
    
    /* Bayangan hanya pada kapsulnya */
    box-shadow: 0 4px 20px rgba(0,0,0,0.1); 
}
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

        /* Dropdown Menu Navbar */
        .navbar-menu li { position: relative; }
        .dropdown-menu { position: absolute; top: 100%; left: 50%; transform: translateX(-50%) translateY(10px); background: white; min-width: 180px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); padding: 8px 0; opacity: 0; visibility: hidden; transition: all 0.3s ease; z-index: 100; list-style: none; }
        .dropdown:hover .dropdown-menu { opacity: 1; visibility: visible; transform: translateX(-50%) translateY(0); }
        .dropdown-menu li a { display: block; padding: 10px 20px; color: #333; font-weight: 500; font-size: 14px; white-space: nowrap; }
        .dropdown-menu li a:hover { background-color: #f0f8f4; color: var(--primary-green); padding-left: 25px; }
        .dropdown-menu li a::after { display: none; }

        /* ============ MAIN LAYOUT ============ */
        .main-wrapper {
            margin-top: 110px;
            padding: 40px 20px 80px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .booking-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .col-title { font-size: 22px; font-weight: 700; margin-bottom: 5px; }
        .col-subtitle { color: var(--text-gray); font-size: 14px; margin-bottom: 25px; }

        /* ============ LEFT COLUMN ============ */
        .custom-select {
            position: relative;
            margin-bottom: 30px;
        }
        .select-btn {
            padding: 12px 15px;
            border: 2px solid var(--primary-green);
            border-radius: 10px;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f0fdf4;
        }
        .select-list {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #eee;
            border-radius: 10px;
            margin-top: 5px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            z-index: 10;
            list-style: none;
            max-height: 200px;
            overflow-y: auto;
        }
        .select-list.active { display: block; }
        .select-list li {
            padding: 12px 15px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .select-list li:hover { background: #f0f8f4; color: var(--primary-green); }

        .info-box {
            margin-top: 30px;
        }
        .pill-list { list-style: none; }
        .pill-list li {
            padding: 10px 15px;
            border-radius: 20px;
            margin-bottom: 10px;
            font-size: 13px;
            line-height: 1.5;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .pill-list.green li { background: #dcfce7; color: #166534; }
        .pill-list.dark li { background: #1e293b; color: white; }
        .pill-list li::before {
            content: '';
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.5;
            flex-shrink: 0;
        }

        /* ============ RIGHT COLUMN ============ */
        .form-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 25px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px; }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s;
        }
        .form-group input:focus { outline: none; border-color: var(--primary-green); }
        
        .visitor-counters {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
        }
        .counter-box {
            flex: 1;
            background: white;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }
        .counter-box .label { font-weight: 600; font-size: 14px; display: block; }
        .counter-box .price-hint { font-size: 11px; color: var(--text-gray); display: block; margin-bottom: 8px; }
        .counter-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f1f5f9;
            border-radius: 8px;
            padding: 5px;
        }
        .counter-controls button {
            width: 30px; height: 30px;
            border: none; background: white;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            color: var(--text-dark);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .counter-controls span { font-weight: 700; }

        .summary-box {
            background: #dcfce7;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .summary-row.total {
            border-top: 1px solid #bbf7d0;
            padding-top: 10px;
            margin-top: 10px;
            font-weight: 700;
            font-size: 16px;
            color: var(--dark-green);
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: var(--primary-green);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: background 0.3s;
        }
        .btn-submit:hover { background: var(--dark-green); }

        /* ============ FOOTER ============ */
        .footer { background: linear-gradient(135deg, #4CAF50 0%, #26A69A 100%); color: white; padding: 30px 0 15px; margin-top: 40px; text-align: center; }
        .footer p { font-size: 13px; opacity: 0.9; }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 900px) {
            .booking-container { grid-template-columns: 1fr; padding: 20px; }
            .navbar-menu { display: none; position: absolute; top: 100%; left: 20px; right: 20px; background: white; flex-direction: column; padding: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-top: 10px; }
            .navbar-menu.active { display: flex; }
            .hamburger { display: flex; }
        }

                /* ============ ANIMATIONS & EFFECTS ============ */
        
        /* 1. Floating Animation untuk Framed Cards */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }
        
        .framed-item {
            animation: float 3s ease-in-out infinite;
            animation-delay: calc(var(--i, 0) * 0.2s); /* Staggered delay */
        }
        
        .framed-item:nth-child(1) { --i: 1; }
        .framed-item:nth-child(2) { --i: 2; }
        .framed-item:nth-child(3) { --i: 3; }
        .framed-item:nth-child(4) { --i: 4; }
        
        /* 2. Efek Timbul (3D) saat Hover */
        .framed-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .framed-item .card-content {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .framed-item:hover .card-content {
            transform: scale(1.02);
        }
        
        /* 3. Button Glow Effect */
        .btn-submit {
            position: relative;
            overflow: hidden;
        }
        
        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }
        
        .btn-submit:hover::before {
            left: 100%;
        }
        
        .btn-submit:hover {
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.5);
            transform: translateY(-2px);
        }
        
        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }
        
        /* 4. Input Focus Glow */
        .form-group input:focus {
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
            border-color: var(--primary-green);
        }
        
        /* 5. Counter Button Press Effect */
        .counter-controls button:active {
            transform: scale(0.9);
            background: var(--primary-green);
            color: white;
            transition: all 0.1s ease;
        }
        
        /* 6. Dropdown List Item Hover */
        .select-list li {
            position: relative;
            overflow: hidden;
        }
        
        .select-list li::before {
            content: '';
            position: absolute;
            left: 0; top: 0;
            width: 4px; height: 100%;
            background: var(--primary-green);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .select-list li:hover::before {
            transform: scaleY(1);
        }
        
        /* 7. Card Select Button Hover */
        .select-btn:hover {
            background: #dcfce7;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.2);
            transition: all 0.3s ease;
        }
        
        /* 8. Summary Box Pulse Effect */
        .summary-box {
            position: relative;
        }
        
        .summary-row.total {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.9; }
        }
        
        /* 9. Page Load Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .booking-container {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .left-col {
            animation: fadeInUp 0.6s ease-out 0.2s backwards;
        }
        
        .right-col {
            animation: fadeInUp 0.6s ease-out 0.4s backwards;
        }
        
        /* 10. Navbar Scroll Effect */
        .navbar.scrolled {
            background: rgba(225, 230, 236, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        /* ============ HOVER EFFECT UNTUK CARD ============ */

/* Efek hover untuk card hijau (Syarat & Ketentuan) */
.pill-list.green li {
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); /* Bouncy effect */
    cursor: default;
    transform: translateY(0); /* Reset position */
}

.pill-list.green li:hover {
    transform: translateY(-10px) scale(1.02);  /* Naik 10px + membesar 2% */
    box-shadow: 0 15px 35px rgba(22, 101, 52, 0.25);  /* Bayangan lebih besar */
    background: #bbf7d0;
}

/* Efek hover untuk card hitam (Tips Berkunjung) */
.pill-list.dark li {
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); /* Bouncy effect */
    cursor: default;
    transform: translateY(0);
}

.pill-list.dark li:hover {
    transform: translateY(-10px) scale(1.02);  /* Naik 10px + membesar 2% */
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);  /* Bayangan lebih kuat */
    background: #334155;
}

/* Icon membesar lebih banyak */
.pill-list li::before {
    transition: transform 0.4s ease;
}

.pill-list li:hover::before {
    transform: scale(1.3);  /* Icon membesar 30% */
}

/* ============ HOVER EFFECT UNTUK TOMBOL & DROPDOWN ============ */

/* 1. Efek hover untuk dropdown "Pilih Destinasi Wisata" */
.select-btn {
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    cursor: pointer;
    transform: translateY(0);
}

.select-btn:hover {
    transform: translateY(-8px);  /* Naik 8px */
    box-shadow: 0 15px 30px rgba(76, 175, 80, 0.3);  /* Bayangan hijau */
    background: #dcfce7;  /* Hijau lebih terang */
    border-color: var(--dark-green);  /* Border lebih gelap */
}

.select-btn:active {
    transform: translateY(-4px);  /* Turun sedikit saat klik */
}

/* 2. Efek hover untuk tombol "Pesan Sekarang" */
.btn-submit {
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    transform: translateY(0);
    position: relative;
    overflow: hidden;
}

.btn-submit:hover {
    transform: translateY(-10px);  /* Naik 10px */
    box-shadow: 0 20px 40px rgba(76, 175, 80, 0.4);  /* Bayangan besar */
    background: var(--dark-green);  /* Hijau lebih gelap */
}

.btn-submit:active {
    transform: translateY(-5px);  /* Turun sedikit saat klik */
    box-shadow: 0 10px 25px rgba(76, 175, 80, 0.3);
}

/* Efek shine/glow pada tombol Pesan Sekarang */
.btn-submit::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.6s ease;
}

.btn-submit:hover::before {
    left: 100%;  /* Efek cahaya melintas */
}

/* 3. Efek hover untuk counter box (Dewasa & Anak) */
.counter-box {
    transition: all 0.3s ease;
    transform: translateY(0);
}

.counter-box:hover {
    transform: translateY(-5px);  /* Naik 5px */
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* 4. Efek untuk tombol + dan - */
.counter-controls button {
    transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.counter-controls button:hover {
    transform: scale(1.15);  /* Membesar 15% */
    background: var(--primary-green);
    color: white;
    box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
}

.counter-controls button:active {
    transform: scale(0.95);  /* Mengecil saat klik */
}

/* 5. Efek untuk input form */
.form-group input {
    transition: all 0.3s ease;
}

.form-group input:focus {
    transform: translateY(-3px);  /* Naik sedikit saat focus */
    box-shadow: 0 8px 20px rgba(76, 175, 80, 0.2);
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
                            <li><a href="{{ route('informasi.harga') }}">Harga Tiket</a></li>
                            <li><a href="{{ route('informasi.pesan') }}" style="color: var(--primary-green); font-weight: 700;">Pesan Tiket Wisata</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('riwayat') }}">Riwayat</a></li>
                </ul>
            </div>
            <button class="btn-login">Login</button>
            <div class="hamburger" onclick="document.getElementById('navMenu').classList.toggle('active')">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="main-wrapper">
        <div class="booking-container">
            
            <!-- LEFT COLUMN -->
            <div class="left-col">
                <h2 class="col-title">Pilih Destinasi Wisata</h2>
                <p class="col-subtitle">Pilih destinasi wisata untuk melanjutkan pemesanan tiket</p>

                <div class="custom-select" id="wisata-select">
                    <div class="select-btn" onclick="toggleSelect()">
                        <span id="select-text">Pilih salah satu wisata</span>
                        <span>▼</span>
                    </div>
                    <ul class="select-list">
                        <li onclick="selectOption('Air Terjun Sedudo', 10000, 8000, 1000)">Air Terjun Sedudo</li>
                        <li onclick="selectOption('Goa Margo Tresno', 9000, 7000, 1000)">Goa Margo Tresno</li>
                        <li onclick="selectOption('Air Terjun Roro Kuning', 8000, 6000, 1000)">Air Terjun Roro Kuning</li>
                        <li onclick="selectOption('Taman Rekreasi Anjuk Ladang', 8000, 5000, 500)">Taman Rekreasi Anjuk Ladang</li>
                        <li onclick="selectOption('Kolam Renang Sri Tanjung', 10000, 7000, 500)">Kolam Renang Sri Tanjung</li>
                    </ul>
                </div>

                <div class="info-box">
                    <h3 style="font-size: 16px; margin-bottom: 15px;">Syarat & Ketentuan Umum :</h3>
                    <ul class="pill-list green">
                        <li>Jam Operasional Buka setiap hari mulai pukul 07.00 hingga 16.00 WIB</li>
                        <li>Dilarang keras membuang sampah sembarangan di area air terjun</li>
                        <li>Pengunjung dihimbau berhati-hati saat mandi dibawah air terjun yang memiliki tinggi 105 meter</li>
                        <li>Pada momen tertentu seperti bulan suro, terdapat upacara adat Siraman Sedudo, yang membuat kawasan ini digunakan untuk ruwat bumi.</li>
                    </ul>

                    <h3 style="font-size: 16px; margin-bottom: 15px; margin-top: 25px;">Tips Berkunjung :</h3>
                    <ul class="pill-list dark">
                        <li>Waktu Terbaik: Hari kerja (Senin-Jumat) jika menyukai ketenangan, atau akhir pekan untuk suasana ramai.</li>
                        <li>Aksesibilitas: Terletak di Desa Ngliman, Kecamatan Sawahan, sekitar 30 km dari pusat kota Nganjuk.</li>
                    </ul>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="right-col">
                <h2 class="col-title">Detail Pesanan</h2>
                <p class="col-subtitle">Lengkapi data diri dan jumlah pengunjung</p>

                <div class="form-card">
                    <form id="booking-form" onsubmit="handleBooking(event)">
                        <div class="form-group">
                            <label>Nama Lengkap *</label>
                            <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat Email *</label>
                            <input type="email" name="email" placeholder="Masukkan Email" required>
                        </div>
                        <div class="form-group">
                            <label>No. Telepon *</label>
                            <input type="tel" name="telepon" placeholder="08xxxxxxxxxxxx" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kunjungan *</label>
                            <input type="date" name="tanggal" required>
                        </div>

                        <label style="font-weight: 600; display: block; margin-bottom: 10px;">Jumlah Pengunjung *</label>
                        <div class="visitor-counters">
                            <div class="counter-box">
                                <span class="label">Dewasa</span>
                                <span class="price-hint" id="adult-price-hint">(Rp10.000 / orang)</span>
                                <div class="counter-controls">
                                    <button type="button" onclick="updateCount('adult', -1)">-</button>
                                    <span id="adult-count">0</span>
                                    <button type="button" onclick="updateCount('adult', 1)">+</button>
                                </div>
                            </div>
                            <div class="counter-box">
                                <span class="label">Anak</span>
                                <span class="price-hint" id="child-price-hint">(Rp8.000 / orang)</span>
                                <div class="counter-controls">
                                    <button type="button" onclick="updateCount('child', -1)">-</button>
                                    <span id="child-count">0</span>
                                    <button type="button" onclick="updateCount('child', 1)">+</button>
                                </div>
                            </div>
                        </div>

                        <div class="summary-box">
                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span id="subtotal-price">Rp 0</span>
                            </div>
                            <div class="summary-row">
                                <span>Biaya Asuransi</span>
                                <span id="insurance-price">Rp 0</span>
                            </div>
                            <div class="summary-row total">
                                <span>Total Pembayaran</span>
                                <span id="total-price">Rp 0</span>
                            </div>
                        </div>

                        <button type="submit" class="btn-submit">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            </svg>
                            Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <p>© 2026 Nganjuk Abirupa. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // === DROPDOWN WISATA ===
        function toggleSelect() {
            document.querySelector('.select-list').classList.toggle('active');
        }

        function selectOption(name, adultPrice, childPrice, insurance) {
            document.getElementById('select-text').textContent = name;
            document.getElementById('select-text').style.color = 'var(--text-dark)';
            document.querySelector('.select-list').classList.remove('active');
            
            // Update hints
            document.getElementById('adult-price-hint').textContent = `(Rp${formatNumber(adultPrice)} / orang)`;
            document.getElementById('child-price-hint').textContent = `(Rp${formatNumber(childPrice)} / orang)`;
            
            // Save current prices to global variables for calculation
            window.currentPrices = { adult: adultPrice, child: childPrice, insurance: insurance };
            calculateTotal();
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.custom-select')) {
                document.querySelector('.select-list').classList.remove('active');
            }
        });

        // === COUNTER & CALCULATION ===
        let counts = { adult: 0, child: 0 };
        // Default prices (Sedudo)
        window.currentPrices = { adult: 10000, child: 8000, insurance: 1000 };

        function updateCount(type, change) {
            if (counts[type] + change >= 0) {
                counts[type] += change;
                document.getElementById(type + '-count').textContent = counts[type];
                calculateTotal();
            }
        }

        function calculateTotal() {
            const p = window.currentPrices;
            const subtotal = (counts.adult * p.adult) + (counts.child * p.child);
            const insurance = (counts.adult + counts.child) * p.insurance;
            const total = subtotal + insurance;

            document.getElementById('subtotal-price').textContent = 'Rp ' + formatNumber(subtotal);
            document.getElementById('insurance-price').textContent = 'Rp ' + formatNumber(insurance);
            document.getElementById('total-price').textContent = 'Rp ' + formatNumber(total);
        }

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // === FORM SUBMIT ===
        function handleBooking(e) {
            e.preventDefault();
            const wisata = document.getElementById('select-text').textContent;
            if(wisata === 'Pilih salah satu wisata') {
                alert('Silakan pilih destinasi wisata terlebih dahulu!');
                return;
            }
            if(counts.adult + counts.child === 0) {
                alert('Jumlah pengunjung minimal 1 orang!');
                return;
            }
            alert('Pemesanan berhasil! (Simulasi)');
            // Di sini nanti bisa redirect ke halaman pembayaran atau simpan ke database
        }
    </script>

        <script>
        // === Navbar Scroll Effect ===
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // === Counter Button Ripple Effect ===
        document.querySelectorAll('.counter-controls button').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    border-radius: 50%;
                    background: rgba(76, 175, 80, 0.3);
                    left: ${x}px;
                    top: ${y}px;
                    animation: ripple 0.6s ease-out;
                    pointer-events: none;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add ripple keyframes dynamically
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // === Smooth Scroll for Dropdown ===
        document.querySelectorAll('.select-list li').forEach((item, index) => {
            item.style.transitionDelay = `${index * 0.05}s`;
        });
    </script>
</body>
</html>