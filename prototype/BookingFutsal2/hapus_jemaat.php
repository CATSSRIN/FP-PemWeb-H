<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}
require_once "config/koneksi.php"; //

$jemaat_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($jemaat_id <= 0) {
    header("Location: kelola_jemaat.php?error=invalid_id_delete");
    exit();
}

$stmt = $conn->prepare("DELETE FROM jemaat WHERE id = ?");
$stmt->bind_param("i", $jemaat_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: dashboard.php?status=success_delete_jemaat"); // Or kelola_jemaat.php
    } else {
        header("Location: kelola_jemaat.php?error=not_found_delete");
    }
} else {
    // error_log("Error deleting jemaat: " . $stmt->error);
    header("Location: kelola_jemaat.php?error=" . urlencode("Gagal menghapus: " . $stmt->error));
}
$stmt->close();
$conn->close();
exit();
?>