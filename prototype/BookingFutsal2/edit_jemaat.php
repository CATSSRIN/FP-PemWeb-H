<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}
require_once "config/koneksi.php"; //

$jemaat_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($jemaat_id <= 0) {
    header("Location: kelola_jemaat.php?error=invalid_id");
    exit();
}

// Fetch existing data
$stmt_select = $conn->prepare("SELECT * FROM jemaat WHERE id = ?");
$stmt_select->bind_param("i", $jemaat_id);
$stmt_select->execute();
$result = $stmt_select->get_result();
$data = $result->fetch_assoc();
$stmt_select->close();

if (!$data) {
    header("Location: kelola_jemaat.php?error=not_found");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form data
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $tempat_lahir = trim($_POST['tempat_lahir']);
    $tanggal_lahir = !empty($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : NULL;
    $jenis_kelamin = isset($_POST['jenis_kelamin']) && !empty($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : NULL;
    $alamat = trim($_POST['alamat']);
    $nomor_telepon = trim($_POST['nomor_telepon']);
    $email = trim($_POST['email']);
    $tanggal_baptis = !empty($_POST['tanggal_baptis']) ? $_POST['tanggal_baptis'] : NULL;
    $status_keanggotaan = trim($_POST['status_keanggotaan']);
    $pekerjaan = trim($_POST['pekerjaan']);
    $catatan = trim($_POST['catatan']);

    if (empty($nama_lengkap)) {
         header("Location: edit_jemaat.php?id=$jemaat_id&error=Nama lengkap tidak boleh kosong.");
        exit();
    }
    
    $stmt_update = $conn->prepare("UPDATE jemaat SET nama_lengkap=?, tempat_lahir=?, tanggal_lahir=?, jenis_kelamin=?, alamat=?, nomor_telepon=?, email=?, tanggal_baptis=?, status_keanggotaan=?, pekerjaan=?, catatan=? WHERE id=?");
    $stmt_update->bind_param("sssssssssssi",
        $nama_lengkap, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $alamat,
        $nomor_telepon, $email, $tanggal_baptis, $status_keanggotaan, $pekerjaan, $catatan, $jemaat_id
    );

    if ($stmt_update->execute()) {
        header("Location: kelola_jemaat.php?status=success_edit");
        exit();
    } else {
        // error_log("Error updating jemaat: " . $stmt_update->error);
         header("Location: edit_jemaat.php?id=$jemaat_id&error=" . urlencode("Gagal memperbarui: " . $stmt_update->error));
        exit();
    }
    $stmt_update->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Jemaat</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Edit Data Jemaat</h1>
    <nav>
        <a href="kelola_jemaat.php">Kembali ke Kelola Jemaat</a> |
        <a href="dashboard.php">Dashboard</a>
    </nav>
</header>
<main>
    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color:red;'>" . htmlspecialchars($_GET['error']) . "</p>";
    }
    ?>
    <form method="post" action="edit_jemaat.php?id=<?= $jemaat_id ?>">
        <label for="nama_lengkap">Nama Lengkap Jemaat</label>
        <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?= htmlspecialchars($data['nama_lengkap']) ?>" required>

        <label for="tempat_lahir">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" id="tempat_lahir" value="<?= htmlspecialchars($data['tempat_lahir']) ?>">

        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?= htmlspecialchars($data['tanggal_lahir']) ?>">

        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin">
            <option value="">--Pilih Jenis Kelamin--</option>
            <option value="Laki-laki" <?= ($data['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
            <option value="Perempuan" <?= ($data['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
        </select>

        <label for="alamat">Alamat Lengkap</label>
        <textarea name="alamat" id="alamat" rows="3"><?= htmlspecialchars($data['alamat']) ?></textarea>

        <label for="nomor_telepon">Nomor Telepon/HP</label>
        <input type="text" name="nomor_telepon" id="nomor_telepon" value="<?= htmlspecialchars($data['nomor_telepon']) ?>">
        
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($data['email']) ?>">

        <label for="tanggal_baptis">Tanggal Baptis</label>
        <input type="date" name="tanggal_baptis" id="tanggal_baptis" value="<?= htmlspecialchars($data['tanggal_baptis']) ?>">

        <label for="status_keanggotaan">Status Keanggotaan</label>
        <input type="text" name="status_keanggotaan" id="status_keanggotaan" value="<?= htmlspecialchars($data['status_keanggotaan']) ?>" placeholder="Contoh: Aktif, Simpatisan">
        
        <label for="pekerjaan">Pekerjaan</label>
        <input type="text" name="pekerjaan" id="pekerjaan" value="<?= htmlspecialchars($data['pekerjaan']) ?>">

        <label for="catatan">Catatan Tambahan</label>
        <textarea name="catatan" id="catatan" rows="3"><?= htmlspecialchars($data['catatan']) ?></textarea>

        <button type="submit">Simpan Perubahan</button>
    </form>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Gereja XYZ. All rights reserved.</p>
</footer>
</body>
</html>