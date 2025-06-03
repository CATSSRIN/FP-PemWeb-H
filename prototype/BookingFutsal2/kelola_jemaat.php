<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php"); // Redirect non-admins
    exit();
}

require_once "config/koneksi.php"; //

// Search and Filter Logic (Optional - Basic Example)
$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$query_jemaat = "SELECT j.id, j.nama_lengkap, j.tanggal_lahir, j.alamat, j.nomor_telepon, j.status_keanggotaan, u.username as pencatat 
                 FROM jemaat j 
                 LEFT JOIN users u ON j.user_id_pencatat = u.id";
if (!empty($searchTerm)) {
    $query_jemaat .= " WHERE j.nama_lengkap LIKE '%$searchTerm%' OR j.alamat LIKE '%$searchTerm%' OR j.nomor_telepon LIKE '%$searchTerm%'";
}
$query_jemaat .= " ORDER BY j.nama_lengkap ASC";

$result_jemaat = mysqli_query($conn, $query_jemaat);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Data Jemaat (Admin)</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Kelola Data Jemaat</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a> |
            <a href="form_jemaat.php">+ Tambah Jemaat Baru</a> |
            <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?');">Logout</a>
        </nav>
    </header>

    <main>
        <section class="intro">
            <form method="GET" action="kelola_jemaat.php">
                <input type="text" name="search" placeholder="Cari Nama, Alamat, Telepon..." value="<?= htmlspecialchars($searchTerm) ?>">
                <button type="submit">Cari</button>
                 <a href="kelola_jemaat.php" style="margin-left:10px;">Reset</a>
            </form>
        </section>

        <section class="jadwal"> <h2>Daftar Semua Jemaat</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Status</th>
                        <th>Dicatat Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result_jemaat) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result_jemaat)): ?>
                        <tr>
                            <td><?= (int)$row['id'] ?></td>
                            <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                            <td><?= htmlspecialchars($row['tanggal_lahir'] ? date('d M Y', strtotime($row['tanggal_lahir'])) : '-') ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>
                            <td><?= htmlspecialchars($row['nomor_telepon']) ?></td>
                            <td><?= htmlspecialchars($row['status_keanggotaan']) ?></td>
                            <td><?= htmlspecialchars($row['pencatat']) ?></td>
                            <td>
                                <a href="view_jemaat.php?id=<?= (int)$row['id'] ?>">Detail</a> |
                                <a href="edit_jemaat.php?id=<?= (int)$row['id'] ?>">Edit</a> |
                                <a href="hapus_jemaat.php?id=<?= (int)$row['id'] ?>" onclick="return confirm('Yakin ingin menghapus data jemaat ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="8" style="text-align:center;">Tidak ada data jemaat yang cocok dengan pencarian atau belum ada data.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Gereja XYZ. All rights reserved.</p>
    </footer>
</body>
</html>
<?php mysqli_close($conn); ?>