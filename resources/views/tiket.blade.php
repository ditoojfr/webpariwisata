<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Anda - Nganjuk Abirupa</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* ============ BASE & VARIABLES ============ */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-green: #4CAF50;
            --dark-green: #2E7D32;
            --bg-light: #f5faf5;
            --text-dark: #333;
            --text-gray: #666;
            --light-gray: #f0f0f0;
        }
        body { 
            font-family: 'Poppins', sans-serif; 
            color: var(--text-dark); 
            background: var(--bg-light); 
        }

        /* ============ SUCCESS HEADER ============ */
        .success-header {
            text-align: center;
            padding: 40px 20px 30px;
        }

        .success-icon {
            width: 70px;
            height: 70px;
            background: #dcfce7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .success-icon svg {
            width: 40px;
            height: 40px;
            color: var(--primary-green);
        }

        .success-header h1 {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-green);
            margin-bottom: 8px;
        }

        .success-header p {
            color: var(--text-gray);
            font-size: 14px;
        }

        /* ============ MAIN CONTAINER ============ */
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px 40px;
        }

        /* ============ TICKET BOX ============ */
        .ticket-box {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .ticket-box h2 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 25px;
            color: var(--text-dark);
        }

        /* ============ TICKET CONTENT ============ */
        .ticket-content {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 30px;
            margin-bottom: 25px;
        }

        /* ============ TICKET DESIGN ============ */
        .ticket-preview {
            background: white;
            border: 2px dashed #d1fae5;
            border-radius: 12px;
            padding: 20px;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .ticket-design {
            width: 100%;
            max-width: 500px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .ticket-header {
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            color: white;
            padding: 25px 20px;
            text-align: center;
        }

        .ticket-logo img {
            height: 50px;
            margin-bottom: 10px;
            filter: brightness(0) invert(1);
        }

        .ticket-header h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: 2px;
        }

        .ticket-header p {
            font-size: 13px;
            opacity: 0.9;
        }

        .ticket-body {
            display: flex;
            padding: 25px;
            gap: 20px;
            background: #f9fafb;
        }

        .ticket-info {
            flex: 1;
        }

        .info-row {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            display: block;
            font-size: 12px;
            color: var(--text-gray);
            margin-bottom: 4px;
            font-weight: 500;
        }

        .info-value {
            display: block;
            font-size: 14px;
            color: var(--text-dark);
            font-weight: 600;
        }

        .ticket-qr {
            text-align: center;
            padding: 15px;
            background: white;
            border-radius: 8px;
            min-width: 120px;
        }

        .ticket-qr img {
            width: 120px;
            height: 120px;
            margin-bottom: 8px;
        }

        .ticket-qr p {
            font-size: 11px;
            color: var(--text-gray);
            font-weight: 500;
        }

        .ticket-footer {
            background: #f0fdf4;
            padding: 15px;
            text-align: center;
            border-top: 2px dashed var(--primary-green);
        }

        .ticket-footer p {
            font-size: 13px;
            color: var(--dark-green);
            font-weight: 500;
        }

        /* Ticket Stub (Bagian Hijau di Kanan) */
        .ticket-design::after {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 60px;
            background: linear-gradient(135deg, #bbf7d0, #86efac);
            border-left: 2px dashed white;
            z-index: 1;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .ticket-body {
                flex-direction: column;
            }
            
            .ticket-qr {
                min-width: auto;
            }
            
            .ticket-design::after {
                display: none;
            }
        }

        /* Download Button Animation */
        .btn-download.downloading {
            opacity: 0.7;
            pointer-events: none;
        }

        .btn-download.downloading::after {
            content: '';
            width: 18px;
            height: 18px;
            border: 2px solid white;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ============ ORDER DETAILS ============ */
        .details-section h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--text-dark);
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid var(--light-gray);
            font-size: 13px;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-item .label {
            color: var(--text-gray);
            font-weight: 500;
        }

        .detail-item .value {
            color: var(--text-dark);
            font-weight: 600;
            text-align: right;
        }

        /* ============ INFO BOX ============ */
        .info-box {
            background: #f0fdf4;
            border-left: 4px solid var(--primary-green);
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }

        .info-box h4 {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 10px;
        }

        .info-box ul {
            list-style: none;
            padding: 0;
        }

        .info-box ul li {
            font-size: 12px;
            color: var(--text-gray);
            margin-bottom: 5px;
            padding-left: 15px;
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

        /* ============ BACK BUTTON ============ */
        .back-box {
            text-align: center;
            margin-top: 20px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            color: var(--text-dark);
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            border: 2px solid var(--light-gray);
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-back:hover {
            border-color: var(--primary-green);
            color: var(--primary-green);
            transform: translateY(-2px);
        }

        .btn-back svg {
            width: 18px;
            height: 18px;
        }

        /* ============ FOOTER ============ */
        .footer {
            background: var(--primary-green);
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            margin-top: 40px;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 768px) {
            .ticket-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- SUCCESS HEADER -->
    <div class="success-header">
        <div class="success-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h1>Pembayaran Berhasil!</h1>
        <p>Terima kasih! Pembayaran Anda telah berhasil diproses.</p>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="container">
        
        <!-- TICKET BOX -->
        <div class="ticket-box">
            <h2>E-Ticket Anda</h2>
            
            <div class="ticket-content">
                <!-- Ticket Preview -->
                <div class="ticket-preview" id="ticketPreview">
                    <div class="ticket-design">
                        <!-- Ticket Header -->
                        <div class="ticket-header">
                            <div class="ticket-logo">
                                <img src="{{ asset('images/logo-abirupa.png') }}" alt="Nganjuk Abirupa">
                            </div>
                            <h3>E-TICKET</h3>
                            <p>Nganjuk Abirupa</p>
                        </div>

                        <!-- Ticket Body -->
                        <div class="ticket-body">
                            <div class="ticket-info">
                                <div class="info-row">
                                    <span class="info-label">Destinasi</span>
                                    <span class="info-value" id="ticket-destinasi">Air Terjun Sedudo</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Tanggal</span>
                                    <span class="info-value" id="ticket-tanggal">27 April 2026</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Pengunjung</span>
                                    <span class="info-value" id="ticket-pengunjung">2 Dewasa, 1 Anak</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Nomor Tiket</span>
                                    <span class="info-value" id="ticket-nomor">#NGJ-62567727</span>
                                </div>
                            </div>

                            <!-- QR Code -->
                            <div class="ticket-qr">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=TICKET_NGANJUK_ABIRUPA" alt="QR Code" id="ticketQrCode">
                                <p>Scan di lokasi</p>
                            </div>
                        </div>

                        <!-- Ticket Footer -->
                        <div class="ticket-footer">
                            <p>Terima kasih telah berkunjung</p>
                        </div>
                    </div>
                </div>

                <!-- Download & Details -->
                <div>
                    <div class="download-box">
                        <h3>Unduh Tiket</h3>
                        <p>Simpan e-ticket untuk ditunjukkan di lokasi wisata</p>
                        <button class="btn-download" onclick="downloadTicket()">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Unduh E-Ticket
                        </button>
                    </div>

                    <div class="details-section" style="margin-top: 25px;">
                        <h3>Detail Pemesanan</h3>
                        <div class="detail-item">
                            <span class="label">Nomor Pesanan</span>
                            <span class="value" id="detail-nomor">#NGJ-2026042701</span>
                        </div>
                        <div class="detail-item">
                            <span class="label">No. Telepon</span>
                            <span class="value" id="detail-telepon">08xxxxxxxxxx</span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Metode Pembayaran</span>
                            <span class="value">QRIS</span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Waktu Pembayaran</span>
                            <span class="value" id="detail-waktu">24 Apr 2026, 12:00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <h4>Informasi Penting:</h4>
                <ul>
                    <li>Tunjukkan e-ticket ini kepada petugas di lokasi wisata</li>
                    <li>E-ticket hanya berlaku untuk tanggal yang telah dipilih</li>
                    <li>Tiket tidak dapat digunakan setelah tanggal kunjungan</li>
                </ul>
            </div>
        </div>

        <!-- Back Button -->
        <div class="back-box">
            <a href="{{ route('beranda') }}" class="btn-back">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; 2026 Nganjuk Abirupa - Disporabudpar Nganjuk. All rights reserved.</p>
    </footer>

    <!-- html2canvas Library untuk Download Tiket -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    
    <script>
        // === DOWNLOAD TICKET FUNCTION ===
        function downloadTicket() {
            const btn = document.querySelector('.btn-download');
            const originalBtnContent = btn.innerHTML;
            
            btn.classList.add('downloading');
            btn.innerHTML = 'Mengunduh...';
            
            // Gunakan html2canvas untuk convert HTML ke gambar
            const ticketElement = document.getElementById('ticketPreview');
            
            html2canvas(ticketElement, {
                scale: 2,
                backgroundColor: '#ffffff',
                logging: false,
                useCORS: true
            }).then(canvas => {
                // Convert canvas ke blob
                canvas.toBlob(blob => {
                    const url = URL.createObjectURL(blob);
                    const link = document.createElement('a');
                    const nomorTiket = document.getElementById('ticket-nomor').textContent;
                    
                    link.download = `E-Ticket-${nomorTiket.replace('#', '')}.png`;
                    link.href = url;
                    link.click();
                    
                    URL.revokeObjectURL(url);
                    
                    btn.classList.remove('downloading');
                    btn.innerHTML = originalBtnContent;
                    
                    alert('✅ E-Ticket berhasil diunduh!');
                }, 'image/png');
            }).catch(err => {
                console.error('Error:', err);
                alert('❌ Maaf, terjadi kesalahan saat mengunduh tiket.');
                btn.classList.remove('downloading');
                btn.innerHTML = originalBtnContent;
            });
        }

        // === POPULATE TICKET DATA ===
        window.addEventListener('DOMContentLoaded', function() {
            const tiketData = JSON.parse(localStorage.getItem('tiketData') || '{}');
            
            // Update detail pemesanan
            if (tiketData.nomor) {
                document.getElementById('detail-nomor').textContent = tiketData.nomor;
                document.getElementById('ticket-nomor').textContent = tiketData.nomor;
            }
            
            if (tiketData.telepon) {
                document.getElementById('detail-telepon').textContent = tiketData.telepon;
            }
            
            if (tiketData.waktu) {
                document.getElementById('detail-waktu').textContent = tiketData.waktu;
            }
            
            if (tiketData.destinasi) {
                document.getElementById('ticket-destinasi').textContent = tiketData.destinasi;
            }
            
            if (tiketData.tanggal) {
                // Format tanggal jika perlu
                let tgl = tiketData.tanggal;
                if (tgl && !tgl.includes(' ')) {
                    const date = new Date(tgl);
                    tgl = date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                }
                document.getElementById('ticket-tanggal').textContent = tgl;
            }
            
            if (tiketData.pengunjung) {
                document.getElementById('ticket-pengunjung').textContent = tiketData.pengunjung;
            }
            
            // Generate QR Code unik berdasarkan nomor tiket
            if (tiketData.nomor) {
                const qrData = `TICKET_NGANJUK_ABIRUPA_${tiketData.nomor}`;
                const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=${encodeURIComponent(qrData)}`;
                document.getElementById('ticketQrCode').src = qrUrl;
            }
            
            // Clear localStorage setelah dipakai
            localStorage.removeItem('tiketData');
        });
    </script>
</body>
</html>