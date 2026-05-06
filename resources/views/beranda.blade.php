<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nganjuk Abirupa - Kelola Wisata dan Pengalaman Anda</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        /* ============ RESET & BASE ============ */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary-green: #4CAF50;
            --light-green: #81C784;
            --dark-green: #2E7D32;
            --accent-blue: #26A69A;
            --bg-light: #f5faf5;
            --bg-gradient: linear-gradient(135deg, #e8f5e9 0%, #e0f7fa 100%);
            --text-dark: #333;
            --text-gray: #666;
            --text-light: #999;
            --white: #ffffff;
            --shadow: 0 4px 20px rgba(0,0,0,0.08);
            --shadow-hover: 0 8px 30px rgba(0,0,0,0.15);
            
            --nav-bg: #e1e6ec;
            --nav-text: #4b5563;
            --nav-active: #101827;
            --nav-underline: #fbbf24;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background: var(--white);
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

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

        .nav-logo img {
            height: 36px;
            width: auto;
            display: block;
        }

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

        /* PERBAIKAN: Tambahan padding-bottom untuk mencegah area klik terputus saat kursor turun */
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
        .nav-links a.active { color: var(--nav-active); }

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

        /* ============ DROPDOWN MENU ============ */
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

       /* ============ RESPONSIVE (MOBILE) ============ */
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

            /* TAMBAHAN BARU: Menghilangkan margin putih di HP */
            .hero {
                margin-top: 0; 
                height: 60vh;
                min-height: 400px;
            }
        }

        /* ============ HERO SECTION ============ */
.hero {
    margin-top: 0; /* Menghilangkan ruang putih di bagian atas */
    position: relative;
    width: 100%;
    height: 85vh;
    min-height: 650px;
    overflow: hidden;
}

.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.9);
}

.hero-overlay {
    position: absolute;
    top: 0; /* Tarik overlay dari ujung atas */
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.3); /* Efek gelap transparan merata agar teks terbaca */
    display: flex;
    flex-direction: column;
    justify-content: center; /* Mendorong teks agar pas di tengah-tengah air biru */
    align-items: center;
    padding: 0 20px;
}

.hero-text {
    max-width: 1200px;
    text-align: center; /* Membuat teks rata tengah */
    color: white;
}

.hero-text h1 {
    font-size: 42px;
    font-weight: 800;
    text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
}

.hero-text p {
    font-size: 18px;
    margin-top: 10px;
    opacity: 0.9;
}

        /* ============ SECTION TITLE ============ */
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            position: relative;
            display: inline-block;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-green), var(--accent-blue));
            border-radius: 2px;
        }

        /* ============ APA YANG MENARIK (FEATURES) ============ */
        .features {
          padding: 100px 0;
    /* Gradasi Hijau Mint ke Biru Langit yang sangat lembut */
    background: linear-gradient(135deg, #f0fdf4 0%, #e0f7fa 100%);
    position: relative;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            position: relative;
            z-index: 1;
        }

        .feature-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 20px;
    padding: 35px 25px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    transition: all 0.4s ease;
}

        .feature-card[data-aos].aos-animate {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-green), var(--accent-blue));
            transform: scaleX(0);
            transition: transform 0.4s;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
        }

        .feature-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.4s ease;
        }

        .feature-icon img {
            width: 150px;       
            height: 150px;      
            object-fit: contain; 
            display: block;    
            margin: 0 auto;
        }

        .feature-card h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 12px;
            color: var(--text-gray);
            line-height: 1.7;
        }

/* ============ DESTINASI WISATA (DESTINATIONS) ============ */
.destinations {
    padding: 100px 0;
    /* Warna putih bersih agar foto destinasi tetap menjadi fokus utama */
   background-color: #f1f5f9;
    position: relative;
}

        .destinations-scroll {
            display: flex;
            gap: 25px;
            overflow-x: auto; 
            padding: 10px 20px 30px 20px; 
            scroll-behavior: smooth;
            -ms-overflow-style: none; 
            scrollbar-width: none;
        }

        .destinations-scroll::-webkit-scrollbar {
            display: none;
        }

      /* Gaya kartu destinasi yang lebih modern */
.destination-card {
    flex: 0 0 550px; 
    background-color: #ffffff; /* Card tetap putih bersih agar kontras dengan BG */
    border-radius: 24px; 
    overflow: hidden;
    /* Shadow diperhalus agar terlihat modern di atas background abu-abu */
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); 
    padding: 15px;
    border: 1px solid #e2e8f0; /* Garis tepi tipis agar card lebih tegas */
    transition: all 0.3s ease;
    cursor: pointer;
}
        .destination-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    border-color: var(--primary-green); /* Memberi sedikit sentuhan hijau saat di-hover */
}

        .card-image {
            width: 100%;
            height: 300px;
            overflow: hidden;
            border-radius: 15px; 
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
            transition: transform 0.4s ease;
        }

        .destination-card:hover .card-image img {
            transform: scale(1.05);
        }

        .card-text {
            padding: 20px 15px;
            text-align: center;
        }

       .card-text h3 {
    font-size: 20px;
    font-weight: 700;
    color: #334155;
    margin-top: 15px;
}

        /* ============ VISI MISI SECTION ============ */
        .visi-misi {
            padding: 80px 0;
            background: var(--bg-gradient);
            position: relative;
        }

        .visi-misi-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: start;
        }

        .visi-item, .misi-item {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            opacity: 0;
            transform: translateX(-30px);
            transition: all 0.6s ease;
        }

        .visi-item[data-aos].aos-animate,
        .misi-item[data-aos].aos-animate {
            opacity: 1;
            transform: translateX(0);
        }

        .visi-item .icon, .misi-item .icon {
            flex-shrink: 0;
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .visi-item .icon img,
        .misi-item .icon img {
            width: 100px;        
            height: 100px;
            object-fit: contain;
            display: block;
        }

        .visi-item h3, .misi-item h3 {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .visi-item p, .misi-item p {
            font-size: 14px;
            color: var(--text-gray);
            line-height: 1.8;
        }

        .misi-item ol {
            font-size: 14px;
            color: var(--text-gray);
            line-height: 2;
            padding-left: 20px;
        }

        .misi-item ol li {
            margin-bottom: 5px;
        }

        .handshake-illustration {
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transform: translateX(30px);
            transition: all 0.6s ease;
        }

        .handshake-illustration[data-aos].aos-animate {
            opacity: 1;
            transform: translateX(0);
        }

        .handshake-illustration img {
            max-width: 300px;
        }
/* ============ APP SECTION ============ */
.app-section {
    padding: 100px 0; /* Padding diperlebar agar lebih lega */
    background: linear-gradient(135deg, #81C784 0%, #26A69A 100%);
    position: relative;
    overflow: hidden;
}

.app-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 80px; /* Jarak antara HP dan Teks diperlebar agar tidak sesak */
    position: relative;
    z-index: 1;
    max-width: 1100px;
    margin: 0 auto;
}

.phone-mockup {
    flex-shrink: 0;
    width: 320px; /* Ukuran HP tetap besar sesuai permintaan */
    opacity: 0;
    transform: translateX(-50px);
    transition: all 0.8s ease;
}

.phone-mockup[data-aos].aos-animate {
    opacity: 1;
    transform: translateX(0);
}

.phone-mockup img {
    width: 100%;
    border-radius: 40px; /* Border radius disesuaikan dengan kelengkungan HP modern */
    box-shadow: 0 20px 50px rgba(0,0,0,0.25);
}

.app-text {
    color: white;
    opacity: 0;
    transform: translateX(50px);
    transition: all 0.8s ease;
    max-width: 550px;
}

.app-text[data-aos].aos-animate {
    opacity: 1;
    transform: translateX(0);
}

.app-text h3 {
    font-size: 38px; /* Ukuran judul sedikit ditambah agar lebih menonjol */
    font-weight: 800;
    margin-bottom: 24px;
    line-height: 1.2;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.app-text p {
    font-size: 18px; /* Teks deskripsi lebih besar agar mudah dibaca */
    opacity: 0.95;
    line-height: 1.8;
    margin-bottom: 40px;
}

/* PERBAIKAN: Tombol Download Sekarang */
.btn-app-download {
    display: inline-block;
    background-color: #ffffff; /* Putih agar sangat kontras dengan hijau */
    color: #2E7D32; /* Teks hijau gelap agar elegan */
    padding: 16px 35px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 16px;
    text-decoration: none;
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.btn-app-download:hover {
    transform: translateY(-5px); /* Efek melayang saat hover */
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    background-color: #f8f9fa;
    color: #1b5e20;
}

/* Responsivitas untuk layar HP */
@media (max-width: 992px) {
    .app-content {
        flex-direction: column;
        text-align: center;
        gap: 50px;
    }
    .app-text h3 {
        font-size: 28px;
    }
    .phone-mockup {
        width: 280px;
    }
}
        /* ============ DOWNLOAD SECTION ============ */
       .download-section {
    padding: 100px 0;
    /* Kombinasi warna Hijau ke Biru yang lebih menarik */
    background: linear-gradient(145deg, #f0fdf4 0%, #e0f2fe 100%);
    position: relative;
}

        .download-content {
    display: flex;
    align-items: center;
    gap: 80px;
}

.download-text {
    flex: 1;
    opacity: 0;
    transform: translateX(-30px);
    transition: all 0.6s ease;
}

.download-text h3 {
    font-size: 32px;
    font-weight: 800;
    color: #1e293b;
    line-height: 1.2;
    margin-bottom: 20px;
}

.download-text p {
    font-size: 16px;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 35px;
}

       /* Perbaikan Tombol yang Hilang/Kecil */
.btn-download-solid {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 16px 35px;
    background: linear-gradient(135deg, #4CAF50 0%, #26A69A 100%);
    color: white;
    border-radius: 50px;
    font-weight: 700;
    font-size: 16px;
    text-decoration: none;
    box-shadow: 0 10px 25px rgba(38, 166, 154, 0.3);
    transition: all 0.3s ease;
}

.btn-download-solid:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(38, 166, 154, 0.4);
    filter: brightness(1.1);
    color: white;
}

.download-illustration {
    flex: 1.2;
    text-align: center;
    opacity: 0;
    transform: translateX(30px);
    transition: all 0.6s ease;
}

.download-illustration img {
    max-width: 100%;
    height: auto;
    filter: drop-shadow(0 20px 40px rgba(0,0,0,0.1));
}

/* Responsif Mobile */
@media (max-width: 992px) {
    .download-content {
        flex-direction: column-reverse;
        text-align: center;
        gap: 50px;
    }
    .btn-download-solid {
        justify-content: center;
    }
}

        /* ============ FOOTER ============ */
        .footer {
            background: linear-gradient(135deg, #4CAF50 0%, #26A69A 100%);
            color: white;
            padding: 50px 0 30px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-about .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .footer-about .footer-logo .logo-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 18px;
        }

        .footer-about .footer-logo .logo-text {
            font-size: 18px;
            font-weight: 700;
        }

        .footer-about p {
            font-size: 13px;
            line-height: 1.8;
            opacity: 0.9;
        }

        .footer h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 2px;
            background: rgba(255,255,255,0.5);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            font-size: 13px;
            opacity: 0.8;
            transition: opacity 0.3s;
        }

        .footer-links a:hover {
            opacity: 1;
            padding-left: 5px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.2);
            padding-top: 20px;
            text-align: center;
            font-size: 13px;
            opacity: 0.8;
        }

        /* ============ LOGIN MODAL ============ */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
        }

        .modal-overlay.active {
            display: flex;
        }

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
            from {
                transform: translateY(-30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-gray);
            background: none;
            border: none;
            transition: color 0.3s;
        }

        .modal-close:hover {
            color: var(--text-dark);
        }

        .modal h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .modal .subtitle {
            color: var(--text-gray);
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-green);
        }

        .btn-submit {
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
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(76,175,80,0.4);
        }

        .modal-footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: var(--text-gray);
        }

        .modal-footer-text a {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 600;
        }

        /* ============ SCROLL TO TOP ============ */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-green), var(--accent-blue));
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(76,175,80,0.4);
            transition: all 0.3s;
            opacity: 0;
            visibility: hidden;
            z-index: 999;
        }

        .scroll-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(76,175,80,0.5);
        }

        /* ============ SISA MEDIA QUERIES (TABLET DLL) ============ */
        @media (max-width: 992px) {
            .features-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: repeat(2, 1fr); }
            .app-content { flex-direction: column; text-align: center; }
            .download-content { flex-direction: column; text-align: center; }
            .visi-misi-content { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .hero-text h1 { font-size: 28px; }
            .features-grid { grid-template-columns: 1fr; }
            .destinations-card { flex: 0 0 300px; } /* Sesuaikan ukuran card agar bisa di-scroll di mobile */
            .footer-grid { grid-template-columns: 1fr; }
            .section-title h2 { font-size: 22px; }
        }
    </style>
</head>
<body>

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
            <button class="btn-login" onclick="openModal()">Login</button>
            <div class="hamburger" onclick="toggleMobileMenu()">
                <span></span><span></span><span></span>
            </div>
        </div>
    </div>
</nav>

<section class="hero" id="beranda">
    <img src="{{ asset('images/fotoberanda.png') }}" alt="Wisata Nganjuk" class="hero-image">
    <div class="hero-overlay">
        <div class="hero-text" data-aos="fade-down" data-aos-duration="1000">
            <h1>Selamat Datang di Nganjuk Abirupa</h1>
            <p>Jelajahi keindahan wisata dan budaya Nganjuk yang mempesona</p>
        </div>
    </div>
</section>

<section class="features" id="informasi">
    <section class="features" id="informasi">
    <div class="container">
        <div class="section-title" data-aos="fade-down" data-aos-duration="800"></div><div class="container">
        <div class="section-title" data-aos="fade-down" data-aos-duration="800">
            <h2>Apa yang Menarik dari Nganjuk?</h2>
        </div>

        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
                <div class="feature-icon">
                    <img src="{{ asset('images/icon/iconsedudo.png') }}" alt="Pesona Sedudo">
                </div>
                <h3>Pesona Sedudo</h3>
                <p>Ikon wisata Nganjuk dilingkung Gunung Wilis, kono amriya membaawa khusiat awet muda.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                <div class="feature-icon">
                    <img src="{{ asset('images/icon/iconkuliner.png') }}" alt="Kuliner Khas">
                </div>
                <h3>Kuliner Khas</h3>
                <p>Cicipi Nasi Becek, perpaduan gulai dan sate khas Nganjuk yang melegenda.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
                <div class="feature-icon">
                    <img src="{{ asset('images/icon/iconwarisan.png') }}" alt="Warisan Budaya">
                </div>
                <h3>Warisan Budaya</h3>
                <p>Jejak berdirinya Nganjuk melalui Prasasti Anjuk Ladang (937 M) yang menandai kemenangan Raja Mpu Sindok.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="400" data-aos-duration="800">
                <div class="feature-icon">
                    <img src="{{ asset('images/icon/iconkesenian.png') }}" alt="Kesenian Lokal">
                </div>
                <h3>Kesenian Lokal</h3>
                <p>Nikmati berbagai pertunjukan kesenian tradisional yang kaya akan nilai budaya dan filosofi.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="500" data-aos-duration="800">
                <div class="feature-icon">
                    <img src="{{ asset('images/icon/iconakses.png') }}" alt="Akses Mudah">
                </div>
                <h3>Akses Mudah</h3>
                <p>Nganjuk terletak di jalur utama Surabaya-Yogyakarta, menjadikan tempat strategis bagi pelancong.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="600" data-aos-duration="800">
                <div class="feature-icon">
                    <img src="{{ asset('images/icon/iconcuaca.png') }}" alt="Cuaca Ideal">
                </div>
                <h3>Cuaca Ideal</h3>
                <p>Kunjungi di musim Kemarau (Mei-Oktober) untuk menjelajahi keindahan alam.</p>
            </div>
        </div>
    </div>
</section>

<section class="destinations" id="riwayat">
    <div class="container">
        <div class="section-title" data-aos="fade-down" data-aos-duration="800">
            <h2>DESTINASI WISATA NGANJUK</h2>
        </div>

        <div class="destinations-scroll">
            @forelse($destinasi as $index => $d)
            <a href="{{ route('wisata.detail', $d->id_wisata) }}" class="destination-card" data-aos="fade-up" data-aos-delay="{{ ($index % 5 + 1) * 100 }}" style="text-decoration:none; color:inherit;">
                <div class="card-image">
                    <img src="{{ asset('images/destinasi/' . $d->gambar) }}"
                         alt="{{ $d->nama_wisata }}"
                         onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                </div>
                <div class="card-text">
                    <h3>{{ strtoupper($d->nama_wisata) }}</h3>
                </div>
            </a>
            @empty
            <p style="text-align:center; color:#999; padding: 40px;">Belum ada destinasi wisata.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="visi-misi">
    <div class="container">
        <div class="section-title" data-aos="fade-down" data-aos-duration="800">
            <h2>Visi & Misi</h2>
        </div>

        <div class="visi-misi-content">
            <div class="left-column">
                <div class="visi-item" data-aos="fade-right" data-aos-duration="800">
                    <div class="icon">
                        <img src="{{ asset('images/icon/visi.png') }}" alt="Icon Visi">
                    </div>
                    <div>
                        <h3>Visi</h3>
                        <p>Mewujudkan Pariwisata Nganjuk yang berdaya saing, berbudaya, dan berwawasan lingkungan melalui peningkatan kualitas destinasi serta ekonomi kreatif.</p>
                    </div>
                </div>

                <div class="misi-item" data-aos="fade-right" data-aos-delay="100" data-aos-duration="800">
                    <div class="icon">
                        <img src="{{ asset('images/icon/misi.png') }}" alt="Icon Misi">
                    </div>
                    <div>
                        <h3>Misi</h3>
                        <ol>
                            <li>Meningkatkan pengembangan dan pelestarian budaya daerah sebagai daya tarik pariwisata unggulan.</li>
                            <li>Meningkatkan daya tarik dan aksesibilitas objek wisata untuk kenyamanan pengunjung.</li>
                            <li>Meningkatkan pelayanan, kenyamanan, dan keamanan di destinasi pariwisata.</li>
                            <li>Mendorong peran pelaku usaha pariwisata dan ekonomi kreatif sebagai aktor vital yang menciptakan pengalaman wisata berkualitas.</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="right-column">
                <div class="handshake-illustration" data-aos="fade-left" data-aos-duration="800">
                    <img src="{{ asset('images/icon/saliman.png') }}" alt="Ilustrasi Bersalaman">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="app-section">
    <div class="container">
        <div class="app-content">
            <div class="phone-mockup" data-aos="zoom-in" data-aos-duration="1000">
                <img src="{{ asset('images/icon/hape.png') }}" alt="Mockup Aplikasi Nganjuk Abirupa">
            </div>
            <div class="app-text" data-aos="zoom-in" data-aos-delay="200" data-aos-duration="1000">
    <h3>Temukan Hal yang sama dengan Versi Berbeda</h3>
    <p>Jelajahi semua destinasi wisata Nganjuk melalui aplikasi mobile kami. Dapatkan informasi lengkap, pemesanan tiket online, dan pengalaman wisata yang tak terlupakan.</p>
    
    <!-- Tombol yang diperbaiki agar tidak hilang/kecil -->
    <a href="#download-section" class="btn-app-download">
        Download Sekarang
    </a>
</div>
        </div>
    </div>
</section>

<section class="download-section" id="download-section">
    <div class="container">
        <div class="download-content">
            <div class="download-text" data-aos="fade-right" data-aos-duration="800">
                <h3>Download APK<br>NGANJUK ABIRUPA</h3>
                <p>Akses informasi wisata secara instan tanpa hambatan administratif. Unduh aplikasi kami sekarang untuk pengalaman menjelajah Nganjuk yang lebih mudah dan aman.</p>
                <a href="#" class="btn-download-solid">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    Unduh Sekarang
                </a>
            </div>
            <div class="download-illustration" data-aos="fade-left" data-aos-duration="800">
                <img src="{{ asset('images/icon/downloadapk.png') }}" alt="Download APK Illustration">
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Kolom 1: Tentang Aplikasi -->
            <div class="footer-about">
                <div class="footer-logo">
                    <div class="logo-icon">N</div>
                    <div class="logo-text">Nganjuk Abirupa</div>
                </div>
                <p>Aplikasi Nganjuk Abirupa hadir sebagai solusi bagi masyarakat untuk menikmati wisata Kota Nganjuk dengan kemudahan informasi pemesanan tiket berbasis online.</p>
            </div>

            <!-- Kolom 2: Menu Utama -->
            <div class="footer-company">
                <h4>Menu Utama</h4>
                <ul class="footer-links">
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#informasi">Informasi</a></li>
                    <li><a href="#riwayat">Destinasi Wisata</a></li> <!-- Id riwayat di kode Anda merujuk ke destinasi -->
                    <li><a href="{{ route('riwayat') }}">Riwayat Pesanan</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Informasi Tiket -->
            <div class="footer-region">
                <h4>Informasi Tiket</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('informasi.harga') }}">Harga Tiket</a></li>
                    <li><a href="{{ route('informasi.cara-pesan') }}">Cara Pesan Tiket</a></li>
                    <li><a href="{{ route('informasi.pesan') }}">Pesan Tiket Wisata</a></li>
                </ul>
            </div>

            <!-- Kolom 4: Bantuan & Aplikasi -->
            <div class="footer-help">
                <h4>Bantuan & Aplikasi</h4>
                <ul class="footer-links">
                    <li><a href="#download-section">Download APK</a></li>
                    <li><a href="#" onclick="openModal()">Masuk / Login</a></li>                
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>Tentang Kami - Aplikasi Nganjuk Abirupa | © 2026 All Rights Reserved</p>
        </div>
    </div>
</footer>

    <!-- ============ LOGIN MODAL ============ -->
    <div class="modal-overlay" id="loginModal">
        <div class="modal">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <h2>Masuk ke Akun</h2>
            <p class="subtitle">Silakan login untuk mengakses fitur lengkap</p>
            <form id="formLoginBeranda" action="#">
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

<button class="scroll-top" id="scrollTop" onclick="scrollToTop()">↑</button>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    // ===== INIT AOS ANIMATION =====
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 100,
        mirror: false
    });

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
            document.getElementById('dropdownToggle').parentElement.classList.remove('open');
        }
    }

    // Toggle dropdown di mobile saat di-klik
    document.getElementById('dropdownToggle').addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            e.preventDefault();
            e.stopPropagation();
            this.parentElement.classList.toggle('open');
        }
    });

    // Tutup menu saat link diklik (kecuali dropdown toggle)
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', (e) => {
            // PERBAIKAN: Cegah aksi default jika klik menu "Informasi Tiket" agar dropdown tidak hilang
            if (link.id === 'dropdownToggle') {
                e.preventDefault();
                return;
            }
            
            // Tutup menu jika klik selain tombol dropdown
            document.getElementById('mobileMenu').classList.remove('active');
            document.getElementById('dropdownToggle').parentElement.classList.remove('open');
        });
    });

    // Menangani form login
    document.getElementById('formLoginBeranda').addEventListener('submit', async function(e) {
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
                if (btn) { btn.disabled = false; btn.textContent = 'Login'; }
            }
        } catch(err) {
            alert('❌ Gagal menghubungi server.');
            if (btn) { btn.disabled = false; btn.textContent = 'Login'; }
        }
    });

    // ===== ACTIVE NAV LINK =====
    const sections = document.querySelectorAll('section[id]');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            if (scrollY >= sectionTop) current = section.getAttribute('id');
        });
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) link.classList.add('active');
        });
    });

    // ===== MODAL =====
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

    // ===== SCROLL TO TOP =====
    const scrollTopBtn = document.getElementById('scrollTop');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 500) scrollTopBtn.classList.add('visible');
        else scrollTopBtn.classList.remove('visible');
    });
    function scrollToTop() { window.scrollTo({ top: 0, behavior: 'smooth' }); }

    // ===== PAGINATION DOTS =====
    

    // ===== SMOOTH SCROLL =====
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                window.scrollTo({ top: target.offsetTop - 70, behavior: 'smooth' });
            }
        });
    });

    // ===== PHP LOGIN MESSAGE =====
    <?php if (isset($login_message)): ?>
        alert('<?php echo $login_message; ?>');
    <?php endif; ?>

    document.querySelector('.btn-download').addEventListener('click', (e) => {
        e.preventDefault();
        alert('Download APK Nganjuk Abirupa akan segera tersedia!');
    });

    console.log('🌿 Nganjuk Abirupa Loaded with AOS Animations! ✨');
</script>
</body>
</html>