<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-F-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Aplikasi Gereja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Styling Dasar untuk Header */
        body {
            margin: 0;
            font-family: sans-serif;
        }

        .app-header {
            background-color: #333; /* Warna latar belakang header (sesuaikan) */
            padding: 15px 20px;
            display: flex;
            justify-content: space-between; /* Untuk memisahkan menu kiri dan kanan */
            align-items: center;
            color: white;
        }

        .app-header .logo {
            font-size: 1.5em;
            font-weight: bold;
            color: white; /* Warna logo */
        }

        .main-nav ul, .user-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .main-nav li, .user-nav li {
            margin-left: 20px; /* Jarak antar item menu */
        }

        .main-nav a, .user-nav a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 0.9em;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .main-nav a:hover, .user-nav a:hover {
            background-color: #555; /* Warna latar saat hover */
        }

        .main-nav a i, .user-nav a i {
            margin-right: 8px; /* Jarak antara ikon dan teks */
            font-size: 1.1em; /* Ukuran ikon */
        }

        .language-switcher {
            padding: 8px 12px;
            background-color: #444;
            border-radius: 5px;
            cursor: pointer;
        }
        .language-switcher i{
            margin-right: 5px;
        }

        /* Style untuk dropdown sederhana (opsional) */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
        }

        .dropdown-content a {
            color: black;
            padding: 10px 14px;
            text-decoration: none;
            display: block;
            font-size: 0.9em;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .user-nav .profile-icon {
            font-size: 1.5em; /* Icon profil bisa sedikit lebih besar */
        }

        /* Responsif (Contoh Sederhana) */
        @media (max-width: 992px) {
            .main-nav {
                display: none; /* Sembunyikan nav utama di layar kecil, ganti dengan menu burger */
            }
            .app-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .user-nav {
                margin-top: 10px;
                width: 100%;
            }
            .user-nav ul {
                justify-content: space-around;
            }
            .user-nav li {
                margin-left: 5px;
            }
        }
        @media (max-width: 768px) {
             .main-nav li a, .user-nav li a {
                font-size: 0.8em; /* Perkecil font */
            }
            .main-nav li a i, .user-nav li a i {
                font-size: 1em; /* Perkecil ikon */
            }
            .user-nav ul {
                flex-wrap: wrap; /* Biarkan item wrap jika tidak cukup ruang */
                justify-content: center;
            }
            .user-nav li {
                margin: 5px;
            }
        }

    </style>
</head>
<body>

    <header class="app-header">
        <div class="logo">
            <a href="#" style="color: white; text-decoration: none;"><i class="fas fa-church"></i> Nama Gereja</a>
        </div>

        <nav class="main-nav">
            <ul>
                <li><a href="Pendataan_jemaat/index.php"><i class="fas fa-users"></i> Pendataan Jemaat</a></li>
                <li><a href="#donasi"><i class="fas fa-hand-holding-heart"></i> Donasi & Perpuluhan</a></li>
                <li><a href="#organisasi"><i class="fas fa-sitemap"></i> Organisasi Gereja</a></li>
                <li><a href="#connected"><i class="fas fa-link"></i> Stay Connected</a></li>
            </ul>
        </nav>

        <nav class="user-nav">
            <ul>
                <li class="dropdown">
                    <a href="#" class="language-switcher" onclick="return false;"><i class="fas fa-globe"></i> Bahasa <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="?lang=id">Indonesia</a>
                        <a href="?lang=en">English</a>
                    </div>
                </li>
                <li><a href="#notifikasi"><i class="fas fa-bell"></i> <span class="sr-only">Notifikasi</span></a></li>
                <li class="dropdown">
                    <a href="#profil" onclick="return false;"><i class="fas fa-user-circle profile-icon"></i> <span class="sr-only">Profil</span> <i class="fas fa-caret-down"></i></a>
                     <div class="dropdown-content">
                        <a href="#lihat-profil">Lihat Profil</a>
                        <a href="#pengaturan">Pengaturan</a>
                        <a href="#logout">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <div style="padding: 20px;">
            <h1>Selamat Datang!</h1>
            <p>Ini adalah konten halaman utama.</p>
            <p>Header di atas telah diubah sesuai permintaan.</p>
        </div>
    </main>

    </body>
</html>