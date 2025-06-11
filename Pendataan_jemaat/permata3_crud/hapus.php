<?php
include 'koneksi.php';
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM jemaat_cijantung WHERE id=$id");
header("Location: index.php");
exit;
