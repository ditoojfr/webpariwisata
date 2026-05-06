<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Riwayat Transaksi - Nganjuk Abirupa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      /* Colors */
      --primary-green: #4CAF50;
      --dark-green: #2E7D32;
      --white: #ffffff;
      
      /* Backgrounds */
      --panel: #f8fafc;
      --nav-bg: #e8ecf1;
      
      /* Text */
      --text: #0f172a;
      --muted: #64748b;
      
      /* UI */
      --border: #e2e8f0;
      --shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
      --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.2);
      
      /* Radius */
      --radius-sm: 8px;
      --radius-md: 10px;
      --radius-lg: 12px;
      --radius-xl: 16px;
      --radius-pill: 52px;
      
      /* Transitions */
      --transition-fast: 0.2s ease;
      --transition-normal: 0.3s ease;
    }

    *, *::before, *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--panel);
      color: var(--text);
      line-height: 1.5;
      -webkit-font-smoothing: antialiased;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    img {
      max-width: 100%;
      height: auto;
      display: block;
    }

    button {
      font-family: inherit;
      cursor: pointer;
      border: none;
      background: none;
    }

    /* ==========================================================================
      2. LAYOUT & CONTAINER
      ========================================================================== */
    .wrap {
      width: 92%;
      max-width: 1100px;
      margin: 0 auto;
      padding-top: 24px;
      padding-bottom: 40px;
    }

    /* ==========================================================================
      3. NAVBAR
      ========================================================================== */
    .nav {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: var(--nav-bg);
      border-radius: var(--radius-pill);
      padding: 14px 28px;
      box-shadow: var(--shadow);
      position: relative;
      z-index: 50;
    }

    .nav .logo img {
      height: 40px;
      width: auto;
    }

    .nav .menu-container {
      flex: 1;
      display: flex;
      justify-content: center;
    }

    .nav .menu {
      display: flex;
      gap: 36px;
      align-items: center;
      list-style: none;
    }

    .nav .menu > li {
      position: relative;
    }

    .nav .menu a {
      font-weight: 600;
      color: #475569;
      transition: color var(--transition-fast);
      padding: 4px 0;
    }

    .nav .menu a:hover,
    .nav .menu a.active {
      color: var(--text);
    }

    .nav .menu a.active::after {
      content: "";
      position: absolute;
      bottom: -14px;
      left: 0;
      width: 100%;
      height: 4px;
      border-radius: 4px;
      background: #fbbf24;
    }

    /* Dropdown Menu */
    .nav .dropdown-menu {
      position: absolute;
      top: 100%;
      left: 50%;
      transform: translateX(-50%) translateY(10px);
      background: var(--white);
      min-width: 210px;
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-lg);
      padding: 8px 0;
      opacity: 0;
      visibility: hidden;
      transition: all var(--transition-normal);
      z-index: 100;
      list-style: none;
    }

    .nav .dropdown:hover .dropdown-menu {
      opacity: 1;
      visibility: visible;
      transform: translateX(-50%) translateY(0);
    }

    .nav .dropdown-menu li a {
      display: block;
      padding: 10px 20px;
      font-size: 14px;
      font-weight: 500;
      white-space: nowrap;
      transition: all var(--transition-fast);
    }

    .nav .dropdown-menu li a:hover {
      background: #f0fdf4;
      color: var(--primary-green);
      padding-left: 24px;
    }

    /* Login Button */
    .nav .icons {
      display: flex;
      gap: 12px;
    }

    .nav .btn-login {
      padding: 10px 32px;
      border: 2px solid var(--primary-green);
      border-radius: 25px;
      color: var(--primary-green);
      font-weight: 600;
      background: transparent;
      transition: all var(--transition-normal);
      display: inline-block;
    }

    .nav .btn-login:hover {
      background: var(--primary-green);
      color: var(--white);
      transform: translateY(-2px);
    }

    /* ==========================================================================
      4. PAGE HEADER
      ========================================================================== */
    .riwayat-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 32px 0 24px;
      flex-wrap: wrap;
      gap: 16px;
    }

    .riwayat-title {
      font-size: 26px;
      font-weight: 800;
      color: var(--text);
    }

    .back-btn {
      background: var(--primary-green);
      color: var(--white);
      padding: 9px 18px;
      border-radius: var(--radius-md);
      font-weight: 600;
      font-size: 14px;
      transition: all var(--transition-fast);
    }

    .back-btn:hover {
      background: var(--dark-green);
      transform: translateY(-2px);
    }

    /* ==========================================================================
      5. SEARCH BOX
      ========================================================================== */
    .search-box {
      background: var(--white);
      border-radius: var(--radius-xl);
      padding: 20px;
      margin-bottom: 24px;
      box-shadow: var(--shadow);
      display: flex;
      gap: 12px;
      align-items: center;
      flex-wrap: wrap;
    }

    .search-group {
      flex: 1;
      min-width: 200px;
    }

    .search-group label {
      display: block;
      font-size: 12px;
      font-weight: 600;
      color: var(--muted);
      margin-bottom: 6px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .search-group input {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid var(--border);
      border-radius: var(--radius-md);
      font-size: 14px;
      font-family: inherit;
      transition: border-color var(--transition-fast);
    }

    .search-group input:focus {
      outline: none;
      border-color: var(--primary-green);
    }

    .search-group input::placeholder {
      color: var(--muted);
    }

    .search-hint {
      font-size: 11px;
      color: var(--muted);
      margin-top: 8px;
      padding-left: 4px;
    }

    .search-result-info {
      font-size: 13px;
      color: var(--muted);
      margin-bottom: 16px;
      display: none;
    }

    .search-result-info.show {
      display: block;
    }

    /* Search Buttons */
    .btn-cari,
    .btn-reset {
      padding: 12px 24px;
      border-radius: var(--radius-md);
      font-weight: 600;
      font-size: 14px;
      transition: all var(--transition-fast);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .btn-cari {
      background: var(--primary-green);
      color: var(--white);
    }

    .btn-cari:hover {
      background: var(--dark-green);
      transform: translateY(-2px);
    }

    .btn-cari:disabled {
      background: #94a3b8;
      cursor: not-allowed;
      transform: none;
    }

    .btn-reset {
      background: var(--white);
      color: var(--text);
      border: 2px solid var(--border);
    }

    .btn-reset:hover {
      background: #f1f5f9;
      border-color: var(--muted);
    }

    /* ==========================================================================
      6. LOADING & EMPTY STATES
      ========================================================================== */
    .loading {
      text-align: center;
      padding: 40px;
      color: var(--muted);
      font-size: 14px;
    }

    .loading .spinner {
      width: 24px;
      height: 24px;
      border: 3px solid var(--border);
      border-top-color: var(--primary-green);
      border-radius: 50%;
      animation: spin 1s linear infinite;
      margin: 0 auto 12px;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    .empty-state {
      text-align: center;
      padding: 60px 20px;
    }

    .empty-state .icon-big {
      font-size: 48px;
      margin-bottom: 16px;
      display: block;
    }

    .empty-state p {
      color: var(--muted);
      margin-bottom: 8px;
    }

    .empty-state .btn-jelajah {
      display: inline-block;
      margin-top: 16px;
      background: var(--primary-green);
      color: var(--white);
      padding: 10px 24px;
      border-radius: var(--radius-md);
      font-weight: 600;
      transition: all var(--transition-fast);
    }

    .empty-state .btn-jelajah:hover {
      background: var(--dark-green);
      transform: translateY(-2px);
    }

    /* ==========================================================================
      7. DATA TABLE
      ========================================================================== */
    .riwayat-table {
      width: 100%;
      background: var(--white);
      border-radius: var(--radius-xl);
      overflow: hidden;
      box-shadow: var(--shadow);
    }

    .riwayat-table table {
      width: 100%;
      border-collapse: collapse;
    }

    .riwayat-table th {
      background: #f8fafc;
      padding: 14px 18px;
      text-align: left;
      font-size: 13px;
      color: #64748b;
      font-weight: 600;
      border-bottom: 1px solid var(--border);
    }

    .riwayat-table td {
      padding: 14px 18px;
      font-size: 14px;
      border-bottom: 1px solid var(--border);
      vertical-align: middle;
      color: #334155;
    }

    .riwayat-table tr:last-child td {
      border-bottom: none;
    }

    .riwayat-table tr {
      cursor: pointer;
      transition: background var(--transition-fast);
    }

    .riwayat-table tr:hover {
      background: #f0fdf4;
    }

    .status-badge {
      display: inline-block;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      background: #d1fae5;
      color: #065f46;
    }

    /* ==========================================================================
      8. MODAL POPUP
      ========================================================================== */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1000;
      opacity: 0;
      visibility: hidden;
      transition: all var(--transition-normal);
      padding: 20px;
    }

    .modal-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .modal-container {
      background: var(--white);
      border-radius: 20px;
      max-width: 500px;
      width: 100%;
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: var(--shadow-lg);
      transform: scale(0.9);
      transition: transform var(--transition-normal);
    }

    .modal-overlay.active .modal-container {
      transform: scale(1);
    }

    /* Modal Header */
    .modal-header {
      background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
      color: var(--white);
      padding: 20px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 20px 20px 0 0;
    }

    .modal-header h3 {
      font-size: 18px;
      font-weight: 700;
      margin: 0;
    }

    .modal-close {
      color: var(--white);
      font-size: 24px;
      padding: 4px 8px;
      border-radius: var(--radius-sm);
      transition: background var(--transition-fast);
      line-height: 1;
    }

    .modal-close:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    /* Modal Body */
    .modal-body {
      padding: 24px;
    }

    .modal-section {
      margin-bottom: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid var(--border);
    }

    .modal-section:last-child {
      margin-bottom: 0;
      padding-bottom: 0;
      border-bottom: none;
    }

    .modal-section-title {
      font-size: 14px;
      font-weight: 600;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 12px;
    }

    /* Detail Rows */
    .detail-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 0;
      font-size: 14px;
    }

    .detail-row .label {
      color: var(--muted);
      font-weight: 500;
    }

    .detail-row .value {
      color: var(--text);
      font-weight: 600;
      text-align: right;
    }

    .detail-row.total {
      padding-top: 12px;
      margin-top: 12px;
      border-top: 2px solid var(--border);
      font-size: 16px;
    }

    .detail-row.total .label {
      color: var(--text);
    }

    .detail-row.total .value {
      color: var(--primary-green);
      font-size: 18px;
    }

    /* Modal Footer */
    .modal-footer {
      padding: 16px 24px 24px;
      display: flex;
      gap: 12px;
    }

    .btn-modal {
      flex: 1;
      padding: 12px;
      border-radius: var(--radius-md);
      font-weight: 600;
      font-size: 14px;
      transition: all var(--transition-fast);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-primary {
      background: var(--primary-green);
      color: var(--white);
    }

    .btn-primary:hover {
      background: var(--dark-green);
      transform: translateY(-2px);
    }

    .btn-secondary {
      background: var(--white);
      color: var(--text);
      border: 2px solid var(--border);
    }

    .btn-secondary:hover {
      background: #f1f5f9;
      border-color: var(--muted);
    }

    /* ==========================================================================
      9. FOOTER
      ========================================================================== */
    .footer {
      text-align: center;
      color: var(--white);
      font-size: 13px;
      font-weight: 500;
      padding: 20px 0;
      margin-top: 40px;
      background: var(--primary-green);
      border-radius: 12px;
    }

    /* ==========================================================================
      10. RESPONSIVE DESIGN
      ========================================================================== */
    @media (max-width: 768px) {
      /* Navbar */
      .nav .menu {
        gap: 20px;
      }
      
      .nav .btn-login {
        padding: 8px 20px;
        font-size: 13px;
      }
      
      /* Search Box */
      .search-box {
        flex-direction: column;
        align-items: stretch;
      }
      
      .search-group {
        min-width: 100%;
      }
      
      .btn-cari,
      .btn-reset {
        width: 100%;
        justify-content: center;
      }
      
      /* Table - Card View */
      .riwayat-table table,
      .riwayat-table thead,
      .riwayat-table tbody,
      .riwayat-table th,
      .riwayat-table td,
      .riwayat-table tr {
        display: block;
      }
      
      .riwayat-table thead tr {
        display: none;
      }
      
      .riwayat-table td {
        padding: 12px 18px;
        border: none;
        border-bottom: 1px solid var(--border);
      }
      
      .riwayat-table td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #64748b;
        font-size: 12px;
        display: block;
        margin-bottom: 4px;
        text-transform: uppercase;
      }
      
      .riwayat-table tr {
        border-bottom: 1px solid var(--border);
      }
      
      /* Modal */
      .modal-container {
        margin: 10px;
      }
      
      .detail-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
      }
      
      .detail-row .value {
        text-align: left;
      }
      
      .modal-footer {
        flex-direction: column;
      }
      
      .btn-modal {
        width: 100%;
      }
    }

    /* ==========================================================================
      11. UTILITIES & ACCESSIBILITY
      ========================================================================== */
    /* Focus states for accessibility */
    a:focus,
    button:focus,
    input:focus {
      outline: 2px solid var(--primary-green);
      outline-offset: 2px;
    }

    /* Reduce motion for users who prefer it */
    @media (prefers-reduced-motion: reduce) {
      *,
      *::before,
      *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
      
      html {
        scroll-behavior: auto;
      }
    }

    /* Print styles */
    @media print {
      .nav,
      .search-box,
      .footer,
      .modal-overlay {
        display: none !important;
      }
      
      body {
        background: var(--white);
        color: var(--text);
      }
      
      .wrap {
        width: 100%;
        max-width: none;
        padding: 0;
      }
      
      .riwayat-table {
        box-shadow: none;
        border: 1px solid var(--border);
      }
    }
  </style>
</head>
<body>
  <div class="wrap">
    <!-- NAVBAR -->
    <nav class="nav">
      <a class="logo" href="{{ route('beranda') }}">
        <img src="{{ asset('images/logo-abirupa.png') }}" alt="Nganjuk Abirupa" />
      </a>
      <div class="menu-container">
        <ul class="menu">
          <li><a href="{{ route('beranda') }}">Beranda</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle">Informasi Tiket ▾</a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('informasi.harga') }}">Harga Tiket</a></li>
              <li><a href="{{ route('informasi.cara-pesan') }}">Cara Pesan Tiket</a></li>
              <li><a href="{{ route('informasi.pesan') }}">Pesan Tiket Wisata</a></li>
            </ul>
          </li>
          <li><a href="{{ route('riwayat') }}" class="active">Riwayat</a></li>
        </ul>
      </div>
      <div class="icons">
        <a class="btn-login" href="{{ route('beranda') }}">Login</a>
      </div>
    </nav>

    <!-- HEADER -->
    <div class="riwayat-header">
      <div class="riwayat-title">Riwayat Transaksi</div>
    </div>

    <!-- ========== SEARCH BOX ========== -->
    <div class="search-box">
      <div class="search-group">
        <label for="searchEmail">Email atau No. HP</label>
        <input type="text" id="searchEmail" placeholder="Masukkan email atau nomor telepon">
        <div class="search-hint">Contoh: user@email.com atau 081234567890</div>
      </div>
      <button class="btn-cari" id="btnCari" onclick="cariRiwayat()">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"></circle>
          <path d="M21 21l-4.35-4.35"></path>
        </svg>
        <span id="btnCariText">Cari Riwayat</span>
      </button>
      <button class="btn-reset" onclick="resetCari()">Reset</button>
    </div>

    <!-- Search Result Info -->
    <div class="search-result-info" id="searchResultInfo"></div>

    <!-- TABLE CONTAINER -->
    <div class="riwayat-table" id="riwayatContainer">
      <div class="loading">
        <div class="spinner"></div>
        Memuat data dari database...
      </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">© 2026 Nganjuk Abirupa – Disporabudpar Nganjuk. All rights reserved.</div>
  </div>

  <!-- ========== MODAL POPUP DETAIL ========== -->
  <div class="modal-overlay" id="detailModal" onclick="closeModal(event)">
    <div class="modal-container" onclick="event.stopPropagation()">
      <div class="modal-header">
        <h3>📋 Detail Pemesanan</h3>
        <button class="modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="modal-body">
        <!-- Nomor Pemesanan & Wisata -->
        <div class="modal-section">
          <div class="modal-section-title">Informasi Pemesanan</div>
          <div class="detail-row">
            <span class="label">Nomor Pemesanan</span>
            <span class="value" id="modal-nomor">#NGJ-</span>
          </div>
          <div class="detail-row">
            <span class="label">Destinasi Wisata</span>
            <span class="value" id="modal-wisata">-</span>
          </div>
          <div class="detail-row">
            <span class="label">Tanggal Kunjungan</span>
            <span class="value" id="modal-tanggal">-</span>
          </div>
        </div>

        <!-- Data Customer -->
        <div class="modal-section">
          <div class="modal-section-title">Data Pemesan</div>
          <div class="detail-row">
            <span class="label">Nama Lengkap</span>
            <span class="value" id="modal-nama">-</span>
          </div>
          <div class="detail-row">
            <span class="label">Email</span>
            <span class="value" id="modal-email">-</span>
          </div>
          <div class="detail-row">
            <span class="label">No. Telepon</span>
            <span class="value" id="modal-telepon">-</span>
          </div>
        </div>

        <!-- Detail Tiket -->
        <div class="modal-section">
          <div class="modal-section-title">Detail Tiket</div>
          <div class="detail-row">
            <span class="label">Jumlah Pengunjung</span>
            <span class="value" id="modal-pengunjung">-</span>
          </div>
          <div class="detail-row">
            <span class="label">Metode Pembayaran</span>
            <span class="value">QRIS</span>
          </div>
          <div class="detail-row">
            <span class="label">Status</span>
            <span class="value" style="color: var(--primary-green); font-weight: 600;">✓ Lunas</span>
          </div>
          <div class="detail-row total">
            <span class="label">Total Pembayaran</span>
            <span class="value" id="modal-total">Rp 0</span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn-modal btn-secondary" onclick="closeModal()">
          Tutup
        </button>
        <button class="btn-modal btn-primary" onclick="downloadDetail()">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
            <polyline points="7 10 12 15 17 10"></polyline>
            <line x1="12" y1="15" x2="12" y2="3"></line>
          </svg>
          Simpan Detail
        </button>
      </div>
    </div>
  </div>

  <script>
    // === FORMAT RUPIAH ===
    function formatRupiah(angka) {
      if (!angka) return 'Rp 0';
      return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
    }

    // === FORMAT TANGGAL ===
    function formatTanggal(tanggalStr) {
      if (!tanggalStr) return '-';
      const tgl = new Date(tanggalStr);
      return tgl.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    }

    // === FORMAT TANGGAL SHORT ===
    function formatTanggalShort(tanggalStr) {
      if (!tanggalStr) return '-';
      const tgl = new Date(tanggalStr);
      return tgl.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
    }

    // === FETCH DATA DARI DATABASE ===
    async function fetchRiwayat(keyword = '') {
      const container = document.getElementById('riwayatContainer');
      const btnCari = document.getElementById('btnCari');
      const btnCariText = document.getElementById('btnCariText');
      
      container.innerHTML = `
        <div class="loading">
          <div class="spinner"></div>
          Mengambil data...
        </div>
      `;
      
      btnCari.disabled = true;
      btnCariText.textContent = 'Memproses...';
      
      try {
        const response = await fetch(`/riwayat/cari?keyword=${encodeURIComponent(keyword)}`, {
          method: 'GET',
          headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
        });
        
        const result = await response.json();
        
        if (result.success) {
          renderTabel(result.data, keyword !== '');
          
          const resultInfo = document.getElementById('searchResultInfo');
          if (keyword) {
            if (result.data.length > 0) {
              resultInfo.textContent = `✅ Ditemukan ${result.total} transaksi untuk "${keyword}"`;
            } else {
              resultInfo.textContent = `❌ Tidak ditemukan transaksi untuk "${keyword}"`;
            }
            resultInfo.classList.add('show');
          } else {
            resultInfo.classList.remove('show');
          }
        } else {
          container.innerHTML = `
            <div class="empty-state">
              <div class="icon-big">⚠️</div>
              <p style="font-size:16px;font-weight:600;color:#dc2626;margin-bottom:8px;">Error</p>
              <p style="font-size:14px;">${result.message || 'Gagal mengambil data'}</p>
              <button onclick="resetCari()" class="btn-jelajah" style="margin-top:16px;">Coba Lagi</button>
            </div>
          `;
        }
      } catch (error) {
        console.error('Fetch error:', error);
        container.innerHTML = `
          <div class="empty-state">
            <div class="icon-big">🔌</div>
            <p style="font-size:16px;font-weight:600;color:#dc2626;margin-bottom:8px;">Koneksi Error</p>
            <p style="font-size:14px;">Periksa koneksi internet atau coba refresh halaman</p>
            <button onclick="location.reload()" class="btn-jelajah" style="margin-top:16px;">Refresh</button>
          </div>
        `;
      } finally {
        btnCari.disabled = false;
        btnCariText.textContent = 'Cari Riwayat';
      }
    }

    // === CARI RIWAYAT ===
    function cariRiwayat() {
      const keyword = document.getElementById('searchEmail').value.trim();
      
      if (!keyword) {
        alert('Silakan masukkan email atau nomor telepon terlebih dahulu');
        return;
      }
      
      fetchRiwayat(keyword);
    }

    // === RESET PENCARIAN ===
    function resetCari() {
      document.getElementById('searchEmail').value = '';
      document.getElementById('searchResultInfo').classList.remove('show');
      document.getElementById('riwayatContainer').innerHTML = `
        <div class="empty-state">
          <div class="icon-big">🔍</div>
          <p style="font-size:16px;font-weight:600;color:#475569;margin-bottom:8px;">Masukkan Email atau No. HP</p>
          <p style="font-size:14px;">Gunakan kolom pencarian di atas untuk melihat riwayat transaksi Anda</p>
        </div>
      `;
    }

    // === RENDER TABEL ===
    function renderTabel(data, isFiltered = false) {
      const container = document.getElementById('riwayatContainer');
      
      if (!data || data.length === 0) {
        if (isFiltered) {
          container.innerHTML = `
            <div class="empty-state">
              <div class="icon-big">🔍</div>
              <p style="font-size:16px;font-weight:600;color:#475569;margin-bottom:8px;">Tidak ada hasil ditemukan</p>
              <p style="font-size:14px;">Coba periksa kembali email atau nomor telepon yang dimasukkan</p>
              <button onclick="resetCari()" class="btn-jelajah" style="margin-top:16px;">Cari Lagi</button>
            </div>
          `;
        } else {
          container.innerHTML = `
            <div class="empty-state">
              <div class="icon-big">📋</div>
              <p style="font-size:16px;font-weight:600;color:#475569;margin-bottom:8px;">Masukkan Email atau No. HP</p>
              <p style="font-size:14px;">Gunakan kolom pencarian di atas untuk melihat riwayat transaksi Anda</p>
            </div>
          `;
        }
        return;
      }
      
      let html = `<table><thead><tr>
        <th>No</th>
        <th>Wisata</th>
        <th>Tanggal</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Total</th>
        <th>Status</th>
      </tr></thead><tbody>`;
      
      data.forEach((item, index) => {
        const email = item.email || item.telepon || '-';
        // Simpan data lengkap di attribute data-json untuk modal
        const dataJson = encodeURIComponent(JSON.stringify(item));
        
        html += `
          <tr onclick="bukaDetail('${dataJson}')">
            <td data-label="No">${index + 1}</td>
            <td data-label="Wisata"><strong>${item.wisata || '-'}</strong></td>
            <td data-label="Tanggal">${formatTanggalShort(item.tanggal)}</td>
            <td data-label="Nama">${item.nama || '-'}</td>
            <td data-label="Email">${email}</td>
            <td data-label="Total"><strong>${formatRupiah(item.total)}</strong></td>
            <td data-label="Status"><span class="status-badge">${item.status || 'Lunas'}</span></td>
          </tr>
        `;
      });
      
      html += `</tbody></table>`;
      container.innerHTML = html;
    }

    // === BUKA MODAL DETAIL ===
    function bukaDetail(dataJson) {
      const data = JSON.parse(decodeURIComponent(dataJson));
      
      // Isi modal dengan data
      document.getElementById('modal-nomor').textContent = data.nomor || '#NGJ-' + data.id;
      document.getElementById('modal-wisata').textContent = data.wisata || '-';
      document.getElementById('modal-tanggal').textContent = formatTanggal(data.tanggal);
      document.getElementById('modal-nama').textContent = data.nama || '-';
      document.getElementById('modal-email').textContent = data.email || '-';
      document.getElementById('modal-telepon').textContent = data.telepon || '-';
      document.getElementById('modal-pengunjung').textContent = `${data.jml_tiket || 0} Orang`;
      document.getElementById('modal-total').textContent = formatRupiah(data.total);
      
      // Tampilkan modal
      document.getElementById('detailModal').classList.add('active');
      document.body.style.overflow = 'hidden'; // Disable scroll background
    }

    // === TUTUP MODAL ===
    function closeModal(event) {
      // Tutup jika klik overlay, bukan jika klik di dalam modal
      if (!event || event.target.id === 'detailModal') {
        document.getElementById('detailModal').classList.remove('active');
        document.body.style.overflow = ''; // Enable scroll kembali
      }
    }

    // === DOWNLOAD DETAIL (Opsional) ===
    function downloadDetail() {
      const nomor = document.getElementById('modal-nomor').textContent;
      const wisata = document.getElementById('modal-wisata').textContent;
      const nama = document.getElementById('modal-nama').textContent;
      const tanggal = document.getElementById('modal-tanggal').textContent;
      const total = document.getElementById('modal-total').textContent;
      
      const text = `
        === DETAIL PEMESANAN - NGANJUK ABIRUPA ===
        Nomor: ${nomor}
        Wisata: ${wisata}
        Tanggal: ${tanggal}
        Nama: ${nama}
        Total: ${total}
        Status: Lunas
        ==========================================
      `.trim();
      
      const blob = new Blob([text], { type: 'text/plain' });
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = `Detail-${nomor}.txt`;
      a.click();
      URL.revokeObjectURL(url);
      
      alert('✅ Detail pemesanan berhasil diunduh!');
    }

    // === ENTER KEY SUPPORT ===
    document.getElementById('searchEmail').addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        cariRiwayat();
      }
    });

    // === ESC KEY TO CLOSE MODAL ===
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeModal();
      }
    });

    // === INIT ===
    document.addEventListener('DOMContentLoaded', () => {
      document.getElementById('riwayatContainer').innerHTML = `
        <div class="empty-state">
          <div class="icon-big">🔍</div>
          <p style="font-size:16px;font-weight:600;color:#475569;margin-bottom:8px;">Cari Riwayat Transaksi</p>
          <p style="font-size:14px;">Masukkan email atau nomor telepon Anda di kolom pencarian</p>
        </div>
      `;
    });
  </script>
</body>
</html>