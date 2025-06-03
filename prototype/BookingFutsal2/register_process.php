<?php
session_start();
require_once 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $raw_password = $_POST["password"];

    if (empty($username) || empty($raw_password)) {
        header("Location: register.php?error=empty");
        exit;
    }

    if (strlen($username) < 4 || strlen($username) > 20) {
        header("Location: register.php?error=invalidusername");
        exit;
    }

    $password = password_hash($raw_password, PASSWORD_DEFAULT);

    $cek = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
        header("Location: register.php?error=duplicate");
        exit;
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            $_SESSION["user_id"] = $stmt->insert_id;
            $_SESSION["username"] = $username;
            $_SESSION["role"] = 'user';
            header("Location: dashboard.php");
            exit;
        } else {
            header("Location: register.php?error=failed");
            exit;
        }
        $stmt->close();
    }
    $cek->close();
}
?><?php
session_start();
require_once 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $raw_password = $_POST["password"];

    if (empty($username) || empty($raw_password)) {
        header("Location: register.php?error=empty");
        exit;
    }

    if (strlen($username) < 4 || strlen($username) > 20) {
        header("Location: register.php?error=invalidusername");
        exit;
    }

    $password = password_hash($raw_password, PASSWORD_DEFAULT);

    $cek = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
        header("Location: register.php?error=duplicate");
        exit;
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            $_SESSION["user_id"] = $stmt->insert_id;
            $_SESSION["username"] = $username;
            $_SESSION["role"] = 'user';
            header("Location: dashboard.php");
            exit;
        } else {
            header("Location: register.php?error=failed");
            exit;
        }
        $stmt->close();
    }
    $cek->close();
}
?>