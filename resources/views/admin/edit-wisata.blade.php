<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Wisata</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
*{
    box-sizing: border-box;
}

body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:#f5f6f8;
}

/* ===== LAYOUT ===== */
.container{
    display:flex;
    min-height:100vh;
}

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
/* MENU */
.menu{
    display:flex;
    flex-direction:column;
    gap:10px; /* Diperkecil dari 15px */
}

.menu a{
    text-decoration:none;
    padding:12px 18px; /* Diperkecil dari 18px 25px */
    border-radius:15px; /* Diperkecil dari 20px */
    font-weight:600;
    font-size: 14px; /* Diperkecil */
    display:flex;
    align-items:center;
    gap:12px; /* Diperkecil dari 15px */
    color:#333;
    transition:all 0.3s ease;
    background:white;
}

.menu a i{
    font-size:16px; /* Diperkecil dari 20px */
    width:20px;
    text-align:center;
}

.menu a.active{
    background:#52C396;
    color:white;
    box-shadow:0 3px 10px rgba(82,195,150,0.3);
}

.menu a:hover{
    background:#52C396;
    color:white;
    transform:translateX(3px);
}

/* ===== MAIN ===== */
.main{
    flex:1;
    margin-left:220px; /* Disesuaikan dengan sidebar */
    padding:25px; /* Diperkecil dari 40px */
    transition: all 0.3s ease;
}

/* TITLE */
.title{
    font-size:24px; /* Diperkecil dari 32px */
    font-weight:700;
    color:#52C396;
    margin-bottom:20px; /* Diperkecil */
}

/* FORM BOX */
.form-box{
    background:white;
    border-radius:20px; /* Diperkecil dari 25px */
    padding:25px; /* Diperkecil dari 40px */
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

.form-box h3{
    text-align:center;
    margin-bottom:20px; /* Diperkecil dari 30px */
    color:#888;
    font-size:16px; /* Diperkecil dari 18px */
    font-weight:500;
}

/* INPUT */
.form-group{
    margin-bottom:18px; /* Diperkecil dari 25px */
}

label{
    font-weight:600;
    display:block;
    margin-bottom:6px; /* Diperkecil dari 10px */
    color:#333;
    font-size:13px; /* Diperkecil dari 14px */
}

input[type="text"],
input[type="number"],
textarea{
    width:100%;
    padding:10px 12px; /* Diperkecil dari 15px */
    border-radius:10px; /* Diperkecil dari 12px */
    border:2px solid #e0e0e0;
    font-family:'Poppins',sans-serif;
    font-size:13px; /* Diperkecil dari 14px */
    transition:border-color 0.3s;
    box-sizing:border-box;
}

input[type="text"]:focus,
input[type="number"]:focus,
textarea:focus{
    outline:none;
    border-color:#52C396;
}

textarea{
    resize:vertical;
    min-height:80px; /* Diperkecil dari 120px */
}

/* FILE UPLOAD */
.upload-container{
    margin-top:8px;
}

.upload-box{
    border:2px dashed #52C396;
    border-radius:12px; /* Diperkecil dari 15px */
    padding:25px; /* Diperkecil dari 40px */
    text-align:center;
    background:#f9fafb;
    cursor:pointer;
    transition:all 0.3s;
    position:relative;
    overflow:hidden;
}

.upload-box:hover{
    background:#e8f5f0;
    border-color:#45b085;
}

.upload-box.dragover{
    background:#d4f0e4;
    border-color:#52C396;
}

.upload-box i{
    font-size:36px; /* Diperkecil dari 48px */
    color:#52C396;
    margin-bottom:10px;
}

.upload-box p{
    margin:5px 0;
    color:#666;
    font-size:12px; /* Diperkecil dari 14px */
}

.upload-box .highlight{
    color:#52C396;
    font-weight:600;
}

.upload-box input[type="file"]{
    position:absolute;
    width:100%;
    height:100%;
    top:0;
    left:0;
    opacity:0;
    cursor:pointer;
}

/* IMAGE PREVIEW */
.image-preview{
    margin-top:15px;
    display:none;
}

.image-preview.active{
    display:block;
}

.preview-wrapper{
    position:relative;
    display:inline-block;
    border-radius:12px; /* Diperkecil dari 15px */
    overflow:hidden;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.preview-wrapper img{
    max-width:100%;
    height:auto;
    display:block;
    max-height:250px; /* Diperkecil dari 300px */
    object-fit:cover;
}

.remove-image{
    position:absolute;
    top:8px;
    right:8px;
    background:#ff4757;
    color:white;
    border:none;
    border-radius:50%;
    width:30px; /* Diperkecil dari 35px */
    height:30px;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:16px;
    transition:transform 0.2s;
}

.remove-image:hover{
    transform:scale(1.1);
}

.image-info{
    margin-top:8px;
    padding:8px;
    background:#f0f0f0;
    border-radius:6px;
    font-size:11px; /* Diperkecil dari 13px */
    color:#666;
}

/* MULTIPLE IMAGES */
.multiple-images{
    margin-top:15px;
}

.multiple-images label{
    margin-bottom:12px;
}

.images-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(120px, 1fr)); /* Diperkecil dari 150px */
    gap:12px;
    margin-top:12px;
}

.image-item{
    position:relative;
    border-radius:8px;
    overflow:hidden;
    aspect-ratio:1;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

.image-item img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.image-item .remove-btn{
    position:absolute;
    top:5px;
    right:5px;
    background:#ff4757;
    color:white;
    border:none;
    border-radius:50%;
    width:25px; /* Diperkecil dari 28px */
    height:25px;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:12px;
}

/* BUTTON */
.btn-container{
    display:flex;
    gap:12px;
    margin-top:20px;
}

.btn{
    flex:1;
    padding:12px; /* Diperkecil dari 15px */
    border:none;
    border-radius:10px; /* Diperkecil dari 12px */
    font-weight:600;
    font-size:14px; /* Diperkecil dari 16px */
    cursor:pointer;
    transition:all 0.3s;
    font-family:'Poppins',sans-serif;
}

.btn-primary{
    background:#52C396;
    color:white;
}

.btn-primary:hover{
    background:#45b085;
    transform:translateY(-2px);
    box-shadow:0 3px 10px rgba(82,195,150,0.3);
}

.btn-secondary{
    background:#e0e0e0;
    color:#333;
}

.btn-secondary:hover{
    background:#d0d0d0;
}

/* HELPER */
.hint{
    font-size:11px; /* Diperkecil dari 12px */
    color:#888;
    margin-top:4px;
}

/* ===== RESPONSIVE ===== */

/* Tablet */
@media (max-width: 1024px){
    .sidebar{
        width:200px;
    }
    
    .main{
        margin-left:200px;
        padding:20px;
    }
}

/* Mobile Landscape & Small Tablet */
@media (max-width: 768px){
    .sidebar{
        transform: translateX(-100%);
        width: 220px;
    }
    
    .sidebar.active{
        transform: translateX(0);
    }
    
    .main{
        margin-left: 0;
        padding: 15px;
    }
    
    .title{
        font-size: 20px;
    }
    
    .form-box{
        padding: 20px;
    }
    
    /* Hamburger Menu */
    .menu-toggle{
        display: block;
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 1001;
        background: #52C396;
        color: white;
        border: none;
        border-radius: 8px;
        width: 45px;
        height: 45px;
        cursor: pointer;
        font-size: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    
    .overlay{
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 999;
    }
    
    .overlay.active{
        display: block;
    }
}

/* Mobile Portrait */
@media (max-width: 480px){
    .sidebar{
        width: 100%;
        transform: translateX(-100%);
    }
    
    .sidebar.active{
        transform: translateX(0);
    }
    
    .main{
        padding: 12px;
    }
    
    .title{
        font-size: 18px;
        margin-bottom: 15px;
    }
    
    .form-box{
        padding: 15px;
        border-radius: 15px;
    }
    
    .form-box h3{
        font-size: 14px;
        margin-bottom: 15px;
    }
    
    .form-group{
        margin-bottom: 15px;
    }
    
    label{
        font-size: 12px;
        margin-bottom: 5px;
    }
    
    input[type="text"],
    input[type="number"],
    textarea{
        padding: 8px 10px;
        font-size: 12px;
        border-radius: 8px;
    }
    
    textarea{
        min-height: 60px;
    }
    
    .upload-box{
        padding: 20px 15px;
    }
    
    .upload-box i{
        font-size: 28px;
    }
    
    .upload-box p{
        font-size: 11px;
    }
    
    .images-grid{
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 10px;
    }
    
    .btn-container{
        flex-direction: column;
        gap: 10px;
    }
    
    .btn{
        padding: 10px;
        font-size: 13px;
    }
    
    .menu-toggle{
        display: block;
    }
}

/* Small Mobile */
@media (max-width: 360px){
    .logo img{
        width: 80px;
    }
    
    .menu a{
        padding: 10px 15px;
        font-size: 13px;
    }
    
    .preview-wrapper img{
        max-height: 200px;
    }
}
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

        <form id="editWisataForm" action="{{ route('admin.wisata.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
            <div class="form-group">
                <label>Nama Wisata</label>
               <input type="text" 
       name="nama_wisata" 
       value="{{ old('nama_wisata', $wisata->nama_wisata ?? '') }}" 
       placeholder="Masukkan nama wisata" 
       required>
            </div>

            <div class="form-group">
                 <label>Lokasi</label>
                <input type="text" 
       name="lokasi" 
       value="{{ old('lokasi', $wisata->lokasi ?? '') }}" 
       placeholder="Masukkan lokasi wisata" 
       required>
            </div>
<!-- HARGA TIKET DEWASA -->
<div class="form-group">
    <label>Harga Tiket Dewasa</label>
    <input type="number" 
       name="tiket_dewasa" 
       value="{{ old('tiket_dewasa', $wisata->tiket_dewasa ?? 0) }}" 
       required>
</div>

<!-- HARGA TIKET ANAK -->
<div class="form-group">
    <label>Harga Tiket Anak</label>
    <input type="number" 
       name="tiket_anak" 
       value="{{ old('tiket_anak', $wisata->tiket_anak ?? 0) }}" 
       required>
</div>

<div class="form-group">
    <label>Biaya Asuransi</label>
    <input type="number" name="biaya_asuransi" value="{{ old('biaya_asuransi', $wisata->biaya_asuransi ?? 0) }}">
</div>

<!-- DESKRIPSI (Sesuaikan dengan kolom DB) -->
<div class="form-group">
    <label>Deskripsi Wisata</label>
   <textarea name="deskripsi" 
          placeholder="Deskripsikan wisata ini..."
          required>{{ old('deskripsi', $wisata->deskripsi ?? '') }}</textarea>

</div>

<!-- FASILITAS (Jika ada field ini di form) -->
<div class="form-group">
    <label>Fasilitas</label>
    <textarea name="fasilitas" 
          placeholder="Fasilitas yang tersedia...">{{ old('fasilitas', $wisata->fasilitas ?? '') }}</textarea>
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
                    
                    <!-- Preview Gambar Utama -->
                    <div class="image-preview" id="previewUtama">
                        <div class="preview-wrapper">
                            <img src="" alt="Preview" id="imgPreview">
                            <button type="button" class="remove-image" onclick="removeImage()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="image-info" id="imageInfo"></div>
                    </div>
                </div>
            </div>

            <!-- GAMBAR EVENT (MULTIPLE) -->
            <div class="form-group multiple-images">
                <label>Gambar Event / Aktivitas</label>
                <div class="upload-container">
                    <div class="upload-box">
                        <i class="fas fa-images"></i>
                        <p><span class="highlight">Upload multiple</span> untuk galeri event</p>
                        <p style="font-size:11px;color:#999;">Gambar akan ditampilkan di beranda user</p>
                        <input type="file" name="gambar_event[]" id="gambarEvent" accept="image/*" multiple>
                    </div>
                    
                    <!-- Preview Multiple Images -->
                    <div class="images-grid" id="imagesGrid"></div>
                </div>
                <div class="hint">Gambar-gambar ini akan ditampilkan di halaman beranda untuk menarik pengunjung</div>
            </div>
<!-- PASTIKAN ADA: action, method, enctype, csrf, method PUT -->
    
    <!-- Input fields -->
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Simpan Perubahan
    </button>
</form>

        </form>
    </div>
</div>

</div>

<script>
// Toggle Sidebar untuk Mobile
function toggleSidebar(){
    const sidebar = document.getElementById('sidebar');
    const overlay = document.querySelector('.overlay');
    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
}

// ===== IMAGE PREVIEW UTAMA =====
const gambarUtama = document.getElementById('gambarUtama');
const uploadBox = document.getElementById('uploadBox');
const previewUtama = document.getElementById('previewUtama');
const imgPreview = document.getElementById('imgPreview');
const imageInfo = document.getElementById('imageInfo');

gambarUtama.addEventListener('change', function(e){
    const file = e.target.files[0];
    if(file){
        previewImage(file);
    }
});

// Drag and Drop
uploadBox.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadBox.classList.add('dragover');
});

uploadBox.addEventListener('dragleave', () => {
    uploadBox.classList.remove('dragover');
});

uploadBox.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadBox.classList.remove('dragover');
    const file = e.dataTransfer.files[0];
    if(file && file.type.startsWith('image/')){
        gambarUtama.files = e.dataTransfer.files;
        previewImage(file);
    }
});

function previewImage(file){
    if(file.size > 5 * 1024 * 1024){
        alert('Ukuran file terlalu besar! Maksimal 5MB');
        return;
    }
    
    const reader = new FileReader();
    reader.onload = function(e){
        imgPreview.src = e.target.result;
        previewUtama.classList.add('active');
        uploadBox.style.display = 'none';
        imageInfo.innerHTML = `
            <strong>File:</strong> ${file.name}<br>
            <strong>Ukuran:</strong> ${(file.size/1024/1024).toFixed(2)} MB
        `;
    };
    reader.readAsDataURL(file);
}

function removeImage(){
    gambarUtama.value = '';
    previewUtama.classList.remove('active');
    uploadBox.style.display = 'block';
}

// ===== MULTIPLE IMAGES PREVIEW =====
const gambarEvent = document.getElementById('gambarEvent');
const imagesGrid = document.getElementById('imagesGrid');

gambarEvent.addEventListener('change', function(e){
    const files = e.target.files;
    imagesGrid.innerHTML = '';
    
    Array.from(files).forEach((file, index) => {
        if(file.type.startsWith('image/')){
            const reader = new FileReader();
            reader.onload = function(e){
                const div = document.createElement('div');
                div.className = 'image-item';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="Event ${index+1}">
                    <button type="button" class="remove-btn" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                imagesGrid.appendChild(div);
            };
            reader.readAsDataURL(file);
        }
    });
});

// ===== FORM SUBMIT =====
document.getElementById('editWisataForm').addEventListener('submit', function(e){
    // e.preventDefault(); <--- HAPUS ATAU COMMENT BARIS INI
    
    // Validasi
    if(!gambarUtama.files.length && !document.getElementById('imgPreview').src){
        // Jika tidak ada gambar baru dan tidak ada gambar lama
        // alert('Silakan upload gambar utama wisata!');
        // return;
    }
    
    // HAPUS BARIS INI JUGA: alert('Data berhasil disimpan!');
});

// ===== RESET FORM =====
function resetForm(){
    if(confirm('Yakin ingin reset form?')){
        document.getElementById('editWisataForm').reset();
        removeImage();
        imagesGrid.innerHTML = '';
    }
}

// Close sidebar saat resize ke desktop
window.addEventListener('resize', function(){
    if(window.innerWidth > 768){
        const sidebar = document.getElementById('sidebar');
        const overlay = document.querySelector('.overlay');
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    }
});
function confirmLogout(event) {
    event.preventDefault();
    
    Swal.fire({
        title: 'Yakin ingin logout?',
        text: "Anda akan keluar dari sistem",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#52C396',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('admin.logout') }}";
        }
    })
}
</script>

</body>
</html>