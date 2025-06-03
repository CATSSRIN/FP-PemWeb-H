<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Default role to 'user' if not set, though admin check is more specific
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pendataan Jemaat</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Dashboard Pendataan Jemaat</h1>
        <nav>
            <?php if ($role === 'admin'): ?>
                <a href="kelola_jemaat.php">Kelola Data Jemaat</a>
                <a href="form_jemaat.php">+ Tambah Jemaat Baru</a>
            <?php endif; ?>
            <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?');">Logout</a>
        </nav>
    </header>

    <main>
        <section class="intro">
            <h2>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p>Gunakan sistem ini untuk mengelola data jemaat Gereja XYZ.</p>
            <?php if (isset($_GET['status']) && $_GET['status'] == 'success_add_jemaat'): ?>
                <p style="color: green;">Data jemaat baru berhasil ditambahkan!</p>
            <?php elseif (isset($_GET['status']) && $_GET['status'] == 'success_edit_jemaat'): ?>
                <p style="color: green;">Data jemaat berhasil diperbarui!</p>
            <?php elseif (isset($_GET['status']) && $_GET['status'] == 'success_delete_jemaat'): ?>
                <p style="color: green;">Data jemaat berhasil dihapus!</p>
            <?php endif; ?>
        </section>

        <section class="jadwal">
            <h3>Daftar Jemaat Terbaru</h3>
            <?php if ($role === 'admin'): ?>
            <p>
                <a href="form_jemaat.php" style="
                    padding: 8px 16px;
                    background-color: #27ae60;
                    color: white;
                    text-decoration: none;
                    border-radius: 6px;
                    display: inline-block;
                    margin-bottom: 10px;
                ">
                    + Tambah Data Jemaat Baru
                </a>
            </p>
            <?php endif; ?>
            <table>
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Kontak</th>
                        <th>Status Keanggotaan</th>
                        <?php if ($role === 'admin'): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "config/koneksi.php"; //
                    // Display a few recent members or a summary
                    $query_jemaat = "SELECT id, nama_lengkap, tanggal_lahir, alamat, nomor_telepon, status_keanggotaan FROM jemaat ORDER BY tanggal_daftar DESC LIMIT 10";
                    $result_jemaat = mysqli_query($conn, $query_jemaat);
                    if (mysqli_num_rows($result_jemaat) > 0) {
                        while ($row = mysqli_fetch_assoc($result_jemaat)) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['nama_lengkap']) . "</td>
                                    <td>" . htmlspecialchars($row['tanggal_lahir'] ? date('d M Y', strtotime($row['tanggal_lahir'])) : '-') . "</td>
                                    <td>" . htmlspecialchars($row['alamat']) . "</td>
                                    <td>" . htmlspecialchars($row['nomor_telepon']) . "</td>
                                    <td>" . htmlspecialchars($row['status_keanggotaan']) . "</td>";
                            if ($role === 'admin') {
                                echo "<td>
                                        <a href='edit_jemaat.php?id={$row['id']}'>Edit</a> |
                                        <a href='view_jemaat.php?id={$row['id']}'>Detail</a>
                                      </td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='" . ($role === 'admin' ? 6 : 5) . "' style='text-align:center;'>Belum ada data jemaat.</td></tr>";
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </section>

        <section class="tentang-kami intro">
            <h3>Tentang Sistem Ini</h3>
            <p>Sistem Pendataan Jemaat ini dirancang untuk memudahkan pengelolaan administrasi data anggota gereja. 
            Fitur utama meliputi penambahan, pengeditan, penghapusan, dan pencarian data jemaat.</p>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Gereja XYZ. All rights reserved.</p>
    </footer>

    </body>
</html>