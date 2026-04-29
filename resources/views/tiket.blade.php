<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket Anda - Nganjuk Abirupa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            width: 100%;
            max-width: 1100px;
        }

        .status-msg {
            text-align: center;
            margin-bottom: 25px;
            color: #10b981;
            font-size: 24px;
            font-weight: 700;
        }

        /* TIKET WRAPPER */
        .ticket-wrapper {
            position: relative;
            width: 100%;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }

        .ticket-image-container {
            position: relative;
            width: 100%;
            line-height: 0; /* Hilangkan celah bawah gambar */
        }

        .ticket-template-bg {
            width: 100%;
            height: auto;
            display: block;
        }

        /* OVERLAY DATA FIELDS */
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
            right: 11%;     /* Posisi horizontal kotak di area biru */
            width: 24%;     /* Lebar kotak putih */
            height: 11%;    /* Tinggi kotak putih */
            background: transparent; /* Transparan agar nempel di background template */
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e3a5f;
            font-weight: 700;
            text-align: center;
            font-size: clamp(12px, 1.2vw, 16px); /* Font responsif */
            padding: 0 10px;
        }

        /* POSISI TOP UNTUK SETIAP KOTAK */
        /* Kamu bisa adjust angka ini (misal 22% jadi 23%) kalau masih geser dikit */
        .field-destinasi { 
            top: 25%; 
        }
        
        .field-nama { 
            top: 40%; 
        }
        
        .field-tanggal { 
            top: 55%; 
        }
        
        .field-pengunjung { 
            top: 70%; 
        }

        /* BUTTONS */
        .actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn {
            padding: 14px 32px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            border: none;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-download {
            background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(30, 58, 95, 0.3);
        }

        .btn-download:hover { transform: translateY(-3px); }

        .btn-home {
            background: white;
            color: #1e3a5f;
            border: 2px solid #1e3a5f;
        }

        .btn-home:hover {
            background: #1e3a5f;
            color: white;
        }

        @media (max-width: 768px) {
            .data-field {
                right: 10%;
                width: 30%;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="status-msg">✅ Pembayaran Berhasil!</div>

        <div class="ticket-wrapper" id="ticketArea">
            <div class="ticket-image-container">
                <!-- GAMBAR TEMPLATE -->
                <img src="{{ asset('images/template-tiket-baru.png.png') }}" 
                     alt="Ticket Template" 
                     class="ticket-template-bg"
                     crossorigin="anonymous">
                
                <!-- AREA TEXT OVERLAY -->
                <div class="ticket-data-overlay">
                    <!-- Kotak 1 -->
                    <div class="data-field field-destinasi" id="text-destinasi"></div>
                    <!-- Kotak 2 -->
                    <div class="data-field field-nama" id="text-nama"></div>
                    <!-- Kotak 3 -->
                    <div class="data-field field-tanggal" id="text-tanggal"></div>
                    <!-- Kotak 4 -->
                    <div class="data-field field-pengunjung" id="text-pengunjung"></div>
                </div>
            </div>
        </div>

        <div class="actions">
            <button class="btn btn-download" onclick="downloadTicket()">
                ⬇️ Unduh E-Ticket
            </button>
            <a href="{{ route('beranda') }}" class="btn btn-home">
                🏠 Ke Beranda
            </a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>
        // === LOAD DATA ===
        window.addEventListener('DOMContentLoaded', () => {
            const data = JSON.parse(localStorage.getItem('tiketData') || '{}');
            
            // Isi text
            document.getElementById('text-destinasi').textContent = data.destinasi || '-';
            document.getElementById('text-nama').textContent = data.nama || '-';
            document.getElementById('text-tanggal').textContent = formatTanggal(data.tanggal);
            document.getElementById('text-pengunjung').textContent = data.pengunjung || '-';
        });

        function formatTanggal(tgl) {
            if (!tgl) return '-';
            return new Date(tgl).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
        }

        // === DOWNLOAD ===
        function downloadTicket() {
            const btn = document.querySelector('.btn-download');
            btn.innerHTML = '⏳ Memproses...';
            
            html2canvas(document.getElementById('ticketArea'), {
                useCORS: true,
                scale: 2,
                backgroundColor: '#ffffff'
            }).then(canvas => {
                const link = document.createElement('a');
                const nama = document.getElementById('text-nama').textContent || 'Tiket';
                link.download = `Tiket-${nama}.png`;
                link.href = canvas.toDataURL('image/png');
                link.click();
                btn.innerHTML = '✅ Selesai';
            });
        }
    </script>
</body>
</html>