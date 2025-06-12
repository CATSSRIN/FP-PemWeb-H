<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'permataadmin_db';

// 1. Koneksi ke MySQL server (tanpa memilih database dulu)
// Ini penting karena kita mungkin perlu membuat database jika belum ada
$conn = new mysqli($host, $user, $pass);

// Periksa koneksi awal ke MySQL server
if ($conn->connect_error) {
    // Di lingkungan produksi, log error ini daripada menampilkannya langsung
    error_log("Koneksi ke MySQL server gagal: " . $conn->connect_error);
    die('Maaf, terjadi masalah pada server database. Silakan coba lagi nanti.');
}

// 2. Buat database jika belum ada
$sql_create_db = "CREATE DATABASE IF NOT EXISTS `$dbname`"; // Gunakan backticks untuk nama database
if ($conn->query($sql_create_db) !== TRUE) {
    // Log error jika gagal membuat database
    error_log("Gagal membuat database '$dbname': " . $conn->error);
    die('Maaf, terjadi masalah saat menyiapkan database.');
}

// 3. Pilih database yang sudah ada atau yang baru dibuat
$conn->select_db($dbname);

// 4. Atur encoding karakter untuk koneksi (penting untuk menghindari masalah karakter)
$conn->set_charset("utf8mb4");

// 5. Buat tabel 'jemaat' jika belum ada
$sql_create_jemaat_table = "CREATE TABLE IF NOT EXISTS `jemaat` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nama` VARCHAR(100) NOT NULL,
    `alamat` TEXT NOT NULL,
    `tanggal_lahir` DATE NOT NULL,
    `no_telepon` VARCHAR(20) NOT NULL
)";
if ($conn->query($sql_create_jemaat_table) !== TRUE) {
    error_log("Gagal membuat tabel 'jemaat': " . $conn->error);
    die('Maaf, terjadi masalah saat menyiapkan tabel jemaat.');
}

// 6. Buat tabel 'users' jika belum ada
// Penting: Kolom 'password' harus VARCHAR(255) untuk hash password_hash()
$sql_create_users_table = "CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL
)";
if ($conn->query($sql_create_users_table) !== TRUE) {
    error_log("Gagal membuat tabel 'users': " . $conn->error);
    die('Maaf, terjadi masalah saat menyiapkan tabel users.');
}

// Koneksi $conn sekarang siap digunakan di seluruh aplikasi Anda.
// Tidak perlu session_start() di sini, itu dilakukan di file yang membutuhkannya (login.php, index.php, dll).
?>