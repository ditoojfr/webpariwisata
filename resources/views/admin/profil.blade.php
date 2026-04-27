<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Admin Nganjuk Abirupa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #52C396;
            --primary-hover: #45b085;
            --danger: #ff4757;
            --danger-hover: #ff3344;
            --gray: #d1d8e0;
            --bg: #f5f6f8;
            --white: #ffffff;
            --text: #2d3436;
            --text-light: #636e72;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: var(--bg); color: var(--text); }

        .container { display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #eef2ef;
            padding: 30px 20px;
            position: fixed;
            height: 100vh;
        }
        .logo { text-align: center; margin-bottom: 40px; }
        .logo img { width: 120px; }
        .menu a {
            display: flex; align-items: center; gap: 15px;
            text-decoration: none; color: #333;
            padding: 15px 20px; border-radius: 15px;
            margin-bottom: 10px; font-weight: 600;
            transition: 0.3s;
        }
        .menu a:hover, .menu a.active {
            background: var(--primary); color: white;
            box-shadow: 0 5px 15px rgba(82, 195, 150, 0.3);
        }

        /* MAIN CONTENT */
        .main {
            flex: 1;
            margin-left: 240px;
            padding: 40px;
        }

        /* PROFILE CONTAINER */
        .profile-container {
            display: flex;
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        /* LEFT SIDEBAR - Profile Actions */
        .profile-sidebar {
            flex: 0 0 250px;
            text-align: center;
            padding: 30px 20px;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--primary);
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
            font-weight: 600;
        }

        .profile-name {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 25px;
            color: var(--text);
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 12px;
        }

        .btn-edit {
            background: var(--primary);
            color: white;
        }
        .btn-edit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-delete {
            background: var(--danger);
            color: white;
        }
        .btn-delete:hover {
            background: var(--danger-hover);
            transform: translateY(-2px);
        }

        .btn-logout {
            background: var(--gray);
            color: var(--text);
        }
        .btn-logout:hover {
            background: #b8c2cc;
            transform: translateY(-2px);
        }

        /* RIGHT SIDE - Profile Form */
        .profile-form {
            flex: 1;
            background: var(--white);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .profile-form h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            color: var(--text);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text);
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 2px dashed #e0e0e0;
            border-radius: 10px;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .form-group input[type="file"]:hover {
            border-color: var(--primary);
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-save {
            background: var(--primary);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-save:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: var(--gray);
            color: var(--text);
            padding: 12px 30px;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-cancel:hover {
            background: #b8c2cc;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main {
                margin-left: 0;
                padding: 20px;
            }
            .profile-container {
                flex-direction: column;
            }
            .profile-sidebar {
                flex: none;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('images/logo-abirupa.png') }}" alt="Nganjuk Abirupa">
        </div>
        <div class="menu">
            <a href="{{ route('admin.beranda') }}">
                <i class="fas fa-home"></i> Beranda
            </a>
            <a href="{{ route('admin.edit') }}">
                <i class="fas fa-edit"></i> Edit Wisata
            </a>
            <a href="{{ route('admin.profil') }}" class="active">
                <i class="fas fa-user"></i> Profil
            </a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main">
        
        <div class="profile-container">
            
            <!-- LEFT SIDEBAR - Profile Actions -->
            <div class="profile-sidebar">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-name" id="displayName">Subakir</div>
                
                <button class="btn btn-edit" onclick="editProfile()">
                    <i class="fas fa-edit"></i> Edit
                </button>
                
                <button class="btn btn-delete" onclick="deleteAccount()">
                    <i class="fas fa-trash"></i> Hapus Akun
                </button>
                
                <button class="btn btn-logout" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>

            <!-- RIGHT SIDE - Profile Form -->
            <div class="profile-form">
                <h2>Profile</h2>
                
                <form id="profileForm" onsubmit="saveChanges(event)">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan email">
                    </div>

                    <div class="form-group">
                        <label for="telepon">No Telp</label>
                        <input type="tel" id="telepon" name="telepon" placeholder="Masukkan nomor telepon">
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Profil</label>
                        <input type="file" id="foto" name="foto" accept="image/*">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <button type="button" class="btn-cancel" onclick="cancelChanges()">
                            Batal
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

<script>
    // ===== BUTTON FUNCTIONS =====
    
    // Edit Profile - Scroll to form and focus
    function editProfile() {
        document.querySelector('.profile-form').scrollIntoView({ behavior: 'smooth' });
        document.getElementById('nama').focus();
        
        // Highlight form
        document.querySelector('.profile-form').style.boxShadow = '0 5px 30px rgba(82, 195, 150, 0.3)';
        setTimeout(() => {
            document.querySelector('.profile-form').style.boxShadow = '0 5px 20px rgba(0,0,0,0.05)';
        }, 1000);
    }

    // Delete Account - Confirmation
    function deleteAccount() {
        if(confirm('⚠️ PERINGATAN!\n\nApakah Anda yakin ingin menghapus akun ini?\nTindakan ini tidak dapat dibatalkan dan semua data akan hilang permanen.\n\nKetik "HAPUS" untuk konfirmasi:')) {
            // Simulasi delete
            alert('Akun berhasil dihapus.\nAnda akan dialihkan ke halaman login.');
            window.location.href = '/login'; // Ganti dengan route login Anda
        }
    }

    // Logout - Redirect to homepage
    function logout() {
    if(confirm('Apakah Anda yakin ingin logout?')) {
        alert('Berhasil logout!');
        
        // ✅ Redirect ke beranda user (halaman publik)
        window.location.href = '/beranda';
        
        // Atau jika file .blade.php:
        // window.location.href = '{{ route("beranda") }}';
    }
}
    

    // Save Changes
    function saveChanges(event) {
        event.preventDefault();
        
        // Get form data
        const formData = {
            nama: document.getElementById('nama').value,
            email: document.getElementById('email').value,
            telepon: document.getElementById('telepon').value,
            foto: document.getElementById('foto').files[0]
        };

        // Validasi
        if(!formData.nama || !formData.email) {
            alert('Mohon lengkapi nama dan email!');
            return;
        }

        // Simulasi simpan
        console.log('Data yang disimpan:', formData);
        
        // Update display name
        if(formData.nama) {
            document.getElementById('displayName').textContent = formData.nama;
        }

        alert('✅ Perubahan berhasil disimpan!');
        
        // Reset form
        document.getElementById('profileForm').reset();
    }

    // Cancel Changes
    function cancelChanges() {
        if(confirm('Batalkan perubahan?')) {
            document.getElementById('profileForm').reset();
        }
    }

    // Load existing data (simulasi)
    window.addEventListener('DOMContentLoaded', function() {
        // Contoh load data dari database
        const existingData = {
            nama: 'Subakir',
            email: 'subakir@example.com',
            telepon: '08123456789'
        };

        document.getElementById('nama').value = existingData.nama;
        document.getElementById('email').value = existingData.email;
        document.getElementById('telepon').value = existingData.telepon;
    });
</script>

</body>
</html>