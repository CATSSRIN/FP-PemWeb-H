<?php
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

<h2>Tambah Jemaat</h2>
<form method="POST">
    Nama: <input type="text" name="nama" required><br>
    Alamat: <textarea name="alamat" required></textarea><br>
    Tanggal Lahir: <input type="date" name="tanggal_lahir"><br>
    No Telp: <input type="text" name="no_telepon"><br>
    <button type="submit">Simpan</button>
</form>
<a href="index.php">Kembali</a>
