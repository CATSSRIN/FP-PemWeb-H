<?php
session_start();
include 'permata_crud/db.php';

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']); // md5 berfungsi untuk enkripsi string menjadi nilai hash 128-bit

  $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

  if (mysqli_num_rows($result) == 1) {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;
    header("Location: index.php"); 
    exit; 
  } else {
    $error = "Username atau password salah!";
  }
}
?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="style-login.css">
<head>
  <title>Login Admin</title>
</head>

<body>
  <h2>Login Pengurus Permata GBKP</h2>
  <?php if (isset($error))
    echo "<p style='color:red;'>$error</p>"; ?>
  <form method="post">
    <p>Username: <input type="text" name="username" required></p>
    <p>Password: <input type="password" name="password" required></p>
    <input type="submit" name="login" value="Login">
    <p><a href="register.php">Belum punya akun? Daftar di sini</a></p>
  </form>
</body>

</html> 