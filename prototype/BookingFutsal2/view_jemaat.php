<?php
session_start();
if (!isset($_SESSION['user_id'])) { // Allow any logged-in user to view, or restrict to admin
    header("Location: login.php");
    exit();
}
require_once "config/koneksi.php"; //

$jemaat_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($jemaat_id <= 0) {
    header("Location: kelola_jemaat.php?error=invalid_id_view");
    exit();
}

$stmt = $conn->prepare("SELECT j.*, u.username as pencatat FROM jemaat j LEFT JOIN users u ON j.user_id_pencatat = u.id WHERE j.id = ?");
$stmt->bind_param("i", $jemaat_id);
$stmt->execute();
$result = $stmt->get_result();
$jemaat = $result->fetch_assoc();
$stmt->close();

if (!$jemaat) {
    header("Location: kelola_jemaat.php?error=not_found_view");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Data Jemaat - <?= htmlspecialchars($jemaat['nama_lengkap']) ?></title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .detail-table { width: 100%; margin-top: 20px; border-collapse: collapse; background: white; }
        .detail-table th, .detail-table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .detail-table th { background-color: #f2f2f2; width: 30%; }
    </style>
</head>
<body>
<header>
    <h1>Detail Data Jemaat</h1>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="kelola_jemaat.php">Kelola Jemaat</a> |
        <a href="edit_jemaat.php?id=<?= $jemaat_id ?>">Edit Jemaat Ini</a> |
        <?php endif; ?>
        <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?');">Logout</a>
    </nav>
</header>
<main>
    <section class="intro">
        <h2><?= htmlspecialchars($jemaat['nama_lengkap']) ?></h2>
    </section>
    <section>
        <table class="detail-table">
            <tr><th>ID Jemaat</th><td><?= $jemaat['id'] ?></td></tr>
            <tr><th>Nama Lengkap</th><td><?= htmlspecialchars($jemaat['nama_lengkap']) ?></td></tr>
            <tr><th>Tempat Lahir</th><td><?= htmlspecialchars($jemaat['tempat_lahir']) ?></td></tr>
            <tr><th>Tanggal Lahir</th><td><?= htmlspecialchars($jemaat['tanggal_lahir'] ? date('d F Y', strtotime($jemaat['tanggal_lahir'])) : '-') ?></td></tr>
            <tr><th>Jenis Kelamin</th><td><?= htmlspecialchars($jemaat['jenis_kelamin']) ?></td></tr>
            <tr><th>Alamat</th><td><?= nl2br(htmlspecialchars($jemaat['alamat'])) ?></td></tr>
            <tr><th>Nomor Telepon</th><td><?= htmlspecialchars($jemaat['nomor_telepon']) ?></td></tr>
            <tr><th>Email</th><td><?= htmlspecialchars($jemaat['email']) ?></td></tr>
            <tr><th>Tanggal Baptis</th><td><?= htmlspecialchars($jemaat['tanggal_baptis'] ? date('d F Y', strtotime($jemaat['tanggal_baptis'])) : '-') ?></td></tr>
            <tr><th>Status Keanggotaan</th><td><?= htmlspecialchars($jemaat['status_keanggotaan']) ?></td></tr>
            <tr><th>Pekerjaan</th><td><?= htmlspecialchars($jemaat['pekerjaan']) ?></td></tr>
            <tr><th>Catatan</th><td><?= nl2br(htmlspecialchars($jemaat['catatan'])) ?></td></tr>
            <tr><th>Tanggal Pendaftaran Akun</th><td><?= htmlspecialchars($jemaat['tanggal_daftar'] ? date('d F Y, H:i', strtotime($jemaat['tanggal_daftar'])) : '-') ?></td></tr>
            <tr><th>Dicatat Oleh</th><td><?= htmlspecialchars($jemaat['pencatat']) ?></td></tr>
        </table>
         <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <p style="margin-top: 20px;">
            <a href="edit_jemaat.php?id=<?= $jemaat_id ?>" style="padding: 8px 12px; background-color: #3498db; color:white; text-decoration:none; border-radius:4px;">Edit Data</a>
            <a href="hapus_jemaat.php?id=<?= $jemaat_id ?>" onclick="return confirm('Yakin ingin menghapus data jemaat ini?')" style="padding: 8px 12px; background-color: #e74c3c; color:white; text-decoration:none; border-radius:4px; margin-left:10px;">Hapus Data</a>
        </p>
        <?php endif; ?>
    </section>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Gereja XYZ. All rights reserved.</p>
</footer>
</body>
</html>
<?php $conn->close(); ?>