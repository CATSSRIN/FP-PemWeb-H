<?php
include '../header.php';

$cards = [
    [
        'type' => 'image',
        'img_src' => 'asset/gedung1.jpg',
        'img_alt' => 'Gedung 1',
        'title' => 'GBKP Runggun Surabaya',
        'location' => 'Jl. Mayjen HR. Muhammad No.275, Pradahkalikendal, Kec. Dukuhpakis, Surabaya, Jawa Timur 60226',
        'url' => 'permata_crud/index.php',
        'provinsi' => 'jatim'
    ],
    [
        'type' => 'image',
        'img_src' => 'asset/gedung2.jpg',
        'img_alt' => 'Gedung 2',
        'title' => 'GBKP Runggun Semarang',
        'location' => 'Jl. Semeru Dalam I No.5, Karangrejo, Kec. Gajahmungkur, Kota Semarang, Jawa Tengah 50231',
        'url' => 'permata_crud2/index.php',
        'provinsi' => 'jateng'
    ],
    [
        'type' => 'image',
        'img_src' => 'asset/gedung3.jpg',
        'img_alt' => 'Gedung 3',
        'title' => 'GBKP Runggun Cijantung',
        'location' => 'RT.1/RW.2, Cijantung, Pasar Rebo, East Jakarta City, Jakarta 13770',
        'url' => 'permata_crud3/index.php',
        'provinsi' => 'jakarta'
    ],
    [
        'type' => 'placeholder',
        'img_src' => 'asset/new_image_3.jpg',
        'img_alt' => 'Deskripsi Gambar Baru 4',
        'leader' => 'Nama Pemimpin/Pengelola Baru 4',
        'title' => 'Judul Kartu Baru 4 (Misal: Klenteng Sanggar Agung)',
        'location' => 'Lokasi Baru 4 (Misal: Kenjeran, Surabaya)',
        'url' => 'detail_klenteng.php',
        'provinsi' => ''
    ]

];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Jemaat</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <link rel="stylesheet" href="style.css">

    <h1 style="color: #fff; margin-left: 20px; margin-top: 100px; justify-content: center;">
        Daftar Gereja</h1>
    <nav class="filter-buttons" style="margin-top: 10px;">
        <div class="dropdown">
            <button class="filter-btn" onclick="toggleDropdown('jatim-dropdown')">
                Provinsi <i class="fas fa-chevron-down"></i>
            </button>
            <div class="dropdown-content" id="jatim-dropdown">
                <button class="dropdown-item" onclick="selectDropdownItem(this, 'all')">Semua</button>
                <button class="dropdown-item" onclick="selectDropdownItem(this, 'jatim')">Jawa Timur</button>
                <button class="dropdown-item" onclick="selectDropdownItem(this, 'jateng')">Jawa Tengah</button>
                <button class="dropdown-item" onclick="selectDropdownItem(this, 'jakarta')">Jakarta</button>
            </div>
        </div>
    </nav>

    <main class="item-grid">
        <?php foreach ($cards as $card): ?>
            <?php

            $isClickable = isset($card['url']) && !empty($card['url']);
            if ($isClickable) {

                echo '<a href="' . htmlspecialchars($card['url']) . '" class="card-link">';
            }
            ?>
            <div class="item-card" data-provinsi="<?= htmlspecialchars($card['provinsi']); ?>">
                <div class="card-image-placeholder">
                    <ul>
                        <?php if ($card['type'] === 'image' && !empty($card['img_src'])): ?>
                            <img src="<?php echo htmlspecialchars($card['img_src']); ?>"
                                alt="<?php echo htmlspecialchars($card['img_alt']); ?>">
                        <?php elseif ($card['type'] === 'placeholder'): ?>
                            <i class="fas fa-image image-icon"></i>
                            <?php if (!empty($card['placeholder_leader'])): ?>
                                <div class="price-tag">
                                    <?php if (!empty($card['placeholder_leader_prefix'])): ?>
                                        <span><?php echo htmlspecialchars($card['placeholder_leader_prefix']); ?></span>
                                    <?php endif; ?>
                                    <?php echo htmlspecialchars($card['placeholder_leader']); ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="card-content">
                    <?php if ($card['type'] === 'image' && !empty($card['leader'])): ?>
                        <p style="font-size: 0.9em; color: var(--secondary-text-color); margin-bottom: 4px; margin-top: 0;">
                            Contact: <?php echo htmlspecialchars($card['leader']); ?></p>
                    <?php endif; ?>
                    <p class="item-title"><?php echo htmlspecialchars($card['title']); ?></p>
                    <p class="item-location"><i class="fas fa-map-marker-alt"></i>
                        <?php echo htmlspecialchars($card['location']); ?></p>
                </div>
            </div>
            <?php
            if ($isClickable) {
                echo '</a>';
            }
            ?>
        <?php endforeach; ?>
    </main>
    </div>

    <script src="script.js"></script>
    <script>
        function selectDropdownItem(button, provinsi) {
            const allCards = document.querySelectorAll('.item-card');
            allCards.forEach(card => {
                const cardProvinsi = card.getAttribute('data-provinsi');
                if (provinsi === 'all' || cardProvinsi === provinsi) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
            const items = document.querySelectorAll('.dropdown-item');
            items.forEach(item => item.classList.remove('selected'));
            button.classList.add('selected');
        }

        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('show');
        }

        window.onclick = function (e) {
            if (!e.target.matches('.filter-btn')) {
                document.querySelectorAll('.dropdown-content').forEach(d => d.classList.remove('show'));
            }
        };
        const menuToggle = document.getElementById('menuToggle');
        const mainNav = document.getElementById('mainNav');

        if (menuToggle && mainNav) {
            menuToggle.addEventListener('click', function () {
                mainNav.classList.toggle('active');
                const isExpanded = mainNav.classList.contains('active');
                menuToggle.setAttribute('aria-expanded', isExpanded);
            });
        }
    </script>

</body>

</html>