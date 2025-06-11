<?php
include 'koneksi.php';
include 'db.php';
$result = $conn->query("SELECT * FROM jemaat_semarang");

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
if ($cari != '') {
    $query = "SELECT * FROM jemaat_semarang WHERE nama LIKE ?";
    $stmt = $conn->prepare($query);
    $search = "%$cari%";
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM jemaat_semarang");
}
?>

<?php
// Mulai session jika belum dimulai (diperlukan untuk $_SESSION['username'])
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Jemaat PERMATA</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Styling Dasar untuk Header */
        body {
            /* Sebaiknya ini ada di CSS global Anda */
            margin: 0;
            font-family: sans-serif;
        }

        .app-header {
            background-color: #333;
            /* Warna latar belakang header */
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            position: sticky;
            /* Membuat header tetap di atas saat scroll */
            top: 0;
            z-index: 1000;
            min-height: 60px;
        }

        .app-header .logo {
            font-size: 1.3em;
            font-weight: bold;
        }

        .app-header .logo a {
            color: white;
            text-decoration: none;
        }

        .app-header .logo a i {
            margin-right: 8px;
        }

        .main-nav ul,
        .user-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .main-nav li,
        .user-nav li {
            margin-left: 15px;
        }

        .main-nav a,
        .user-nav a {
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
        .user-nav .dropdown>a:hover {
            background-color: #555;
        }

        .main-nav a i,
        .user-nav a i {
            margin-right: 6px;
            font-size: 1em;
        }

        .user-nav .language-switcher i,
        .user-nav .profile-icon {
            font-size: 1.1em;
        }

        .user-nav .fa-caret-down {
            font-size: 0.8em;
            margin-left: 4px;
        }

        /* Style untuk dropdown sederhana */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
            right: 0;
            top: 100%;
        }

        .dropdown-content a,
        .dropdown-content div {
            color: black;
            padding: 10px 14px;
            text-decoration: none;
            display: block;
            font-size: 0.9em;
            border-bottom: 1px solid #eee;
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
            /* Untuk menyembunyikan teks secara visual tapi tetap aksesibel */
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

        /* Bagian untuk hamburger menu (disembunyikan di desktop) */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5em;
            cursor: pointer;
        }

        /* Responsif untuk Header */
        @media (max-width: 992px) {
            .main-nav {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                /* Muncul di bawah header, sesuaikan dengan tinggi header */
                left: 0;
                width: 100%;
                background-color: #333;
                padding: 10px 0;
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
            }

            .menu-toggle {
                display: block;
                order: -1;
                margin-right: auto;
            }

            .app-header .logo {
                margin-left: 15px;
            }

            .user-nav li {
                margin-left: 10px;
            }

            .user-nav a {
                font-size: 0.8em;
                padding: 6px 8px;
            }

            .user-nav a i {
                font-size: 0.9em;
            }
        }

        @media (max-width: 768px) {
            .app-header .logo {
                font-size: 1.1em;
            }

            /* Anda bisa menambahkan penyesuaian lebih lanjut untuk user-nav di layar sangat kecil */
        }
    </style>
</head>

<body>
    <header class="app-header">
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>

        <div class="logo">
            <a href="../index.php"><i class="fas fa-church"></i> Permata GBKP</a>
        </div>

        <nav class="main-nav" id="mainNav">
            <ul>
                <li><a href="../index.php"><i class="fas fa-users"></i> Pendataan Jemaat</a></li>
                <li><a href="../../Donasi/index.php"><i class="fas fa-hand-holding-heart"></i> Donasi & Perpuluhan</a></li>
                <li><a href="../../Organisasi/index.php"><i class="fas fa-sitemap"></i> Organisasi Gereja</a></li>
                <li><a href="../../Contact_us/index.php"><i class="fas fa-link"></i> Stay Connected</a></li>
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
                        <div style="padding: 10px 14px; border-bottom: 1px solid #ccc; font-weight: bold;">
                            <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>
                        </div>
                        <a href="#lihat-profil">Lihat Profil</a>
                        <a href="#pengaturan">Pengaturan</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <div class="main-content-area">
        <h2>Data Jemaat GBKP Runggun Semarang</h2>
        <div class="tambah">
            <a href="tambah.php" class="tambah-btn">Tambah Jemaat</a>
        </div>

        <div class="export">
            <a href="export.php?type=excel" class="excel">Export ke Excel</a>
            <a href="export.php?type=pdf" class="pdf" target="_blank">Export ke PDF</a>
        </div>

        <div>
            <form method="GET" action="">
                <input type="text" style="height: 25px; border-radius: 10px;" name="cari" placeholder="Cari nama..." value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
                <button type="submit" style="height: 25px; border-radius: 10px;">Cari</button>
            </form>

            <table class="table" border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tgl Lahir</th>
                    <th>No Telp</th>
                    <th>Aksi</th>
                </tr>
                <?php $no = 1;
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['alamat']) ?></td>
                        <td><?= $row['tanggal_lahir'] ?></td>
                        <td><?= $row['no_telepon'] ?></td>
                        <td>
                            <div style="display: flex;">
                                <a href="edit.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
                                <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="hapus-btn">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>

</html>