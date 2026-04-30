<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Wisata - Nganjuk Abirupa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
*{ box-sizing: border-box; }
body{ margin:0; font-family:'Poppins',sans-serif; background:#f5f6f8; }

/* ===== LAYOUT ===== */
.container{ display:flex; min-height:100vh; }

/* SIDEBAR */
.sidebar {
    width: 220px; background: #eef2ef; min-height: 100vh;
    padding: 20px 15px; position: fixed; left: 0; top: 0;
    transition: all 0.3s ease; z-index: 1000;
}
.logo { display: flex; justify-content: center; margin-bottom: 30px; }
.logo img { width: 100px; }
.menu { display: flex; flex-direction: column; gap: 10px; }
.menu a {
    text-decoration: none; padding: 12px 18px; border-radius: 15px;
    font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 12px;
    color: #333; background: white; transition: all 0.3s ease;
}
.menu a i { font-size: 16px; width: 20px; text-align: center; }
.menu a.active { background: #52C396; color: white; box-shadow: 0 3px 10px rgba(82,195,150,0.3); }
.menu a:hover:not(.active) { transform: translateX(5px); background: #dff5ec; }
.menu a.logout { background: #fee2e2; color: #dc2626; margin-top: 10px; }
.menu a.logout:hover { background: #fecaca; transform: translateX(5px); }

/* ===== MAIN ===== */
.main{
    flex:1;
    margin-left:220px; 
    padding:25px; 
    transition: all 0.3s ease;
}

.title{ font-size:24px; font-weight:700; color:#52C396; margin-bottom:20px; }

.form-box{
    background:white; border-radius:20px; padding:25px; 
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}
.form-box h3{
    text-align:center; margin-bottom:20px; color:#888; font-size:16px; font-weight:500;
}

/* INPUT */
.form-group{ margin-bottom:18px; }
label{ font-weight:600; display:block; margin-bottom:6px; color:#333; font-size:13px; }
input[type="text"], input[type="number"], textarea, input[type="date"]{
    width:100%; padding:10px 12px; border-radius:10px; border:2px solid #e0e0e0;
    font-family:'Poppins',sans-serif; font-size:13px; transition:border-color 0.3s; box-sizing:border-box;
}
input[type="text"]:focus, input[type="number"]:focus, textarea:focus, input[type="date"]:focus{
    outline:none; border-color:#52C396;
}
textarea{ resize:vertical; min-height:80px; }

/* FILE UPLOAD UTAMA */
.upload-container{ margin-top:8px; }
.upload-box{
    border:2px dashed #52C396; border-radius:12px; padding:25px; text-align:center;
    background:#f9fafb; cursor:pointer; transition:all 0.3s; position:relative; overflow:hidden;
}
.upload-box:hover{ background:#e8f5f0; border-color:#45b085; }
.upload-box i{ font-size:36px; color:#52C396; margin-bottom:10px; }
.upload-box p{ margin:5px 0; color:#666; font-size:12px; }
.upload-box .highlight{ color:#52C396; font-weight:600; }
.upload-box input[type="file"]{
    position:absolute; width:100%; height:100%; top:0; left:0; opacity:0; cursor:pointer;
}

/* IMAGE PREVIEW */
.image-preview{ margin-top:15px; display:none; }
.image-preview.active{ display:block; }
.preview-wrapper{ position:relative; display:inline-block; border-radius:12px; overflow:hidden; box-shadow:0 3px 10px rgba(0,0,0,0.1); }
.preview-wrapper img{ max-width:100%; height:auto; display:block; max-height:250px; object-fit:cover; }
.remove-image{
    position:absolute; top:8px; right:8px; background:#ff4757; color:white; border:none;
    border-radius:50%; width:30px; height:30px; cursor:pointer; display:flex; align-items:center; justify-content:center;
    font-size:16px; transition:transform 0.2s;
}
.remove-image:hover{ transform:scale(1.1); }
.image-info{ margin-top:8px; padding:8px; background:#f0f0f0; border-radius:6px; font-size:11px; color:#666; }

/* BUTTON */
.btn-primary{
    background:#52C396; color:white; padding:12px; border:none; border-radius:10px;
    font-weight:600; font-size:14px; cursor:pointer; transition:all 0.3s; font-family:'Poppins',sans-serif;
}
.btn-primary:hover{ background:#45b085; transform:translateY(-2px); box-shadow:0 3px 10px rgba(82,195,150,0.3); }

/* RESPONSIVE */
@media (max-width: 1024px){ .sidebar{ width:200px; } .main{ margin-left:200px; padding:20px; } }
@media (max-width: 768px){
    .sidebar{ transform: translateX(-100%); width: 220px; }
    .sidebar.active{ transform: translateX(0); }
    .main{ margin-left: 0; padding: 15px; }
    .menu-toggle{ display: block; position: fixed; top: 15px; left: 15px; z-index: 1001; background: #52C396; color: white; border: none; border-radius: 8px; width: 45px; height: 45px; cursor: pointer; font-size: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.2); }
    .overlay{ display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 999; }
    .overlay.active{ display: block; }
}
@media (max-width: 480px){ .sidebar{ width: 100%; transform: translateX(-100%); } .menu-toggle{ display: block; } }
</style>
</head>

<body>

<button class="menu-toggle" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

<div class="overlay" onclick="toggleSidebar()"></div>

<div class="container">

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="logo">
        <img src="{{ asset('images/logo-abirupa.png') }}" alt="Nganjuk Abirupa">
    </div>

    <div class="menu">
        <a href="{{ route('admin.beranda') }}">
            <i class="fas fa-home"></i> Beranda
        </a>
        <a href="{{ route('admin.edit') }}" class="active">
            <i class="fas fa-edit"></i> Edit Wisata
        </a>
        <a href="{{ route('admin.profil') }}">
            <i class="fas fa-user"></i> Profil
        </a>
        <a href="#" class="logout" onclick="confirmLogout(event)"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">
    <div class="title">Edit Wisata</div>

    <div class="form-box">
        <h3>Form Edit Wisata</h3>

        {{-- FORM UTAMA WISATA --}}
        <form id="editWisataForm" action="{{ route('admin.wisata.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Nama Wisata</label>
                <input type="text" name="nama_wisata" value="{{ old('nama_wisata', $wisata->nama_wisata ?? '') }}" placeholder="Masukkan nama wisata" required>
            </div>

            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $wisata->lokasi ?? '') }}" placeholder="Masukkan lokasi wisata" required>
            </div>

            <div class="form-group">
                <label>Harga Tiket Dewasa</label>
                <input type="number" name="tiket_dewasa" value="{{ old('tiket_dewasa', $wisata->tiket_dewasa ?? 0) }}" required>
            </div>

            <div class="form-group">
                <label>Harga Tiket Anak</label>
                <input type="number" name="tiket_anak" value="{{ old('tiket_anak', $wisata->tiket_anak ?? 0) }}" required>
            </div>

            <div class="form-group">
                <label>Biaya Asuransi</label>
                <input type="number" name="biaya_asuransi" value="{{ old('biaya_asuransi', $wisata->biaya_asuransi ?? 0) }}">
            </div>

            <div class="form-group">
                <label>Deskripsi Wisata</label>
                <textarea name="deskripsi" placeholder="Deskripsikan wisata ini..." required>{{ old('deskripsi', $wisata->deskripsi ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label>Fasilitas</label>
                <textarea name="fasilitas" placeholder="Fasilitas yang tersedia...">{{ old('fasilitas', $wisata->fasilitas ?? '') }}</textarea>
            </div>

            <!-- GAMBAR UTAMA WISATA -->
            <div class="form-group">
                <label>Gambar Utama Wisata</label>
                <div class="upload-container">
                    <div class="upload-box" id="uploadBox">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p><span class="highlight">Klik atau drag</span> untuk upload gambar</p>
                        <p style="font-size:11px;color:#999;">Format: JPG, PNG, Max 5MB</p>
                        <input type="file" name="gambar_utama" id="gambarUtama" accept="image/*">
                    </div>
                    
                    <div class="image-preview" id="previewUtama">
                        <div class="preview-wrapper">
                            <img src="" alt="Preview" id="imgPreview">
                            <button type="button" class="remove-image" onclick="removeImage('utama')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="image-info" id="imageInfo"></div>
                    </div>
                </div>
            </div>

            <!-- GALERI EVENT / AKTIVITAS -->
            <div class="form-group" style="margin-top: 30px;">
                <label style="font-weight: 700; font-size: 14px; margin-bottom: 10px; display: block; border-top: 1px solid #eee; padding-top: 20px;">Galeri Event / Aktivitas</label>
                
                {{-- AREA PREVIEW & HAPUS EVENT YANG SUDAH ADA --}}
                @if(isset($galeri) && count($galeri) > 0)
                    <div style="background: #fff; border: 1px solid #e2e8f0; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
                        <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 10px; font-weight: 600;">Event yang sedang berjalan:</p>
                        <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                            @foreach($galeri as $g)
    @php
        $badge = '';
        if ($g->tgl_selesai) {
            $sekarang = \Carbon\Carbon::now()->startOfDay();
            $selesai = \Carbon\Carbon::parse($g->tgl_selesai)->startOfDay();
            $sisaHari = $sekarang->diffInDays($selesai, false);

            if ($sisaHari < 0) {
                $badge = '<div style="position: absolute; top: 5px; right: 5px; background: #ef4444; color: white; font-size: 9px; padding: 3px 8px; border-radius: 10px; font-weight: bold; z-index: 10;">Berakhir</div>';
            } elseif ($sisaHari <= 3) {
                $badge = '<div style="position: absolute; top: 5px; right: 5px; background: #f59e0b; color: white; font-size: 9px; padding: 3px 8px; border-radius: 10px; font-weight: bold; z-index: 10;">Sisa ' . $sisaHari . ' Hari</div>';
            } else {
                $badge = '<div style="position: absolute; top: 5px; right: 5px; background: #10b981; color: white; font-size: 9px; padding: 3px 8px; border-radius: 10px; font-weight: bold; z-index: 10;">Aktif</div>';
            }
        }
        @endphp

                <div style="flex-shrink: 0; width: 140px;">
                    {{-- Foto dengan Badge --}}
                    <div style="position: relative; margin-bottom: 5px;">
                        <img src="{{ asset('images/destinasi/' . $g->gambar_poster) }}" 
                            alt="Poster Event" 
                            style="width: 100%; height: 90px; object-fit: cover; border-radius: 8px; border: 1.5px solid #52C396;">
                        {!! $badge !!}
                    </div>

                    {{-- Teks Tanggal di Bawah Foto --}}
                    <div style="text-align: center;">
                        <p style="font-size: 10px; margin: 0; color: #475569; font-weight: 600; line-height: 1.2;">
                            @if($g->tgl_mulai && $g->tgl_selesai)
                                {{ \Carbon\Carbon::parse($g->tgl_mulai)->format('d M') }} - {{ \Carbon\Carbon::parse($g->tgl_selesai)->format('d M Y') }}
                            @elseif($g->tgl_selesai)
                                S/d {{ \Carbon\Carbon::parse($g->tgl_selesai)->format('d M Y') }}
                            @else
                                <span style="color: #94a3b8; font-style: italic;">Tanpa Batas</span>
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
                        </div>
                    </div>
                @endif

                {{-- AREA 2: FORM TAMBAH EVENT BARU (DINAMIS) --}}
            <div id="dynamic-event-container">
                <!-- Form Bawaan (Event Baru) -->
                <div class="event-item" style="background: #f0fdf4; border: 1px dashed #52C396; padding: 15px; border-radius: 12px; margin-bottom: 15px;">
                    <div class="preview-group" style="margin-bottom: 10px;">
                        <label style="font-size: 12px; font-weight: 600; color: #166534;">Upload Poster Baru</label>
                        <input type="file" name="gambar_event[]" accept="image/*" onchange="previewDynamicImage(this)" style="width: 100%; padding: 8px; border: 1px solid #bbf7d0; border-radius: 8px; background: white; margin-top: 5px;">
                        <img src="" class="img-preview-dynamic" style="display: none; max-width: 200px; height: auto; border-radius: 8px; border: 2px solid #52C396; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 10px;">
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <div style="flex: 1;">
                            <label style="font-size: 12px; color: #166534;">Tanggal Mulai</label>
                            <input type="date" name="tgl_mulai[]" style="width: 100%; padding: 8px; border: 1px solid #bbf7d0; border-radius: 8px; margin-top: 5px;">
                        </div>
                        <div style="flex: 1;">
                            <label style="font-size: 12px; color: #166534;">Tanggal Selesai</label>
                            <input type="date" name="tgl_selesai[]" style="width: 100%; padding: 8px; border: 1px solid #bbf7d0; border-radius: 8px; margin-top: 5px;">
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOMBOL TAMBAH FORM (Harus di luar container dinamis) --}}
            <button type="button" onclick="tambahFormEvent()" style="width: 100%; font-size: 13px; font-weight: 600; padding: 12px; background: #e2e8f0; color: #475569; border: none; border-radius: 10px; cursor: pointer; transition: all 0.2s; margin-bottom: 25px; margin-top: 10px;">
                <i class="fas fa-plus"></i> Tambah Poster Event Lain
            </button>

            <!-- TOMBOL SIMPAN PERUBAHAN UTAMA -->
            <div style="margin-top: 30px; display: flex; justify-content: center;">
                <button type="submit" class="btn-primary" style="width: 100%; max-width: 400px; padding: 15px; font-size: 16px; border: none; border-radius: 12px; cursor: pointer; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <i class="fas fa-save"></i> Simpan Perubahan Wisata
                </button>
            </div>
        </form>
    </div> 
</div> 

{{-- FORM BAYANGAN UNTUK HAPUS EVENT (Aman di luar form utama) --}}
<form id="form-hapus-poster" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

</div> <!-- Penutup div.container -->

<script>
// Fungsi Sidebar Mobile
function toggleSidebar(){
    document.getElementById('sidebar').classList.toggle('active');
    document.querySelector('.overlay').classList.toggle('active');
}

// Preview Gambar Utama
const gambarUtama = document.getElementById('gambarUtama');
const uploadBox = document.getElementById('uploadBox');
const previewUtama = document.getElementById('previewUtama');
const imgPreview = document.getElementById('imgPreview');
const imageInfo = document.getElementById('imageInfo');

if(gambarUtama) {
    gambarUtama.addEventListener('change', function(e){
        const file = e.target.files[0];
        if(file) previewImage(file);
    });
}

function previewImage(file){
    if(file.size > 5 * 1024 * 1024){ alert('File maksimal 5MB bre!'); return; }
    const reader = new FileReader();
    reader.onload = function(e){
        imgPreview.src = e.target.result;
        previewUtama.classList.add('active');
        uploadBox.style.display = 'none';
        imageInfo.innerHTML = `<strong>File:</strong> ${file.name} (${(file.size/1024/1024).toFixed(2)} MB)`;
    };
    reader.readAsDataURL(file);
}

function removeImage(type){
    if(type === 'utama'){
        gambarUtama.value = '';
        previewUtama.classList.remove('active');
        uploadBox.style.display = 'block';
    }
}

// Konfirmasi Logout
function confirmLogout(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Yakin logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#52C396',
        confirmButtonText: 'Ya, Keluar!'
    }).then((result) => {
        if (result.isConfirmed) window.location.href = "{{ route('admin.logout') }}";
    });
}

// Nambah Form Event Otomatis
// Nambah Form Event Otomatis (+ Fitur Preview)
// Fungsi Preview yang Lebih Akurat
function previewDynamicImage(input) {
    const file = input.files[0];
    // Mencari elemen img terdekat di dalam grup yang sama
    const previewImg = input.closest('.preview-group').querySelector('.img-preview-dynamic');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewImg.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        previewImg.style.display = 'none';
        previewImg.src = '';
    }
}

// Fungsi Tambah Form (Struktur disamakan dengan HTML di atas)
function tambahFormEvent() {
    const container = document.getElementById('dynamic-event-container');
    const htmlForm = `
        <div class="event-item" style="background: #f0fdf4; border: 1px dashed #52C396; padding: 15px; border-radius: 12px; margin-bottom: 15px; position: relative;">
            <button type="button" onclick="this.parentElement.remove()" style="position: absolute; top: -10px; right: -10px; background: #ef4444; color: white; border: none; border-radius: 50%; width: 26px; height: 26px; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-times" style="font-size: 12px;"></i>
            </button>
            <div class="preview-group" style="margin-bottom: 10px;">
                <label style="font-size: 12px; font-weight: 600; color: #166534;">Upload Poster Baru</label>
                <input type="file" name="gambar_event[]" accept="image/*" onchange="previewDynamicImage(this)" style="width: 100%; padding: 8px; border: 1px solid #bbf7d0; border-radius: 8px; background: white; margin-top: 5px;">
                <img src="" class="img-preview-dynamic" style="display: none; max-width: 200px; height: auto; border-radius: 8px; border: 2px solid #52C396; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 10px;">
            </div>
            <div style="display: flex; gap: 15px;">
                <div style="flex: 1;">
                    <label style="font-size: 12px; color: #166534;">Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai[]" style="width: 100%; padding: 8px; border: 1px solid #bbf7d0; border-radius: 8px; margin-top: 5px;">
                </div>
                <div style="flex: 1;">
                    <label style="font-size: 12px; color: #166534;">Tanggal Selesai</label>
                    <input type="date" name="tgl_selesai[]" style="width: 100%; padding: 8px; border: 1px solid #bbf7d0; border-radius: 8px; margin-top: 5px;">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', htmlForm);
}
</script>
</body>
</html>