<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') { // Only admin can add
    header("Location: dashboard.php");
    exit();
}
$date_today = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Tambah Data Jemaat</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Form Tambah Data Jemaat</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a> |
            <a href="kelola_jemaat.php">Kelola Jemaat</a> |
            <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?');">Logout</a>
        </nav>
    </header>

    <main>
        <?php
        if (isset($_GET['error'])) {
            echo "<p style='color:red;'>Terjadi kesalahan: " . htmlspecialchars($_GET['error']) . "</p>";
        }
        ?>
        <section class="form-section">
            <form action="proses_pendataan_jemaat.php" method="post">
                <label for="nama_lengkap">Nama Lengkap Jemaat</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" required>

                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir">

                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir">

                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin">
                    <option value="">--Pilih Jenis Kelamin--</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>

                <label for="alamat">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" rows="3"></textarea>

                <label for="nomor_telepon">Nomor Telepon/HP</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon">
                
                <label for="email">Email</label>
                <input type="email" name="email" id="email">

                <label for="tanggal_baptis">Tanggal Baptis</label>
                <input type="date" name="tanggal_baptis" id="tanggal_baptis">

                <label for="status_keanggotaan">Status Keanggotaan</label>
                <input type="text" name="status_keanggotaan" id="status_keanggotaan" placeholder="Contoh: Aktif, Simpatisan">
                
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan">

                <label for="catatan">Catatan Tambahan</label>
                <textarea name="catatan" id="catatan" rows="3"></textarea>

                <button type="submit">Simpan Data Jemaat</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Gereja XYZ. All rights reserved.</p>
    </footer>
</body>
</html>