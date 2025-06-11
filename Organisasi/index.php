<?php
// Mulai session jika belum dimulai (diperlukan untuk $_SESSION['username'])
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Permata GBKP</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Root variables */
        :root {
            --text-color: #333; /* Default text color */
        }

        /* Global Body Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(to right, #002366, lightcoral); /* Gradient background */
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
            min-height: 100vh;
            padding-top: 70px; /* Space for the fixed header - adjust if header height changes */
        }

        /* --- Styling Header --- */
        .app-header {
            background-color: #333;
            padding: 0 20px; /* Adjusted padding */
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            position: fixed; /* Header fixed at the top */
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 60px; /* Explicit height for header */
        }

        .app-header .logo {
            font-size: 1.3em;
            font-weight: bold;
        }
        .app-header .logo a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .app-header .logo a i {
            margin-right: 8px;
        }
        .app-header .logo span { /* To control visibility of logo text */
            display: inline-block;
        }


        .main-nav ul, .user-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            height: 100%; /* Ensure nav items can align center vertically if needed */
        }

        .main-nav li, .user-nav li {
            margin-left: 15px;
            display: flex; /* For vertical alignment of link content */
            align-items: center;
        }

        .main-nav a, .user-nav a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 0.85em;
            padding: 8px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .main-nav a:hover,
        .user-nav a:hover,
        .user-nav .dropdown > a:hover {
            background-color: #555;
        }

        .main-nav a i, .user-nav a i {
            margin-right: 6px;
            font-size: 1em;
        }

        .user-nav .language-switcher i, .user-nav .profile-icon {
             font-size: 1.1em;
        }
        .user-nav .fa-caret-down {
            font-size: 0.8em;
            margin-left: 4px;
        }

        .dropdown { /* For header dropdowns */
            position: relative;
            display: inline-block;
        }

        .dropdown-content { /* For header dropdowns */
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 170px; /* Adjusted width */
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1001; /* Ensure dropdown is above other content */
            border-radius: 5px;
            right: 0;
            top: 100%; /* Position below the parent */
        }

        .dropdown-content a, .dropdown-content div.username-display { /* For header dropdowns */
            color: black;
            padding: 10px 14px;
            text-decoration: none;
            display: block;
            font-size: 0.9em;
            border-bottom: 1px solid #eee;
        }
        .dropdown-content div.username-display {
            font-weight: bold;
             white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dropdown-content a:last-child {
            border-bottom: none;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .sr-only { /* Accessibility helper */
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .menu-toggle { /* Hamburger menu button */
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5em;
            cursor: pointer;
            padding: 0 10px; /* Add some padding */
        }

        /* --- Styling Konten --- */
        .main-content-area { /* Wrapper for content below header */
            padding: 20px; /* Padding for the content area */
        }
        .main-container {
            width: 100%;
            max-width: 800px; /* Adjusted for slightly wider content */
            margin: 0 auto;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #333;
        }
        
        .profile-card h3, .profile-card h4, .profile-card p {
            color: #333;
        }
        .profile-card .text-muted {
            color: #6c757d !important;
        }
         .profile-card .bg-primary-icon { /* Custom class for the icon background */
            background-color: #002366 !important;
        }

        .statistic-item {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: .75rem;
            padding: 1.25rem;
            text-align: center;
            height: 100%;
        }

        .statistic-item .stat-icon {
            font-size: 2rem;
            color: #002366;
            margin-bottom: 0.5rem;
        }

        .statistic-item .stat-number {
            font-size: 1.75rem;
            font-weight: bold;
        }
        
        .statistic-item .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
        }

        /* --- Responsif --- */
        @media (max-width: 992px) { /* Tablet and below */
            .main-nav {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                background-color: #333;
                padding: 10px 0;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            }
            .main-nav.active {
                display: flex;
            }
            .main-nav li {
                margin: 10px 20px;
                width: calc(100% - 40px);
            }
            .main-nav a {
                justify-content: center;
                 padding: 12px 10px;
            }

            .menu-toggle {
                display: flex;
                align-items: center;
                order: -1;
            }
            .app-header .logo {
                margin: 0 auto;
                padding-left: 40px;
                padding-right: 40px;
            }
        }

         @media (max-width: 768px) {
            .app-header .logo {
                font-size: 1.1em;
                padding-left: 15px;
                padding-right: 15px;
            }
            .app-header .logo span{
                 display: none;
            }
            .main-nav a {
                font-size: 0.9em;
            }
             .user-nav li {
                margin-left: 8px;
            }
            .user-nav a {
                font-size: 0.8em;
                padding: 6px 8px;
            }
             .user-nav .language-switcher span {
                display: none;
            }
        }
         @media (max-width: 480px) {
            .app-header .logo {
                 display: none;
            }
            .menu-toggle {
                 margin-right: auto;
            }
             .user-nav a {
                padding: 5px;
            }
             .user-nav a i {
                margin-right: 3px;
            }
            .user-nav .fa-caret-down{
                display: none;
            }
             .user-nav .profile-icon + .sr-only + .fa-caret-down {
                display: none;
            }
        }
    </style>
</head>
<body>

    <header class="app-header">
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>

        <div class="logo">
            <a href="../index.php"><i class="fas fa-church"></i> <span>Permata GBKP</span></a>
        </div>

        <nav class="main-nav" id="mainNav">
            <ul>
                <li><a href="../Pendataan_jemaat/index.php"><i class="fas fa-users"></i> Pendataan Jemaat</a></li>
                <li><a href="../Donasi/index.php"><i class="fas fa-hand-holding-heart"></i> Donasi & Perpuluhan</a></li>
                <li><a href="#organisasi"><i class="fas fa-sitemap"></i> Organisasi Gereja</a></li>
                <li><a href="../Contact_us/index.php"><i class="fas fa-link"></i> Stay Connected</a></li>
            </ul>
        </nav>

        <nav class="user-nav">
            <ul>
                <li class="dropdown">
                    <a href="#" class="language-switcher" onclick="return false;" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe"></i> <span>Bahasa</span> <i class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="?lang=id">Indonesia</a>
                        <a href="?lang=en">English</a>
                    </div>
                </li>
                <li>
                    <a href="#notifikasi" aria-label="Notifikasi">
                        <i class="fas fa-bell"></i> <span class="sr-only">Notifikasi</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" onclick="return false;" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle profile-icon"></i> <span class="sr-only">Profil Pengguna</span> <i class="fas fa-caret-down"></i>
                    </a>
                     <div class="dropdown-content">
                        <div class="username-display">
                            <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>
                        </div>
                        <a href="#lihat-profil">Lihat Profil</a>
                        <a href="#pengaturan">Pengaturan</a>
                        <a href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <div class="main-content-area">
        <div class="container main-container">
            <div class="profile-card">
                <div class="card-body p-4 p-md-5">

                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary-icon rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-info-circle fa-lg text-white"></i>
                        </div>
                        <div>
                            <h3 class="mb-1">Tentang Gereja Batak Karo Protestan (GBKP)</h3>
                            <p class="text-muted mb-0">Sejarah, Kepemimpinan, dan Statistik</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">Sejarah Singkat</h4>
                    <p>Gereja Batak Karo Protestan (GBKP) adalah sebuah gereja Kristen Protestan beraliran Calvinis di kalangan masyarakat Batak Karo. Gereja ini lahir sebagai hasil pekabaran Injil dari Nederlandsch Zendeling Genootschap (NZG) dari Belanda. Secara resmi, GBKP berdiri pada tanggal 18 April 1890.</p>
                    <p>Pada awalnya, organisasi ini bernama "Gereja-Gereja Karo" dan kemudian secara resmi menjadi GBKP melalui Sidang Sinode I pada tahun 1941. GBKP berpusat di Kabanjahe, Kabupaten Karo, Sumatera Utara.</p>

                    <h4 class="mt-5 mb-3">Statistik Gereja (Data 2023)</h4>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="statistic-item">
                                <i class="fas fa-users stat-icon"></i>
                                <div class="stat-number">306.174</div>
                                <div class="stat-label">Jumlah Jemaat</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="statistic-item">
                                <i class="fas fa-church stat-icon"></i>
                                <div class="stat-number">1.023</div>
                                <div class="stat-label">Gereja / Runggun</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="statistic-item">
                                <i class="fas fa-map-marked-alt stat-icon"></i>
                                <div class="stat-number">31</div>
                                <div class="stat-label">Klasis (Distrik)</div>
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-5 mb-3">Pimpinan Moderamen (Periode 2020-2025)</h4>
                     <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Ketua Umum
                            <span class="fw-bold">Pdt. Krismas Imanta Barus, M.Th, L.M.</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Sekretaris Umum
                            <span class="fw-bold">Pdt. Yunus Bangun, M.Th.</span>
                        </li>
                         <li class="list-group-item d-flex justify-content-between align-items-center">
                            Bendahara Umum
                            <span class="fw-bold">Pt. Mulia Perangin-angin, S.E.</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Kabid. Pert testemunian
                            <span class="fw-bold">Pdt. Yusuf Tarigan, S.Th, M.M.</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Kabid. Koinonia
                            <span class="fw-bold">Pdt. Jenny Eva Karosekali, S.Th, M.M.</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Kabid. Diakonia
                            <span class="fw-bold">Pdt. Mestika Nan-guna Ginting, S.Th, M.Psi.</span>
                        </li>
                         <li class="list-group-item d-flex justify-content-between align-items-center">
                            Wakil Sekretaris Umum
                            <span class="fw-bold">Pdt. Endang Terkelin Tarigan, M.Th.</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // --- Script untuk Header (Menu Toggle) ---
        const menuToggle = document.getElementById('menuToggle');
        const mainNav = document.getElementById('mainNav');

        if (menuToggle && mainNav) {
            menuToggle.addEventListener('click', function() {
                mainNav.classList.toggle('active');
                const isExpanded = mainNav.classList.contains('active');
                menuToggle.setAttribute('aria-expanded', isExpanded);
            });
        }
    </script>
</body>
</html>