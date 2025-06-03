<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar - Booking Lapangan Futsal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Registrasi Pengguna</h1>
        <nav>
            <a href="index.php">Beranda</a>
        </nav>
    </header>

    <main>
        <section class="intro">
            <?php
            if (isset($_GET['error'])) {
                $msg = '';
                switch ($_GET['error']) {
                    case 'empty':
                        $msg = 'Username dan password tidak boleh kosong.';
                        break;
                    case 'duplicate':
                        $msg = 'Username sudah digunakan.';
                        break;
                    case 'invalidusername':
                        $msg = 'Username harus 4-20 karakter.';
                        break;
                    case 'failed':
                        $msg = 'Registrasi gagal, silakan coba lagi.';
                        break;
                }
                echo "<p style='color:red;'>$msg</p>";
            }
            ?>
            <form action="register_process.php" method="POST">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br><br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <button type="submit">Daftar</button>
            </form>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Booking Futsal. All rights reserved.</p>
    </footer>
</body>
</html>