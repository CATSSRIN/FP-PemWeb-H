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

<h2>Edit Jemaat</h2>
<form method="POST">
    Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br>
    Alamat: <textarea name="alamat" required><?= $data['alamat'] ?></textarea><br>
    Tanggal Lahir: <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>"><br>
    No Telp: <input type="text" name="no_telepon" value="<?= $data['no_telepon'] ?>"><br>
    <button type="submit">Update</button>
</form>
<a href="index.php">Kembali</a>
