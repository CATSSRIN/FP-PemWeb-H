<?php
include 'koneksi.php';
include 'db.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM jemaat WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tgl = $_POST['tanggal_lahir'];
    $telp = $_POST['no_telepon'];

    $stmt = $conn->prepare("UPDATE jemaat SET nama=?, alamat=?, tanggal_lahir=?, no_telepon=? WHERE id=?");
    $stmt->bind_param("ssssi", $nama, $alamat, $tgl, $telp, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Jemaat</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    <h2>Edit Jemaat</h2>
    <form method="POST">
        <label>Nama:</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

        <label>Alamat:</label>
        <textarea name="alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea>

        <label>Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>">

        <label>No Telp:</label>
        <input type="text" name="no_telepon" value="<?= htmlspecialchars($data['no_telepon']) ?>">

        <button type="submit">Update</button>
    </form>
    <a href="index.php" class="back-link">Kembali</a>
</div>
</body>
</html>
