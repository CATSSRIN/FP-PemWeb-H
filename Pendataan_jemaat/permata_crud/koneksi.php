<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "permata_db";

$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Gagal membuat database: " . $conn->error);
}

$conn->select_db($dbname);

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

$sqlUsers = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";
if ($conn->query($sqlUsers) !== TRUE) {
    die("Gagal membuat tabel users: " . $conn->error);
}
?>