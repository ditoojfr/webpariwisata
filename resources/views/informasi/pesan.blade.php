<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .custom-select { position: relative; margin-bottom: 30px; }
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

        .info-box { margin-top: 30px; }
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

        .visitor-counters { display: flex; gap: 20px; margin-bottom: 25px; }
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

        /* ============ LOGIN MODAL ============ */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
        }
        .modal-overlay.active { display: flex; }
        .modal {
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 90%;
            max-width: 420px;
            position: relative;
            animation: modalSlide 0.3s ease;
        }
        @keyframes modalSlide {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .modal-close {
            position: absolute;
            top: 15px; right: 20px;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-gray);
            background: none;
            border: none;
        }
        .modal h2 { font-size: 24px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px; }
        .modal .subtitle { color: var(--text-gray); font-size: 14px; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text-dark); margin-bottom: 8px; }
        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        }
        .form-group input:focus { outline: none; border-color: var(--primary-green); }
        .btn-submit-modal {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary-green), var(--accent-blue));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }
        .modal-footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: var(--text-gray);
        }
        .modal-footer-text a { color: var(--primary-green); text-decoration: none; font-weight: 600; }

        /* Animations */
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .booking-container { animation: fadeInUp 0.6s ease-out; }
        .left-col { animation: fadeInUp 0.6s ease-out 0.2s backwards; }
        .right-col { animation: fadeInUp 0.6s ease-out 0.4s backwards; }

        /* ============ RESPONSIVE MOBILE ============ */
        @media (max-width: 768px) {
            /* Navbar Mobile */
            .navbar { 
                top: 10px; 
                padding: 0 10px; 
            }
            .navbar-container { 
                padding: 8px 15px; 
                width: 95%;
            }
            .nav-logo img { 
                height: 30px; 
            }
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
            .btn-login {
                padding: 6px 18px;
                font-size: 12px;
            }

            /* Main Content Mobile */
            .main-wrapper {
                margin-top: 80px;
                padding: 20px 15px 60px;
            }

            .booking-container {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 25px 20px;
            }

            .col-title { 
                font-size: 20px;
                margin-bottom: 8px;
            }
            .col-subtitle { 
                font-size: 13px;
                margin-bottom: 20px;
            }

            /* Select Mobile */
            .custom-select { 
                margin-bottom: 25px; 
            }
            .select-btn {
                padding: 14px 15px;
                font-size: 15px;
            }

            /* Info Box Mobile */
            .info-box { 
                margin-top: 25px; 
            }
            .info-box h3 {
                font-size: 15px;
                margin-bottom: 12px;
            }
            .pill-list li {
                font-size: 12px;
                padding: 8px 12px;
            }

            /* Form Card Mobile */
            .form-card {
                padding: 20px 15px;
            }
            .form-group { 
                margin-bottom: 18px; 
            }
            .form-group label { 
                font-size: 13px;
                margin-bottom: 6px;
            }
            .form-group input {
                padding: 12px;
                font-size: 15px; /* Mencegah zoom di iOS */
            }

            /* Visitor Counters Mobile */
            .visitor-counters { 
                gap: 15px;
                margin-bottom: 20px;
            }
            .counter-box {
                padding: 12px;
            }
            .counter-box .label { 
                font-size: 13px;
            }
            .counter-box .price-hint { 
                font-size: 10px;
                margin-bottom: 8px;
            }
            .counter-controls button {
                width: 32px; 
                height: 32px;
                font-size: 18px;
            }
            .counter-controls span { 
                font-size: 16px;
                min-width: 30px;
                text-align: center;
            }

            /* Summary Box Mobile */
            .summary-box {
                padding: 15px;
                margin-bottom: 18px;
            }
            .summary-row {
                font-size: 13px;
                margin-bottom: 6px;
            }
            .summary-row.total {
                font-size: 15px;
                padding-top: 8px;
                margin-top: 8px;
            }

            /* Button Mobile */
            .btn-submit {
                padding: 14px;
                font-size: 15px;
            }

            /* Modal Mobile */
            .modal {
                padding: 30px 20px;
                margin: 20px;
            }
            .modal h2 {
                font-size: 20px;
            }
        }

        /* Extra Small Mobile */
        @media (max-width: 480px) {
            .navbar-container {
                padding: 8px 12px;
            }
            .nav-logo img {
                height: 28px;
            }
            .btn-login {
                padding: 6px 14px;
                font-size: 11px;
            }
            .hamburger span {
                width: 20px;
                height: 2px;
            }

            .main-wrapper {
                margin-top: 75px;
                padding: 15px 12px 50px;
            }

            .booking-container {
                padding: 20px 15px;
                gap: 25px;
            }

            .col-title {
                font-size: 18px;
            }
            .col-subtitle {
                font-size: 12px;
            }

            .select-btn {
                padding: 12px;
                font-size: 14px;
            }

            .form-card {
                padding: 18px 12px;
            }

            /* Stack counters vertically on very small screens */
            .visitor-counters {
                flex-direction: column;
                gap: 12px;
            }

            .counter-box {
                width: 100%;
            }

            .summary-row {
                font-size: 12px;
            }
            .summary-row.total {
                font-size: 14px;
            }

            .btn-submit {
                padding: 13px;
                font-size: 14px;
            }
        }

        /* Payment Modal Styles */
        .modal-container {
            background: white;
            border-radius: 20px;
            max-width: 400px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            transform: scale(0.8);
            transition: transform 0.3s ease;
        }
        .modal-overlay.active .modal-container {
            transform: scale(1);
        }
        .modal-header {
            background: white;
            color: var(--text-dark);
            padding: 25px 20px;
            text-align: center;
            border-radius: 20px 20px 0 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .modal-header h3 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .modal-header p {
            font-size: 14px;
            color: var(--text-gray);
        }
        .modal-body {
            padding: 25px;
        }
        .qr-section {
            text-align: center;
            margin-bottom: 25px;
            padding: 20px;
            background: #f9fafb;
            border-radius: 15px;
        }
        .qr-code {
            width: 200px;
            height: 200px;
            margin: 0 auto 15px;
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .qr-code img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .order-details {
            background: #f0fdf4;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }
        .order-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
            gap: 10px;
        }
        .order-item:last-of-type {
            margin-bottom: 0;
        }
        .order-item .label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-gray);
            font-weight: 500;
        }
        .order-item .label svg {
            width: 18px;
            height: 18px;
            color: var(--primary-green);
        }
        .order-item .value {
            font-weight: 600;
            color: var(--text-dark);
            text-align: right;
        }
        .order-item.total {
            border-top: 2px solid var(--primary-green);
            padding-top: 12px;
            margin-top: 12px;
            font-weight: 700;
            font-size: 16px;
        }
        .order-item.total .label {
            color: var(--primary-green);
        }
        .order-item.total .value {
            color: var(--dark-green);
            font-size: 18px;
        }
        .countdown-box {
            background: #fee2e2;
            border: 2px solid #ef4444;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
        }
        .countdown-box .icon {
            font-size: 24px;
            margin-bottom: 5px;
        }
        .countdown-box .time {
            color: #dc2626;
            font-weight: 700;
            font-size: 24px;
            font-family: 'Courier New', monospace;
        }
        .countdown-box .text {
            font-size: 13px;
            color: var(--text-gray);
            margin-top: 5px;
        }
        .modal-footer {
            display: flex;
            gap: 10px;
        }
        .btn-cancel {
            flex: 1;
            padding: 14px;
            border: 2px solid #e5e7eb;
            background: white;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--text-gray);
        }
        .btn-cancel:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
        }
        .btn-paid {
            flex: 1;
            padding: 14px;
            background: var(--primary-green);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-paid:hover {
            background: var(--dark-green);
        }

        /* Payment Modal Responsive */
        @media (max-width: 768px) {
            .modal-container {
                width: 95%;
                margin: 10px;
            }
            .modal-header {
                padding: 20px 15px;
            }
            .modal-header h3 {
                font-size: 18px;
            }
            .modal-body {
                padding: 20px 15px;
            }
            .qr-code {
                width: 160px;
                height: 160px;
            }
            .order-item {
                font-size: 13px;
            }
            .order-item.total {
                font-size: 15px;
            }
            .countdown-box .time {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .modal-header h3 {
                font-size: 17px;
            }
            .modal-header p {
                font-size: 12px;
            }
            .qr-code {
                width: 140px;
                height: 140px;
            }
            .order-details {
                padding: 15px;
            }
            .order-item {
                font-size: 12px;
            }
            .btn-cancel, .btn-paid {
                padding: 12px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
    <div class="navbar-container">
        <div class="nav-brand">
            <a href="{{ route('beranda') }}" class="nav-logo">
                <img src="{{ asset('images/logogedi.png') }}" alt="Nganjuk Abirupa">
            </a>
        </div>

        <div class="navbar-menu-container" id="mobileMenu">
            <ul class="nav-links">
                <li><a href="{{ route('beranda') }}" class="active">Beranda</a></li>

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

            <div class="info-box" id="infoWisataArea" style="display: none;">
                <h3 style="font-size: 16px; margin-bottom: 15px;">Syarat & Ketentuan Umum :</h3>
                <ul class="pill-list green" id="syarat-list"></ul>

                <h3 style="font-size: 16px; margin-bottom: 15px; margin-top: 25px;">Tips Berkunjung :</h3>
                <ul class="pill-list dark" id="tips-list"></ul>
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
                        <input type="date" name="tanggal" required onclick="this.showPicker()" style="cursor: pointer;">
                    </div>

                    <label style="font-weight: 600; display: block; margin-bottom: 10px;">Jumlah Pengunjung *</label>
                    <div class="visitor-counters">
                        <div class="counter-box">
                            <span class="label">Dewasa</span>
                            <span class="price-hint" id="adult-price-hint">(-)</span>
                            <div class="counter-controls">
                                <button type="button" onclick="updateCount('adult', -1)">-</button>
                                <span id="adult-count">0</span>
                                <button type="button" onclick="updateCount('adult', 1)">+</button>
                            </div>
                        </div>
                        <div class="counter-box">
                            <span class="label">Anak</span>
                            <span class="price-hint" id="child-price-hint">(-)</span>
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

<!-- LOGIN MODAL -->
<div class="modal-overlay" id="loginModal">
    <div class="modal">
        <button class="modal-close" onclick="closeModal()">&times;</button>
        <h2>Masuk ke Akun</h2>
        <p class="subtitle">Silakan login untuk mengakses fitur lengkap</p>
        <form id="formLogin" action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="contoh@email.com" required>
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
            </div>
            <button type="submit" name="login" class="btn-submit-modal">Masuk</button>
        </form>
        <div class="modal-footer-text">
            Belum punya akun? <a href="#">Daftar Sekarang</a>
        </div>
    </div>
</div>

<script>
    // === DROPDOWN WISATA ===
    function toggleSelect() {
        document.querySelector('.select-list').classList.toggle('active');
    }

    // === DATABASE MINI INFO WISATA ===
    const dataWisata = {
        'Air Terjun Sedudo': {
            syarat: [
                'Jam Operasional Buka setiap hari mulai pukul 07.00 hingga 16.00 WIB',
                'Dilarang keras membuang sampah sembarangan di area air terjun',
                'Pengunjung dihimbau berhati-hati saat mandi dibawah air terjun yang memiliki tinggi 105 meter',
                'Pada momen tertentu seperti bulan suro, terdapat upacara adat Siraman Sedudo'
            ],
            tips: [
                'Waktu Terbaik: Hari kerja (Senin-Jumat) jika menyukai ketenangan.',
                'Aksesibilitas: Terletak di Desa Ngliman, Kecamatan Sawahan, sekitar 30 km dari pusat kota Nganjuk.'
            ]
        },
        'Goa Margo Tresno': {
            syarat: [
                'Jam Operasional Buka setiap hari mulai pukul 08.00 hingga 15.00 WIB',
                'Wajib membawa penerangan (senter/HP) karena kondisi dalam goa gelap',
                'Dilarang merusak atau mencoret-coret dinding goa (vandalisme)',
                'Disarankan didampingi oleh juru kunci atau pemandu lokal'
            ],
            tips: [
                'Gunakan alas kaki yang tidak licin karena bebatuan di area goa cenderung lembab.',
                'Aksesibilitas: Terletak di Desa Sugihwaras, Kecamatan Ngluyu.'
            ]
        },
        'Air Terjun Roro Kuning': {
            syarat: [
                'Jam Operasional Buka setiap hari mulai pukul 07.30 hingga 16.00 WIB',
                'Patuhi batas aman berenang yang sudah ditentukan oleh petugas',
                'Dilarang membawa senjata tajam atau minuman keras'
            ],
            tips: [
                'Bawa baju ganti jika berniat bermain air.',
                'Terdapat fasilitas monumen Panglima Sudirman yang bisa dikunjungi di sekitar area.'
            ]
        },
        'default': {
            syarat: [
                'Jam Operasional Buka setiap hari sesuai ketentuan masing-masing lokasi',
                'Ikuti arahan dari petugas wisata setempat',
                'Jaga kebersihan lingkungan wisata'
            ],
            tips: [
                'Bawa perlengkapan secukupnya.',
                'Patuhi protokol kesehatan yang berlaku.'
            ]
        }
    };

    function selectOption(name, adultPrice, childPrice, insurance) {
        document.getElementById('select-text').textContent = name;
        document.getElementById('select-text').style.color = 'var(--text-dark)';
        document.querySelector('.select-list').classList.remove('active');
        
        const infoArea = document.getElementById('infoWisataArea');
        infoArea.style.display = 'block';
        infoArea.style.animation = 'fadeInUp 0.5s ease-out forwards';
        
        const syaratList = document.getElementById('syarat-list');
        const tipsList = document.getElementById('tips-list');
        
        syaratList.innerHTML = '';
        tipsList.innerHTML = '';
        
        const info = dataWisata[name] || dataWisata['default'];
        
        info.syarat.forEach(item => {
            syaratList.innerHTML += `<li>${item}</li>`;
        });
        
        info.tips.forEach(item => {
            tipsList.innerHTML += `<li>${item}</li>`;
        });
        
        document.getElementById('adult-price-hint').textContent = `(Rp${formatNumber(adultPrice)} / orang)`;
        document.getElementById('child-price-hint').textContent = `(Rp${formatNumber(childPrice)} / orang)`;
        
        window.currentPrices = { adult: adultPrice, child: childPrice, insurance: insurance };
        calculateTotal();
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.custom-select')) {
            document.querySelector('.select-list').classList.remove('active');
        }
    });

    // === COUNTER & CALCULATION ===
    let counts = { adult: 0, child: 0 };
    window.currentPrices = { adult: 0, child: 0, insurance: 0 };

    function updateCount(type, change) {
        const destinasi = document.getElementById('select-text').textContent;
        if (destinasi === 'Pilih salah satu wisata') {
            alert('Pilih destinasi wisata terlebih dahulu ya!');
            return; 
        }
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
        openPaymentModal();
    }

    // === PAYMENT MODAL FUNCTIONS ===
    function openPaymentModal() {
        const modal = document.getElementById('paymentModal');
        const wisata = document.getElementById('select-text').textContent;
        const tanggalInput = document.querySelector('input[name="tanggal"]').value;
        const total = document.getElementById('total-price').textContent;
        const dewasa = counts.adult;
        const anak = counts.child;

        let tanggalFormatted = '-';
        if (tanggalInput) {
            const date = new Date(tanggalInput);
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            tanggalFormatted = date.toLocaleDateString('id-ID', options);
        }

        document.getElementById('modal-destinasi').textContent = wisata;
        document.getElementById('modal-tanggal').textContent = tanggalFormatted;
        document.getElementById('modal-pengunjung').textContent = `${dewasa} Dewasa, ${anak} Anak`;
        document.getElementById('modal-total').textContent = total;

        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        startCountdown(12);
    }

    function closePaymentModal() {
        const modal = document.getElementById('paymentModal');
        modal.classList.remove('active');
        document.body.style.overflow = '';
        clearInterval(window.countdownInterval);
    }

    function startCountdown(minutes) {
        let totalSeconds = minutes * 60;
        const timerElement = document.getElementById('countdownTimer');
        window.countdownInterval = setInterval(() => {
            const mins = Math.floor(totalSeconds / 60);
            const secs = totalSeconds % 60;
            timerElement.textContent = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
            if (totalSeconds <= 0) {
                clearInterval(window.countdownInterval);
                timerElement.textContent = '00:00';
                alert('Waktu pembayaran telah habis. Silakan pesan ulang.');
                closePaymentModal();
            }
            totalSeconds--;
        }, 1000);
    }

    function confirmPayment() {
        const formData = {
            nama_customer: document.querySelector('input[name="nama"]').value,
            tlp_customer: document.querySelector('input[name="telepon"]').value,
            email: document.querySelector('input[name="email"]').value,
            tanggal_pesan: document.querySelector('input[name="tanggal"]').value,
            jml_tiket: counts.adult + counts.child,
            harga_total: parseInt(document.getElementById('total-price').textContent.replace(/[^0-9]/g, '')),
            id_wisata: getIdWisataByName(document.getElementById('select-text').textContent),
            id_customer: null,
            _token: document.querySelector('meta[name="csrf-token"]').content
        };

        const btnPaid = document.querySelector('.btn-paid');
        const originalText = btnPaid.innerHTML;
        btnPaid.disabled = true;
        btnPaid.innerHTML = '⏳ Memproses...';

        fetch('/transaksi', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': formData._token
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const destinasiWisata = document.getElementById('select-text').textContent;
                const tiketData = {
                    nomor: data.id_pemesanan || '#NGJ-' + Date.now().toString().slice(-8),
                    telepon: formData.tlp_customer,
                    email: formData.email,
                    waktu: new Date().toLocaleString('id-ID'),
                    destinasi: destinasiWisata,
                    nama: formData.nama_customer,
                    tanggal: formData.tanggal_pesan,
                    pengunjung: `${counts.adult} Dewasa, ${counts.child} Anak`,
                    total: document.getElementById('total-price').textContent
                };
                localStorage.setItem('tiketData', JSON.stringify(tiketData));
                alert('✅ ' + data.message);
                window.location.href = '{{ route("tiket") }}';
            } else {
                alert('❌ Gagal: ' + data.message);
                btnPaid.disabled = false;
                btnPaid.innerHTML = originalText;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('⚠️ Terjadi kesalahan koneksi. Silakan coba lagi.');
            btnPaid.disabled = false;
            btnPaid.innerHTML = originalText;
        });
    }

    function getIdWisataByName(namaWisata) {
        const mapping = {
            'Air Terjun Sedudo': 12,
            'Goa Margo Tresno': 13,
            'Air Terjun Roro Kuning': 14,
            'Taman Rekreasi Anjuk Ladang': 15,
            'Kolam Renang Sri Tanjung': 16
        };
        return mapping[namaWisata] || 12;
    }

    // === NAVBAR & MODAL FUNCTIONS ===
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

    // Modal Login
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
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.style.boxShadow = '0 10px 40px rgba(0,0,0,0.1)';
        } else {
            navbar.style.boxShadow = '0 10px 30px rgba(0,0,0,0.06)';
        }
    });
</script>

<!-- PAYMENT MODAL -->
<div class="modal-overlay" id="paymentModal">
    <div class="modal-container">
        <div class="modal-header">
            <h3>Pembayaran QRIS</h3>
            <p>Scan QR code dengan aplikasi pembayaran Anda</p>
        </div>
        <div class="modal-body">
            <div class="qr-section">
                <div class="qr-code">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=QRIS_NGANJUK_ABIRUPA" alt="QRIS Code">
                </div>
            </div>
            <div class="order-details">
                <div class="order-item" style="justify-content: flex-start; padding-bottom: 10px; margin-bottom: 10px; border-bottom: 1px solid #d1fae5;">
                    <span class="value" id="modal-destinasi" style="font-weight: 600; font-size: 15px; color: var(--text-dark);">-</span>
                </div>
                <div class="order-item">
                    <span class="label">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px;color:var(--primary-green);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Tanggal
                    </span>
                    <span class="value" id="modal-tanggal">-</span>
                </div>
                <div class="order-item">
                    <span class="label">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px;color:var(--primary-green);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Pengunjung
                    </span>
                    <span class="value" id="modal-pengunjung">-</span>
                </div>
                <div class="order-item total">
                    <span class="label">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px;color:var(--primary-green);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Total
                    </span>
                    <span class="value" id="modal-total">Rp 0</span>
                </div>
            </div>
            <div class="countdown-box">
                <div class="icon">⏰</div>
                <div class="time" id="countdownTimer">12:00</div>
                <div class="text">Selesaikan pembayaran sebelum</div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closePaymentModal()">Batalkan</button>
                <button class="btn-paid" onclick="confirmPayment()">Saya sudah bayar</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>