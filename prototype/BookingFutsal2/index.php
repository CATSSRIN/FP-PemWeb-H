<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Pendataan Jemaat Gereja XYZ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Sistem Pendataan Jemaat Gereja XYZ</h1>
        <nav>
            <a href="login.php">Login Admin</a>
            </nav>
    </header>

    <main>
        <section class="intro">
            <h2>Selamat Datang di Sistem Pendataan Jemaat</h2>
            <p>Ini adalah platform digital untuk mengelola data jemaat Gereja XYZ secara efisien dan terpusat.</p>
        </section>

        <section class="tentang-kami intro">
            <h3>Tentang Gereja Kami</h3>
            <p>Deskripsi singkat tentang gereja, visi, misi, atau informasi umum lainnya.
            Kami berkomitmen untuk melayani jemaat dengan kasih dan membangun komunitas iman yang kuat.</p>

            <ul style="list-style: none; padding-left: 0;">
                <li><strong>📍 Alamat Gereja:</strong> Jl. Contoh Alamat No. 1, Kota Kasih, Indonesia</li>
                <li><strong>📞 Nomor Kontak:</strong> 0812-0000-0000</li>
                <li><strong>📧 Email:</strong> info@gerejaxyz.org</li>
                <li><strong>⏰ Jadwal Ibadah Utama:</strong> Minggu, Pk. 09:00</li>
            </ul>
        </section>
        
        </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Gereja XYZ. All rights reserved.</p>
    </footer>

    </body>
</html>