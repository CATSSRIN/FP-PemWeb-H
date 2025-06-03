<?php
include 'koneksi.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tgl = $_POST['tanggal_lahir'];
    $telp = $_POST['no_telepon'];

    $stmt = $conn->prepare("INSERT INTO jemaat (nama, alamat, tanggal_lahir, no_telepon) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $alamat, $tgl, $telp);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Jemaat</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Jemaat</h2>
        <form method="POST">
            <label>Nama:</label>
            <input type="text" name="nama" required><br>

            <label>Alamat:</label>
            <textarea name="alamat" required></textarea><br>

            <label>Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir"><br>

            <label>No Telp:</label>
            <input type="text" name="no_telepon"><br>

            <button type="submit">Simpan</button>
        </form>
        <a href="index.php" class="back-link">Kembali</a>
    </div>
</body>
</html>
