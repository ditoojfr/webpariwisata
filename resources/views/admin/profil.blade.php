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
        .menu a.active { background: var(--primary); color: white; box-shadow: 0 3px 10px rgba(82,195,150,0.3); }
        .menu a:hover:not(.active) { transform: translateX(5px); background: #dff5ec; }
        .menu a.logout { background: #fee2e2; color: #dc2626; margin-top: 10px; }
        .menu a.logout:hover { background: #fecaca; transform: translateX(5px); }

        /* MAIN CONTENT */
        .main {
            flex: 1;
            margin-left: 220px;
            padding: 40px;
            transition: all 0.3s ease;
        }
/* Eye icon transition */
#eyeIconLama, #eyeIconBaru {
    transition: opacity 0.2s ease;
}

#eyeIconLama:hover, #eyeIconBaru:hover {
    opacity: 0.7;
}
        /* PROFILE CONTAINER */
        .profile-container {
            display: flex;
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        /* LEFT SIDEBAR */
        .profile-sidebar {
            flex: 0 0 250px;
            text-align: center;
            padding: 30px 20px;
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            height: fit-content;
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
            overflow: hidden;
        }

        .profile-name {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 25px;
            color: var(--text);
            word-break: break-word;
        }

        /* RIGHT SIDE - Profile Form */
        .profile-form {
            flex: 1;
            background: var(--white);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .profile-form h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            color: var(--text);
        }

        .form-group { margin-bottom: 25px; }
        .form-group label {
            display: block; font-size: 14px; font-weight: 600;
            margin-bottom: 8px; color: var(--text);
        }

        .form-group input {
            width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0;
            border-radius: 10px; font-family: 'Poppins', sans-serif;
            font-size: 14px; transition: border-color 0.3s;
        }

        .form-group input:focus { outline: none; border-color: var(--primary); }

        .form-group input[type="file"] {
            padding: 10px; border: 2px dashed #e0e0e0; cursor: pointer;
        }

        .btn-save {
            background: var(--primary); color: white; padding: 12px 30px;
            border: none; border-radius: 10px; font-family: 'Poppins', sans-serif;
            font-size: 14px; font-weight: 700; cursor: pointer; transition: all 0.3s;
            width: 100%;
        }
        .btn-save:hover { background: var(--primary-hover); transform: translateY(-2px); }

        /* HAMBURGER & OVERLAY */
        .menu-toggle {
            display: none; position: fixed; top: 15px; left: 15px; z-index: 1001;
            background: var(--primary); color: white; border: none;
            width: 45px; height: 45px; border-radius: 10px; font-size: 20px; cursor: pointer;
        }
        .overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999; }

        @media (max-width: 992px) {
            .profile-container { flex-direction: column; }
            .profile-sidebar { flex: none; width: 100%; }
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main { margin-left: 0; padding: 15px; padding-top: 75px; }
            .menu-toggle { display: block; }
            .overlay.active { display: block; }
            .profile-form { padding: 25px; }
        }
    </style>
</head>
<body>

<button class="menu-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
<div class="overlay" onclick="toggleSidebar()"></div>

<div class="container">

    <div class="sidebar" id="sidebar">
        <div class="logo">
            <img src="{{ asset('images/logogedi.png') }}" alt="Nganjuk Abirupa">
        </div>
        <div class="menu">
            <a href="{{ route('admin.beranda') }}"><i class="fas fa-home"></i> Beranda</a>
            <a href="{{ route('admin.edit') }}"><i class="fas fa-edit"></i> Edit Wisata</a>
            <a href="{{ route('admin.profil') }}" class="active"><i class="fas fa-user"></i> Profil</a>
            <a href="#" class="logout" onclick="confirmLogout(event)"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <div class="main">
        <div class="profile-container">
            
            <div class="profile-sidebar">
                <div class="profile-avatar">
                    @if($user && $user->foto)
                        <img src="{{ asset('profil_admin/' . $user->foto) }}" 
                             alt="Foto Admin" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <i class="fas fa-user"></i>
                    @endif
                </div>
                <div class="profile-name">{{ $user->name }}</div>
            </div>

            <div class="profile-form">
                <h2>Pengaturan Profil</h2>
                
                @if(session('success'))
                    <div style="background: #d1fae5; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div style="background: #fee2e2; color: #dc2626; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
                        ❌ {{ session('error') }}
                    </div>
                @endif
                
                <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="no_tlp">No Telp</label>
<input type="tel" id="no_tlp" name="no_tlp" 
       value="{{ old('no_tlp', $user->telepon ?? $user->no_tlp) }}"
       maxlength="15"
       pattern="[0-9]*"
       inputmode="numeric"
       oninput="this.value = this.value.replace(/[^0-9]/g, '')"
       placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Profil</label>
                        <input type="file" id="foto" name="foto" accept="image/*">
                    </div>

                   <div style="margin: 30px 0 20px; padding-top: 20px; border-top: 2px dashed #f0f0f0;">
    <h4 style="margin-bottom: 15px; font-size: 16px; color: var(--text);">Ganti Password</h4>
    
    <div class="form-group">
        <label for="password_lama">Password Lama</label>
        <div style="position: relative;">
            <input type="password" id="password_lama" name="password_lama" 
                   placeholder="Masukkan password saat ini" 
                   autocomplete="new-password"
                   style="padding-right: 45px;">
            <button type="button" onclick="togglePasswordVisibility('password_lama', 'eyeIconLama')" 
                    style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); 
                           background: none; border: none; cursor: pointer; color: var(--text-light); 
                           padding: 5px; z-index: 10;">
                <svg id="eyeIconLama" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
            </button>
        </div>
    </div>


    <div class="form-group">
        <label for="password_baru">Password Baru</label>
        <div style="position: relative;">
            <input type="password" id="password_baru" name="password_baru" 
                   placeholder="Masukkan password baru (Min. 6 karakter)" 
                   autocomplete="new-password"
                   style="padding-right: 45px;">
            <button type="button" onclick="togglePasswordVisibility('password_baru', 'eyeIconBaru')" 
                    style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); 
                           background: none; border: none; cursor: pointer; color: var(--text-light); 
                           padding: 5px; z-index: 10;">
                <svg id="eyeIconBaru" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
            </button>
        </div>
        <small style="color: var(--text-light); font-size: 11px; margin-top: 5px; display: block;">
            *Kosongkan kedua field password jika tidak ingin mengganti password.
        </small>
    </div>
</div>
                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
        document.querySelector('.overlay').classList.toggle('active');
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
    
    function togglePasswordVisibility(inputId, eyeIconId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = document.getElementById(eyeIconId);
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        // Ubah icon menjadi mata dicoret
        eyeIcon.innerHTML = `
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
            <line x1="1" y1="1" x2="23" y2="23"></line>
        `;
    } else {
        passwordInput.type = 'password';
        // Kembalikan icon menjadi mata normal
        eyeIcon.innerHTML = `
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
            <circle cx="12" cy="12" r="3"></circle>
        `;
    }
}

</script>
</body>
</html>