<?php
// Define an array of card data.
// In a real application, this data might come from a database.
$cards = [
    [
        'type' => 'image', // Custom type to differentiate
        'img_src' => 'asset/gedung1.jpg',
        'img_alt' => 'Gedung 1',
        'leader' => 'Pdt. Krismas Imanta Barus, M.Th, LM',
        'title' => 'Gereja Batak Karo Protestan (GBKP)',
        'location' => 'Jl. Mayjen HR. Muhammad No.275, Pradahkalikendal, Kec. Dukuhpakis, Surabaya, Jawa Timur 60226',
        'url' => 'permata_crud/index.php'
    ],
    [
        'type' => 'placeholder', // Custom type
        'placeholder_leader_prefix' => 'Dipimpin:',
        'placeholder_leader' => 'Pak Sutrisno',
        'title' => 'Ini nama gedung',
        'location' => 'Lokasi Lain, Kota Lain'
    ]
    // Add more card data arrays here
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="dark-mode">
    <div class="container">
        <header class="header-section">
            <div class="search-bar">
                <i class="fas fa-search search-icon"></i>
                <input type="text" placeholder="Search">
            </div>
            <div class="filter-icon-wrapper">
                <i class="fas fa-sliders-h filter-icon"></i>
            </div>
        </header>

        <nav class="filter-buttons">
            <div class="dropdown">
                <button class="filter-btn" onclick="toggleDropdown('jatim-dropdown')">
                    Jawa Timur <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-content" id="jatim-dropdown">
                    <button class="dropdown-item" onclick="selectDropdownItem(this, 'Jawa Timur')">Surabaya</button>
                    <button class="dropdown-item" onclick="selectDropdownItem(this, 'Jawa Timur')">Sidoarjo</button>
                    <button class="dropdown-item" onclick="selectDropdownItem(this, 'Jawa Timur')">Gresik</button>
                </div>
            </div>

            <div class="dropdown">
                <button class="filter-btn" onclick="toggleDropdown('jateng-dropdown')">
                    Jawa Tengah <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-content" id="jateng-dropdown">
                    <button class="dropdown-item" onclick="selectDropdownItem(this, 'Jawa Tengah')">Semarang</button>
                    <button class="dropdown-item" onclick="selectDropdownItem(this, 'Jawa Tengah')">Solo</button>
                </div>
            </div>

            <div class="dropdown">
                <button class="filter-btn" onclick="toggleDropdown('jabar-dropdown')">
                    Jawa Barat <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-content" id="jabar-dropdown">
                    <button class="dropdown-item" onclick="selectDropdownItem(this, 'Jawa Barat')">Bandung</button>
                    <button class="dropdown-item" onclick="selectDropdownItem(this, 'Jawa Barat')">Bogor</button>
                </div>
            </div>
        </nav>

<main class="item-grid">
    <?php foreach ($cards as $card): ?>
        <?php
        // Check if a URL is set for this card
        $isClickable = isset($card['url']) && !empty($card['url']);
        if ($isClickable) {
            // Start the anchor tag if the card is clickable
            echo '<a href="' . htmlspecialchars($card['url']) . '" class="card-link">';
        }
        ?>
        <div class="item-card">
            <div class="card-image-placeholder">
                <?php if ($card['type'] === 'image' && !empty($card['img_src'])): ?>
                    <img src="<?php echo htmlspecialchars($card['img_src']); ?>" alt="<?php echo htmlspecialchars($card['img_alt']); ?>">
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
                <div class="bookmark-icon"><i class="far fa-bookmark"></i></div>
            </div>
            <div class="card-content">
                <?php if ($card['type'] === 'image' && !empty($card['leader'])): ?>
                    <p style="font-size: 0.9em; color: var(--secondary-text-color); margin-bottom: 4px; margin-top: 0;">Dipimpin: <?php echo htmlspecialchars($card['leader']); ?></p>
                <?php endif; ?>
                <p class="item-title"><?php echo htmlspecialchars($card['title']); ?></p>
                <p class="item-location"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($card['location']); ?></p>
            </div>
        </div>
        <?php
        if ($isClickable) {
            // Close the anchor tag if the card was clickable
            echo '</a>';
        }
        ?>
    <?php endforeach; ?>
        </main>
    </div>

    <script src="script.js"></script>
</body>
</html>