<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Pendataan Jemaat</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Login Admin Sistem Pendataan Jemaat</h1>
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
                    case 'nouser':
                        $msg = 'Username tidak ditemukan.';
                        break;
                    case 'wrongpassword':
                        $msg = 'Password salah.';
                        break;
                }
                echo "<p style='color:red;'>$msg</p>";
            }
            ?>
            <form action="login_process.php" method="POST">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br><br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <button type="submit">Login</button>
            </form>
            </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Gereja XYZ. All rights reserved.</p>
    </footer>
</body>
</html>