<?php
include 'koneksi.php';

$type = isset($_GET['type']) ? $_GET['type'] : '';

$result = $conn->query("SELECT * FROM jemaat_cijantung");

if ($type === 'excel') {
    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-Disposition: attachment; filename=jemaat_cijantung.csv");
    // Add UTF-8 BOM for Excel compatibility
    echo "\xEF\xBB\xBF";
    // Output CSV header
    echo "\"No\",\"Nama\",\"Alamat\",\"Tanggal Lahir\",\"No Telp\"\n";
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        echo "\"{$no}\",\""
            . str_replace('"', '""', $row['nama']) . "\",\""
            . str_replace('"', '""', str_replace(array("\r", "\n"), ' ', $row['alamat'])) . "\",\""
            . $row['tanggal_lahir'] . "\",\""
            . $row['no_telepon'] . "\"\n";
        $no++;
    }
    exit;
} elseif ($type === 'pdf') {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Export PDF Jemaat</title>
        <style>
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid #333; padding: 8px; }
            th { background: #eee; }
        </style>
    </head>
    <body>
        <h2>Data Jemaat</h2>
        <table>
            <tr>
                <th>No</th><th>Nama</th><th>Alamat</th><th>Tgl Lahir</th><th>No Telp</th>
            </tr>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
                <td><?= $row['tanggal_lahir'] ?></td>
                <td><?= $row['no_telepon'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <script>
            window.onload = function() { window.print(); }
        </script>
    </body>
    </html>
    <?php
    exit;
} else {
    echo "Tipe export tidak valid.";
    exit;
}