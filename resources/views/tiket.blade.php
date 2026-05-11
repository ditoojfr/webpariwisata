<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Ticket Anda - Nganjuk Abirupa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-green: #4CAF50;
            --dark-green: #2E7D32;
            --bg-light: #f5faf5;
            --text-dark: #333;
            --text-gray: #666;
            --nav-bg: #e1e6ec;
            --nav-text: #4b5563;
--nav-underline: #fbbf24;
        }
        
        body { 
            font-family: 'Poppins', sans-serif; 
            color: var(--text-dark); 
            background: var(--bg-light); 
        }
        
        a { text-decoration: none; color: inherit; }

        /* ============ NAVBAR ============ */
.navbar {
    position: fixed;
    top: 20px;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 1000;
    display: flex;
    justify-content: center;
}

.navbar-container {
    width: 90%;
    max-width: 1000px;
    position: relative;
    background: var(--nav-bg);
    border-radius: 50px;
    padding: 10px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.nav-brand { display: flex; align-items: center; gap: 12px; }
.nav-logo img { height: 36px; width: auto; display: block; }

.navbar-menu-container {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    justify-content: center;
}

.nav-links {
    display: flex;
    gap: 40px;
    list-style: none;
    margin: 0;
    padding: 0;
    align-items: center;
}

.nav-links li { position: relative; padding-bottom: 10px; }
.nav-links a {
    text-decoration: none;
    color: var(--nav-text);
    font-weight: 700;
    font-size: 14px;
    position: relative;
    transition: color 0.3s;
}
.nav-links a:hover,
.nav-links a.active { color: #101827; }
.nav-links a.active::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 100%;
    height: 3px;
    background: #fbbf24;
    border-radius: 2px;
}

.dropdown-menu { display: none; }
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
    margin-top: 0;
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

.nav-icons { display: flex; align-items: center; }
.btn-login {
    padding: 8px 24px;
    border: 2px solid var(--primary-green);
    border-radius: 50px;
    color: var(--primary-green);
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    background: transparent;
    font-family: 'Poppins', sans-serif;
    transition: all 0.2s;
    display: inline-block;
}
.btn-login:hover {
    background: var(--primary-green);
    color: white;
    transform: translateY(-2px);
}

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
        /* MAIN CONTENT */
        .main-wrapper {
            margin-top: 120px;
            padding: 40px 20px 80px;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        /* HEADER */
        .success-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .success-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-green);
            margin-bottom: 10px;
        }

        .success-subtitle {
            color: var(--text-gray);
            font-size: 14px;
            line-height: 1.6;
        }

        /* TICKET CONTAINER */
        .ticket-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .ticket-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        /* ========== SISI KIRI - E-TICKET CARD ========== */
        .ticket-card {
            background: linear-gradient(135deg, #1a472a 0%, #2d6a4f 50%, #40916c 100%);
            border-radius: 15px;
            padding: 25px;
            color: white;
            position: relative;
            overflow: hidden;
            min-height: 200px;
        }

        .ticket-card::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -15%;
            width: 180px;
            height: 180px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        .ticket-card::after {
            content: '';
            position: absolute;
            bottom: -40%;
            left: -10%;
            width: 150px;
            height: 150px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .ticket-brand {
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 8px;
            opacity: 0.85;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .ticket-wisata {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 3px;
            line-height: 1.2;
        }

        .ticket-lokasi {
            font-size: 12px;
            margin-bottom: 18px;
            opacity: 0.8;
        }

        .ticket-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 18px;
        }

        .ticket-info-item .label {
            font-size: 10px;
            opacity: 0.7;
            margin-bottom: 3px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .ticket-info-item .value {
            font-size: 13px;
            font-weight: 600;
        }

        .ticket-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid rgba(255,255,255,0.15);
        }

        .ticket-nomor {
            font-size: 12px;
            font-weight: 600;
            opacity: 0.9;
        }

        .ticket-qr {
            width: 55px;
            height: 55px;
            background: white;
            padding: 4px;
            border-radius: 6px;
        }

        .ticket-qr img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* SUMMARY INFO DI BAWAH CARD */
        .summary-info {
            margin-top: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .summary-item .label {
            font-size: 11px;
            color: var(--text-gray);
            margin-bottom: 3px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .summary-item .value {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .summary-item.total .value {
            color: var(--primary-green);
            font-size: 16px;
        }

        .summary-item .status-lunas {
            color: var(--primary-green);
            font-weight: 600;
        }

        /* ========== SISI KANAN - TETAP SAMA ========== */
        .download-section {
            margin-bottom: 30px;
        }

        .download-info {
            font-size: 13px;
            color: var(--text-gray);
            margin-bottom: 15px;
        }

        .btn-download {
            width: 100%;
            padding: 14px;
            background: var(--primary-green);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
        }

        .btn-download:hover {
            background: var(--dark-green);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .order-details {
            margin-bottom: 25px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: var(--text-gray);
        }

        .detail-label svg {
            width: 18px;
            height: 18px;
            color: var(--primary-green);
        }

        .detail-value {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-dark);
            text-align: right;
        }

        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .info-box-title {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-box-title svg {
            width: 18px;
            height: 18px;
            color: var(--primary-green);
        }

        .info-box ul {
            list-style: none;
            font-size: 12px;
            color: var(--text-gray);
        }

        .info-box ul li {
            margin-bottom: 8px;
            padding-left: 18px;
            position: relative;
            line-height: 1.5;
        }

        .info-box ul li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: var(--primary-green);
            font-weight: bold;
        }

        .info-box ul li:last-child {
            margin-bottom: 0;
        }

        .btn-home {
            width: 100%;
            padding: 14px;
            background: white;
            color: var(--primary-green);
            border: 2px solid var(--primary-green);
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
        }

        .btn-home:hover {
            background: var(--primary-green);
            color: white;
            transform: translateY(-2px);
        }

        /* HIDDEN TICKET FOR DOWNLOAD */
        #ticketArea {
            position: fixed;
            top: -9999px;
            left: -9999px;
            width: 800px;
        }

        .ticket-wrapper {
            position: relative;
            width: 100%;
            background: white;
            border-radius: 16px;
            overflow: hidden;
        }

        .ticket-image-container {
            position: relative;
            width: 100%;
            line-height: 0;
        }

        .ticket-template-bg {
            width: 100%;
            height: auto;
            display: block;
        }

        .ticket-data-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .data-field {
            position: absolute;
            /* Digeser agar benar-benar di tengah area putih stub tiket */
            right: 4%; 
            /* Lebar diperkecil agar tidak menyentuh gerigi/garis biru di kiri */
            width: 22%; 
            height: 10%;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e3a5f;
            font-weight: 700;
            text-align: center;
            font-size: clamp(11px, 1.1vw, 15px);
            padding: 0 5px;
            line-height: 1.1;
            overflow: hidden;
        }

        /* Mengatur ulang jarak vertikal (top) agar tidak saling bertumpukan */
        .field-destinasi { 
            top: 21%; 
        }
        .field-nama { 
            top: 37%; /* Ditambah jaraknya agar tidak ditabrak destinasi */
        }
        .field-email { 
            top: 50%; 
            font-size: clamp(9px, 0.8vw, 11px); 
            word-break: break-all;
        }
        .field-tanggal { 
            top: 62%; 
        }
        .field-pengunjung { 
            top: 74%; 
        }
        
        /* FOOTER */
        .footer { 
            background: linear-gradient(135deg, #4CAF50 0%, #26A69A 100%); 
            color: white; 
            padding: 30px 0 15px; 
            margin-top: 40px; 
            text-align: center; 
        }
        .footer p { font-size: 13px; opacity: 0.9; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .ticket-container {
            animation: fadeInUp 0.6s ease-out;
        }

        @media (max-width: 768px) {
            .ticket-grid { grid-template-columns: 1fr; gap: 30px; }
            /* Tambahkan ini di dalam @media (max-width: 768px) */
.navbar { top: 10px; padding: 0 10px; }
.navbar-container { padding: 8px 15px; width: 95%; }
.nav-logo img { height: 30px; }
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
    gap: 15px;
    text-align: center;
}
.nav-links li { padding-bottom: 0; width: 100%; }
.nav-links a { 
    font-size: 15px;
    padding: 8px 0;
    display: block;
}
.nav-links li:hover .dropdown-menu {
    position: relative;
    box-shadow: none;
    margin-top: 10px;
    border: 1px solid #eaeaea;
}
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
.btn-login { padding: 6px 18px; font-size: 12px; }
            .ticket-container { padding: 25px; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <!-- NAVBAR -->
<nav class="navbar" id="navbar">
    <div class="navbar-container">
        <div class="nav-brand">
            <a href="{{ route('beranda') }}" class="nav-logo">
                <img src="{{ asset('images/logo-abirupa.png') }}" alt="Nganjuk Abirupa">
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
        
        <!-- HEADER -->
        <div class="success-header">
            <h1 class="success-title">Pembayaran Berhasil!</h1>
            <p class="success-subtitle">Terimakasih, Pembayaran Anda telah kami terima.<br>Silahkan unduh e-ticket Anda dibawah ini.</p>
        </div>

        <!-- TICKET CONTAINER -->
        <div class="ticket-container">
            <div class="ticket-grid">
                
                <!-- ========== SISI KIRI (DIPERBARU) ========== -->
                <div class="left-column">
                    <h2 class="section-title">E-Ticket Anda</h2>
                    
                    <!-- E-TICKET CARD HIJAU -->
                    <div class="ticket-card">
                        <div class="ticket-brand">NGANJUK ABIRUPA</div>
                        <div class="ticket-wisata" id="card-wisata">-</div>
                        <div class="ticket-lokasi">Nganjuk, Jawa Timur</div>
                        
                        <div class="ticket-info-grid">
                            <div class="ticket-info-item">
                                <div class="label">TANGGAL</div>
                                <div class="value" id="card-tanggal">-</div>
                            </div>
                            <div class="ticket-info-item">
                                <div class="label">PENGUNJUNG</div>
                                <div class="value" id="card-pengunjung">-</div>
                            </div>
                        </div>
                        
                        <div class="ticket-footer">
                            <div class="ticket-nomor" id="card-nomor">#NGJ-</div>
                            <div class="ticket-qr">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=NGANJUK_ABIRUPA" alt="QR Code">
                            </div>
                        </div>
                    </div>

                    <!-- SUMMARY INFO DI BAWAH CARD -->
                    <div class="summary-info">
                        <div class="summary-item">
                            <div class="label">NAMA PEMESAN</div>
                            <div class="value" id="summary-nama">-</div>
                        </div>
                        <div class="summary-item total">
                            <div class="label">TOTAL BAYAR</div>
                            <div class="value" id="summary-total">-</div>
                        </div>
                        <div class="summary-item">
                            <div class="label">METODE</div>
                            <div class="value">QRIS</div>
                        </div>
                        <div class="summary-item">
                            <div class="label">STATUS</div>
                            <div class="value status-lunas">✓ Lunas</div>
                        </div>
                    </div>
                </div>

                <!-- ========== SISI KANAN (TETAP SAMA SEPERTI SEBELUMNYA) ========== -->
                <div class="right-column">
                    
                    <!-- DOWNLOAD SECTION -->
                    <div class="download-section">
                        <h2 class="section-title">Unduh Tiket</h2>
                        <p class="download-info">Simpan e-ticket untuk ditunjukkan nanti</p>
                        <button class="btn-download" onclick="downloadTicket()">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            Unduh E-Ticket
                        </button>
                    </div>

                    <!-- ORDER DETAILS -->
                    <div class="order-details">
                        <h2 class="section-title">Detail Pemesanan</h2>
                        
                        <div class="detail-item">
                            <span class="detail-label">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Nama Pemesan
                            </span>
                            <span class="detail-value" id="detail-nama">-</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Email
                            </span>
                            <span class="detail-value" id="detail-email">-</span> 
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                No. Telepon
                            </span>
                            <span class="detail-value" id="detail-telepon">-</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Metode Pembayaran
                            </span>
                            <span class="detail-value">QRIS</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Waktu Pembayaran
                            </span>
                            <span class="detail-value" id="detail-waktu">-</span>
                        </div>
                    </div>

                    <!-- INFO BOX -->
                    <div class="info-box">
                        <div class="info-box-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Penting
                        </div>
                        <ul>
                            <li>Tunjukkan e-ticket ini kepada petugas saat masuk lokasi</li>
                            <li>E-ticket hanya berlaku pada tanggal kunjungan yang tertera</li>
                            <li>E-ticket tidak dapat dipindahtangankan</li>
                        </ul>
                    </div>

                    <!-- BACK BUTTON -->
                    <a href="{{ route('beranda') }}" class="btn-home">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <p>© 2026 Nganjuk Abirupa - Disporabudpar Nganjuk. All rights reserved.</p>
    </footer>

    <!-- HIDDEN TICKET TEMPLATE FOR DOWNLOAD -->
    <div id="ticketArea">
        <div class="ticket-wrapper">
            <div class="ticket-image-container">
                <img src="{{ asset('images/template-tiket-baru.png.png') }}" 
                     alt="Ticket Template" 
                     class="ticket-template-bg"
                     crossorigin="anonymous">
                
                <div class="ticket-data-overlay">
                    <div class="data-field field-destinasi" id="text-destinasi"></div>
                    <div class="data-field field-nama" id="text-nama"></div>
                    <div class="data-field field-email" id="text-email"></div>
                    <div class="data-field field-tanggal" id="text-tanggal"></div>
                    <div class="data-field field-pengunjung" id="text-pengunjung"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>
        // === LOAD DATA FROM LOCAL STORAGE ===
        window.addEventListener('DOMContentLoaded', () => {
            const data = JSON.parse(localStorage.getItem('tiketData') || '{}');
            
            // Sisi Kiri - Card
            document.getElementById('card-wisata').textContent = data.destinasi || '-';
            document.getElementById('card-tanggal').textContent = formatTanggalShort(data.tanggal);
            document.getElementById('card-pengunjung').textContent = data.pengunjung || '-';
            document.getElementById('card-nomor').textContent = data.nomor || '#NGJ-';
            
            // Sisi Kiri - Summary
            document.getElementById('summary-nama').textContent = data.nama || '-';
            document.getElementById('summary-total').textContent = data.total || 'Rp 0';
            
            // Sisi Kanan - Detail Pemesanan
            document.getElementById('detail-nama').textContent = data.nama || '-';
            document.getElementById('detail-email').textContent = data.email || '-'; 
            document.getElementById('detail-telepon').textContent = data.telepon || '-';
            document.getElementById('detail-waktu').textContent = data.waktu || '-';
            
            // Template Tiket (untuk download)
            document.getElementById('text-destinasi').textContent = data.destinasi || '-';
            document.getElementById('text-nama').textContent = data.nama || '-';
            document.getElementById('text-email').textContent = data.email || '-';
            document.getElementById('text-tanggal').textContent = formatTanggal(data.tanggal);
            document.getElementById('text-pengunjung').textContent = data.pengunjung || '-';
        });

        function formatTanggal(tgl) {
            if (!tgl) return '-';
            return new Date(tgl).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
        }

        function formatTanggalShort(tgl) {
            if (!tgl) return '-';
            return new Date(tgl).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
        }

        // === DOWNLOAD FUNCTION ===
        function downloadTicket() {
            const btn = document.querySelector('.btn-download');
            const originalText = btn.innerHTML;
            btn.innerHTML = '⏳ Memproses...';
            btn.disabled = true;
            
            html2canvas(document.getElementById('ticketArea'), {
                useCORS: true,
                scale: 2,
                backgroundColor: '#ffffff',
                logging: false
            }).then(canvas => {
                const link = document.createElement('a');
                const nama = document.getElementById('text-nama').textContent || 'Tiket';
                const destinasi = document.getElementById('text-destinasi').textContent || 'Nganjuk';
                link.download = `E-Ticket-${destinasi}-${nama}.png`;
                link.href = canvas.toDataURL('image/png');
                link.click();
                
                btn.innerHTML = `
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Berhasil Diunduh
                `;
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }, 2000);
            }).catch(err => {
                console.error('Error:', err);
                alert('❌ Gagal mengunduh tiket. Silakan coba lagi.');
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
        }
    </script>

    <script>
    // === NAVBAR FUNCTIONS ===
    function toggleMobileMenu() {
        document.getElementById('mobileMenu').classList.toggle('active');
        if (!document.getElementById('mobileMenu').classList.contains('active')) {
            document.getElementById('dropdownToggle').parentElement.classList.remove('open');
        }
    }

    document.getElementById('dropdownToggle').addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            e.preventDefault();
            e.stopPropagation();
            this.parentElement.classList.toggle('open');
        }
    });

    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', (e) => {
            if (link.id === 'dropdownToggle') {
                e.preventDefault();
                return;
            }
            document.getElementById('mobileMenu').classList.remove('active');
            document.getElementById('dropdownToggle').parentElement.classList.remove('open');
        });
    });

    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.style.boxShadow = '0 10px 40px rgba(0,0,0,0.1)';
        } else {
            navbar.style.boxShadow = '0 10px 30px rgba(0,0,0,0.05)';
        }
    });
</script>

</body>
</html>