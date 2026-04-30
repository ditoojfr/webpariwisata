<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Admin Nganjuk Abirupa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
           <a href="#" class="logout" onclick="confirmLogout(event)"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main">
        
        <div class="profile-container">
            
            <!-- LEFT SIDEBAR - Profile Actions -->
<div class="profile-sidebar">
    <div class="profile-avatar">
        @if($user && $user->foto_profile)
            <img src="{{ asset('storage/' . $user->foto_profile) }}" 
                 alt="Foto Profil" 
                 style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
        @else
            <i class="fas fa-user"></i>
        @endif
    </div>
    
    <!-- Tampilkan nama terbaru dari database -->
    <div class="profile-name" id="displayName">{{ $user->name }}</div>
    
    <button class="btn btn-edit" onclick="editProfile()">
        <i class="fas fa-edit"></i> Edit
    </button>
    
    <button class="btn btn-delete" onclick="deleteAccount()">
        <i class="fas fa-trash"></i> Hapus Akun
    </button>
</div>

            <!-- RIGHT SIDE - Profile Form -->
            <<!-- RIGHT SIDE - Profile Form -->
<div class="profile-form">
    <h2>Profile</h2>
    
    @if(session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif
    
    <form id="profileForm" action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nama">Nama</label>
            <!-- Isi dengan data terbaru dari database -->
            <input type="text" id="nama" name="nama" 
                   value="{{ old('nama', $user->name) }}" 
                   placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <!-- Isi dengan email terbaru -->
            <input type="email" id="email" name="email" 
                   value="{{ old('email', $user->email) }}" 
                   placeholder="Masukkan email" required>
        </div>

        <div class="form-group">
            <label for="telepon">No Telp</label>
            <!-- Isi dengan telepon terbaru (nullable) -->
            <input type="tel" id="telepon" name="telepon" 
                   value="{{ old('telepon', $user->telepon) }}" 
                   placeholder="Masukkan nomor telepon">
        </div>

        <div class="form-group">
            <label for="foto">Foto Profil</label>
            <input type="file" id="foto" name="foto" accept="image/*">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save" id="submitBtn">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <button type="button" class="btn-cancel" onclick="window.location.reload()">
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
        Swal.fire({
            title: '⚠️ PERINGATAN!',
            text: 'Apakah Anda yakin ingin menghapus akun ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff4757',
            cancelButtonColor: '#d1d8e0',
            confirmButtonText: 'Ya, Hapus Akun!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form delete
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('admin.profil.delete') }}";
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Cancel Changes
    function cancelChanges() {
        window.location.reload();
    }
    
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