<?php
include 'Pendataan_jemaat/permata_crud/db.php';

if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']); 

// fungsi cek username, apakah username sudah ada apa belum
  $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
  if (mysqli_num_rows($check) > 0) {
    $error = "Username sudah digunakan!";
  } else {
// jika username tidak ada, maka akan membuat akun baru
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
<link rel="stylesheet" href="Pendataan_jemaat/style-login.css">

<head>
  <title>Register User</title>
</head>

<body>
  <h2>Registrasi Akun Admin Gereja</h2>

  <?php
  if (isset($success))
    echo "<p style='color:green;'>$success</p>";
  if (isset($error))
    echo "<p style='color:red;'>$error</p>";
  ?>

  <form method="post">
    <p>Username: <input type="text" name="username" required></p>
    <p>Password: <input type="password" name="password" required></p>
    <input type="submit" name="register" value="Daftar">
        <p><a href="login.php">Sudah punya akun? Login disini!</a></p>
  </form>
</body>

</html>