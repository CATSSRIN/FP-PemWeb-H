<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once "config/koneksi.php"; //

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
    $user_id_pencatat = $_SESSION['user_id'];

    if (empty($nama_lengkap)) {
        header("Location: form_jemaat.php?error=Nama lengkap tidak boleh kosong.");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO jemaat (nama_lengkap, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, nomor_telepon, email, tanggal_baptis, status_keanggotaan, pekerjaan, catatan, user_id_pencatat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssi", 
        $nama_lengkap, 
        $tempat_lahir, 
        $tanggal_lahir, 
        $jenis_kelamin, 
        $alamat, 
        $nomor_telepon, 
        $email,
        $tanggal_baptis, 
        $status_keanggotaan,
        $pekerjaan, 
        $catatan,
        $user_id_pencatat
    );

    if ($stmt->execute()) {
        header("Location: dashboard.php?status=success_add_jemaat");
        exit();
    } else {
        // Log error: error_log("Error saving jemaat: " . $stmt->error);
        header("Location: form_jemaat.php?error=" . urlencode("Terjadi kesalahan saat menyimpan: " . $stmt->error));
        exit();
    }
    $stmt->close();
    $conn->close();
} else {
    header("Location: form_jemaat.php");
    exit();
}
?>