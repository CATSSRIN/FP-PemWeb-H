<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Jemaat</title> <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

        :root {
            --text-color: #333;
            --primary-color: #002366;
            --secondary-color: #f8f9fa; 
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(to right, var(--primary-color), lightcoral);
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
            min-height: 100vh;
            padding-top: 70px; 
        }

        .app-header {
            background-color: #333;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 60px;
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
        .app-header .logo span {
            display: inline-block;
        }

        .main-nav ul, .user-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            height: 100%;
        }

        .main-nav li, .user-nav li {
            margin-left: 15px;
            display: flex;
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

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 170px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1001;
            border-radius: 5px;
            right: 0;
            top: 100%;
        }

        .dropdown-content a, .dropdown-content div.username-display {
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

        .sr-only {
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

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5em;
            cursor: pointer;
            padding: 0 10px;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 992px) {
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
        }

    </style>
</head>
<body>

<header class="app-header">
    <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation" aria-expanded="false">
        <i class="fas fa-bars"></i>
    </button>

    <div class="logo">
        <a href="/FP-PemWeb-H/index.php"><i class="fas fa-church"></i> <span>Permata GBKP</span></a>
    </div>

    <nav class="main-nav" id="mainNav">
        <ul>
            <li><a href="/FP-PemWeb-H/Pendataan_jemaat/index.php"><i class="fas fa-users"></i> Pendataan Jemaat</a></li>
            <li><a href="/FP-PemWeb-H/Donasi/index.php"><i class="fas fa-hand-holding-heart"></i> Donasi & Perpuluhan</a></li>
            <li><a href="/FP-PemWeb-H/Organisasi/index.php"><i class="fas fa-sitemap"></i> Organisasi Gereja</a></li>
            <li><a href="/FP-PemWeb-H/Contact_us/index.php"><i class="fas fa-link"></i> Stay Connected</a></li>
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
                    <a href="/FP-PemWeb-H/logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
</header>
<div class="main-content-area">