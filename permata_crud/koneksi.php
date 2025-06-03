<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "permata_db";

// Koneksi ke MySQL (tanpa pilih database dulu)
$conn = new mysqli($host, $user, $pass);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Buat database jika belum ada
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Gagal membuat database: " . $conn->error);
}

// Pilih database
$conn->select_db($dbname);

// Buat tabel jemaat jika belum ada
$sqlTable = "CREATE TABLE IF NOT EXISTS jemaat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    tanggal_lahir DATE NOT NULL,
    no_telepon VARCHAR(20) NOT NULL
)";
if ($conn->query($sqlTable) !== TRUE) {
    die("Gagal membuat tabel: " . $conn->error);
}
?>
