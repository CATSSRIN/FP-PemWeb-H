<?php
// Mulai session jika belum dimulai (diperlukan untuk $_SESSION['username'])
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Permata GBKP</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Root variables */
        :root {
            --text-color: #333;
            --primary-color: #002366;
            --secondary-color: #f8f9fa;
        }

        /* Global Body Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(to right, var(--primary-color), lightcoral);
            color: var(--text-color);
            min-height: 100vh;
            padding-top: 60px; /* Space for the fixed header */
        }

        /* --- Styling Header (Sama seperti halaman lain) --- */
        .app-header {
            background-color: #333;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 60px;
        }
        .app-header .logo a { color: white; text-decoration: none; display: flex; align-items: center; }
        .app-header .logo a i { margin-right: 8px; }
        .main-nav ul, .user-nav ul { list-style: none; padding: 0; margin: 0; display: flex; align-items: center; }
        .main-nav li, .user-nav li { margin-left: 15px; }
        .main-nav a, .user-nav a { color: white; text-decoration: none; display: flex; align-items: center; font-size: 0.85em; padding: 8px 10px; border-radius: 5px; transition: background-color 0.3s ease; }
        .main-nav a:hover, .user-nav a:hover { background-color: #555; }
        .main-nav a i, .user-nav a i { margin-right: 6px; }
        .dropdown { position: relative; display: inline-block; }
        .dropdown-content { display: none; position: absolute; background-color: #f9f9f9; min-width: 170px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2); z-index: 1001; border-radius: 5px; right: 0; top: 100%; }
        .dropdown-content a, .dropdown-content div { color: black; padding: 10px 14px; text-decoration: none; display: block; font-size: 0.9em; border-bottom: 1px solid #eee; }
        .dropdown:hover .dropdown-content { display: block; }
        .menu-toggle { display: none; background: none; border: none; color: white; font-size: 1.5em; cursor: pointer; }


        /* --- Styling Konten Dashboard --- */
        .main-content-area {
            padding: 20px;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #333;
            margin-bottom: 20px;
            padding: 25px;
        }

        .summary-card {
            display: flex;
            align-items: center;
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .summary-card .icon {
            font-size: 2.5rem;
            width: 70px;
            height: 70px;
            line-height: 70px;
            text-align: center;
            border-radius: 50%;
            margin-right: 20px;
            color: white;
        }
        
        .summary-card .icon.bg-donasi { background-color: #28a745; }
        .summary-card .icon.bg-jemaat { background-color: #17a2b8; }
        .summary-card .icon.bg-kegiatan { background-color: #ffc107; }
        .summary-card .icon.bg-user { background-color: #dc3545; }

        .summary-card .info .number {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }

        .summary-card .info .label {
            font-size: 1rem;
            color: #6c757d;
        }

        .dashboard-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .dashboard-card-header h5 {
            margin: 0;
            font-weight: bold;
            color: var(--primary-color);
        }

        .table-responsive {
            margin-top: 10px;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        
        .table thead th {
            color: #6c757d;
            border: none;
            font-weight: 500;
        }

        .table tbody tr {
            background-color: var(--secondary-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-radius: 8px;
        }
        
        .table td, .table th {
            border-top: none;
            padding: 15px;
            vertical-align: middle;
        }

        .table tbody tr td:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
        .table tbody tr td:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }

        .badge {
            padding: 8px 12px;
            font-size: 0.8em;
            border-radius: 20px;
        }
        
        /* --- Responsif --- */
        @media (max-width: 992px) {
            .main-nav { display: none; flex-direction: column; position: absolute; top: 60px; left: 0; width: 100%; background-color: #333; }
            .main-nav.active { display: flex; }
            .menu-toggle { display: block; order: -1; }
        }

    </style>
</head>
<body>

    <header class="app-header">
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="logo">
            <a href="index.php"><i class="fas fa-church"></i> <span>Permata GBKP</span></a>
        </div>

        <nav class="main-nav" id="mainNav">
            <ul>
                <li><a href="Pendataan_jemaat/index.php"><i class="fas fa-users"></i> Pendataan Jemaat</a></li>
                <li><a href="Donasi/index.php"><i class="fas fa-hand-holding-heart"></i> Donasi & Perpuluhan</a></li>
                <li><a href="Organisasi/index.php"><i class="fas fa-sitemap"></i> Organisasi Gereja</a></li>
                <li><a href="Contact_us/index.php"><i class="fas fa-link"></i> Stay Connected</a></li>
            </ul>
        </nav>

        <nav class="user-nav">
            <ul>
                <li class="dropdown">
                    <a href="#" class="language-switcher"><i class="fas fa-globe"></i> <span>Bahasa</span> <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="#">Indonesia</a>
                        <a href="#">English</a>
                    </div>
                </li>
                <li><a href="#"><i class="fas fa-bell"></i></a></li>
                <li class="dropdown">
                    <a href="#"><i class="fas fa-user-circle"></i> <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <div class="username-display p-2">
                            <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>
                        </div>
                        <a href="register.php">register</a>
                        <a href="login.php">Login</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <div class="main-content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card summary-card h-100">
                        <div class="icon bg-donasi"><i class="fas fa-hand-holding-heart"></i></div>
                        <div class="info">
                            <div class="number">Rp 12.550.000</div>
                            <div class="label">Total Donasi Bulan Ini</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card summary-card h-100">
                        <div class="icon bg-jemaat"><i class="fas fa-users"></i></div>
                        <div class="info">
                            <div class="number">1,204</div>
                            <div class="label">Total Jemaat Aktif</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card summary-card h-100">
                        <div class="icon bg-kegiatan"><i class="fas fa-calendar-check"></i></div>
                        <div class="info">
                            <div class="number">8</div>
                            <div class="label">Kegiatan Mendatang</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card summary-card h-100">
                        <div class="icon bg-user"><i class="fas fa-user-plus"></i></div>
                        <div class="info">
                            <div class="number">15</div>
                            <div class="label">Pendaftar Baru</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="dashboard-card h-100">
                        <div class="dashboard-card-header">
                            <h5><i class="fas fa-receipt me-2"></i>Transaksi Donasi Terbaru</h5>
                            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Donatur</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Metode</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Budi Santoso</td>
                                        <td>05 Juni 2025</td>
                                        <td>Rp 500.000</td>
                                        <td>Transfer BNI</td>
                                        <td><span class="badge bg-success-subtle text-success-emphasis">Berhasil</span></td>
                                    </tr>
                                    <tr>
                                        <td>Anonymous</td>
                                        <td>04 Juni 2025</td>
                                        <td>Rp 250.000</td>
                                        <td>QRIS</td>
                                        <td><span class="badge bg-success-subtle text-success-emphasis">Berhasil</span></td>
                                    </tr>
                                     <tr>
                                        <td>Maria Garcia</td>
                                        <td>03 Juni 2025</td>
                                        <td>Rp 1.000.000</td>
                                        <td>Virtual Account</td>
                                        <td><span class="badge bg-warning-subtle text-warning-emphasis">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>Johnathan Chen</td>
                                        <td>02 Juni 2025</td>
                                        <td>Rp 75.000</td>
                                        <td>GoPay</td>
                                        <td><span class="badge bg-success-subtle text-success-emphasis">Berhasil</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="dashboard-card h-100">
                        <div class="dashboard-card-header">
                            <h5><i class="fas fa-chart-pie me-2"></i>Sumber Donasi</h5>
                        </div>
                        <canvas id="donationSourceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
  
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('mainNav').classList.toggle('active');
        });


        const ctx = document.getElementById('donationSourceChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Transfer Bank', 'Virtual Account', 'QRIS', 'GoPay'],
                datasets: [{
                    label: 'Sumber Donasi',
                    data: [45, 25, 20, 10],
                    backgroundColor: [
                        '#003399',
                        '#17a2b8',
                        '#ffc107',
                        '#28a745'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += context.parsed + '%';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>