<?php
include 'db.php';

if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']); // Disamakan dengan enkripsi di login

  // Cek apakah username sudah ada
  $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
  if (mysqli_num_rows($check) > 0) {
    $error = "Username sudah digunakan!";
  } else {
    // Simpan ke database
    $query = mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
    if ($query) {
      $success = "Registrasi berhasil! Silakan login.";
    } else {
      $error = "Gagal mendaftar, coba lagi.";
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register User</title>
</head>
<body>
  <h2>Registrasi Akun Admin Gereja</h2>

  <?php
  if (isset($success)) echo "<p style='color:green;'>$success</p>";
  if (isset($error)) echo "<p style='color:red;'>$error</p>";
  ?>

  <form method="post">
    <p>Username: <input type="text" name="username" required></p>
    <p>Password: <input type="password" name="password" required></p>
    <input type="submit" name="register" value="Daftar">
  </form>

  <p><a href="login.php">Sudah punya akun? Login di sini</a></p>
</body>
</html>
