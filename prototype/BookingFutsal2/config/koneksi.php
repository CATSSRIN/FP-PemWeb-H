<?php
$host = "sql111.infinityfree.com";
$user = "if0_39074879";
$pass = "NIAIWO18";
$db   = "if0_39074879_bookingfutsaltestdb";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
