<?php
include 'koneksi.php';
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM jemaat_semarang WHERE id=$id");
header("Location: index.php");
exit;
