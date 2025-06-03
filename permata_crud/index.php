<?php
include 'db.php';
$result = $conn->query("SELECT * FROM jemaat");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Jemaat PERMATA</title>
</head>
<body>
    <h2>Data Jemaat</h2>
    <a href="tambah.php">Tambah Jemaat</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th><th>Nama</th><th>Alamat</th><th>Tgl Lahir</th><th>No Telp</th><th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['alamat']) ?></td>
            <td><?= $row['tanggal_lahir'] ?></td>
            <td><?= $row['no_telepon'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
