<?php
include 'koneksi.php';
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'permata_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
?>
