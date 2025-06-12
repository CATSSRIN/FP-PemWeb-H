<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi - Pembayaran</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --text-color: #333;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(to right, #002366, lightcoral);
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
            min-height: 100vh;
            padding-top: 70px;
        }


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

        .app-header .logo {
            font-size: 1.3em;
            font-weight: bold;
        }
        .app-header .logo a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .app-header .logo a i {
            margin-right: 8px;
        }
        .app-header .logo span {
            display: inline-block;
        }


        .main-nav ul, .user-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            height: 100%;
        }

        .main-nav li, .user-nav li {
            margin-left: 15px;
            display: flex;
            align-items: center;
        }

        .main-nav a, .user-nav a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 0.85em;
            padding: 8px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .main-nav a:hover,
        .user-nav a:hover,
        .user-nav .dropdown > a:hover {
            background-color: #555;
        }

        .main-nav a i, .user-nav a i {
            margin-right: 6px;
            font-size: 1em;
        }

        .user-nav .language-switcher i, .user-nav .profile-icon {
             font-size: 1.1em;
        }
        .user-nav .fa-caret-down {
            font-size: 0.8em;
            margin-left: 4px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 170px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1001;
            border-radius: 5px;
            right: 0;
            top: 100%;
        }

        .dropdown-content a, .dropdown-content div.username-display {
            color: black;
            padding: 10px 14px;
            text-decoration: none;
            display: block;
            font-size: 0.9em;
            border-bottom: 1px solid #eee;
        }
        .dropdown-content div.username-display {
            font-weight: bold;
             white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dropdown-content a:last-child {
            border-bottom: none;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5em;
            cursor: pointer;
            padding: 0 10px;
        }

        .main-content-area {
            padding: 20px;
        }
        .main-container {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #333;
        }

        .profile-card h3, .profile-card p {
            color: #333;
        }
        .profile-card .text-muted {
            color: #6c757d !important;
        }

        .payment-option {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .payment-option:hover {
            border-color: #002366;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 35, 102, 0.2);
        }

        .payment-option.selected {
            border-color: #002366;
            background-color: rgba(0, 35, 102, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #002366 0%, #003399 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 30px;
            font-weight: 500;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 35, 102, 0.3);
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(25, 135, 84, 0.1) 100%);
            border: 1px solid rgba(40, 167, 69, 0.2);
            color: #155724;
        }
        .alert-success i {
            color: inherit;
        }
         .profile-card .bg-primary-icon {
            background-color: #002366 !important;
        }

        @media (max-width: 992px) {
            .main-nav {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                background-color: #333;
                padding: 10px 0;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            }
            .main-nav.active {
                display: flex;
            }
            .main-nav li {
                margin: 10px 20px;
                width: calc(100% - 40px);
            }
            .main-nav a {
                justify-content: center;
                 padding: 12px 10px;
            }

            .menu-toggle {
                display: flex;
                align-items: center;
                order: -1;
            }
            .app-header .logo {
                margin: 0 auto;
                padding-left: 40px;
                padding-right: 40px;
            }
             .user-nav {
            }
        }

         @media (max-width: 768px) {
            .app-header .logo {
                font-size: 1.1em;
                padding-left: 15px;
                padding-right: 15px;
            }
            .app-header .logo span{
                 display: none;
            }
            .main-nav a {
                font-size: 0.9em;
            }
             .user-nav li {
                margin-left: 8px;
            }
            .user-nav a {
                font-size: 0.8em;
                padding: 6px 8px;
            }
             .user-nav .language-switcher span {
                display: none;
            }
            .payment-option {
                padding: 15px;
            }
        }
         @media (max-width: 480px) {
            .app-header .logo {
                 display: none;
            }
            .menu-toggle {
                 margin-right: auto;
            }
             .user-nav a {
                padding: 5px;
            }
             .user-nav a i {
                margin-right: 3px;
            }
            .user-nav .fa-caret-down{
                display: none;
            }
             .user-nav .profile-icon + .sr-only + .fa-caret-down {
                display: none;
            }
        }

    </style>
</head>
<body>

    <header class="app-header">
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>

        <div class="logo">
            <a href="../index.php"><i class="fas fa-church"></i> <span>Permata GBKP</span></a>
        </div>

        <nav class="main-nav" id="mainNav">
            <ul>
                <li><a href=../Pendataan_jemaat/index.php><i class="fas fa-users"></i> Pendataan Jemaat</a></li>
                <li><a href="#donasi"><i class="fas fa-hand-holding-heart"></i> Donasi & Perpuluhan</a></li>
                <li><a href="../Organisasi/index.php"><i class="fas fa-sitemap"></i> Organisasi Gereja</a></li>
                <li><a href="../Contact_us/index.php"><i class="fas fa-link"></i> Stay Connected</a></li>
            </ul>
        </nav>

        <nav class="user-nav">
            <ul>
                <li class="dropdown">
                    <a href="#" class="language-switcher" onclick="return false;" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe"></i> <span>Bahasa</span> <i class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="?lang=id">Indonesia</a>
                        <a href="?lang=en">English</a>
                    </div>
                </li>
                <li>
                    <a href="#notifikasi" aria-label="Notifikasi">
                        <i class="fas fa-bell"></i> <span class="sr-only">Notifikasi</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" onclick="return false;" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle profile-icon"></i> <span class="sr-only">Profil Pengguna</span> <i class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-content">
                        <div class="username-display">
                            <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>
                        </div>
                        <a href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <div class="main-content-area">
        <div class="container main-container">
            <div class="profile-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary-icon rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-credit-card fa-lg text-white"></i>
                        </div>
                        <div>
                            <h3 class="mb-1">Pembayaran</h3>
                            <p class="text-muted mb-0">Pilih metode pembayaran Anda</p>
                        </div>
                    </div>

                    <div id="paymentMethodsContainer" class="mb-4">
                    </div>

                    <div id="genericSuccessAlert" class="alert alert-success d-none mb-4">
                        <i class="fas fa-check-circle me-2"></i>
                        <span id="genericSuccessMessage"></span>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary btn-lg" id="payButton" disabled onclick="processGenericPayment()">
                            <i class="fas fa-shield-alt me-2"></i>Proses Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const mainNav = document.getElementById('mainNav');

        if (menuToggle && mainNav) {
            menuToggle.addEventListener('click', function() {
                mainNav.classList.toggle('active');
                const isExpanded = mainNav.classList.contains('active');
                menuToggle.setAttribute('aria-expanded', isExpanded);
            });
        }

        let selectedPaymentMethod = null;

        function loadPaymentMethods() {
            const container = document.getElementById('paymentMethodsContainer');
            if (!container) {
                console.error('Payment methods container not found!');
                return;
            }
            container.innerHTML = '';
            const payButton = document.getElementById('payButton');

            const methods = [
                { name: 'Transfer Bank BNI', icon: 'fa-university', details: 'No. Rek: 482-005-5550 <br> a/n Caezarlov nugraha' },
                { name: 'Virtual Account Mandiri', icon: 'fa-credit-card', details: 'VA: 1728216177' },
                { name: 'QRIS', icon: 'fa-wallet', details: 'Scan QR Code yang tersedia' },
                { name: 'GoPay', icon: 'fa-mobile-alt', details: 'Bayar melalui aplikasi GoPay' },
            ];

            const row = document.createElement('div');
            row.className = 'row';

            methods.forEach(method => {
                const col = document.createElement('div');
                col.className = 'col-md-6 mb-3';
                const optionDiv = document.createElement('div');
                optionDiv.className = 'payment-option text-center h-100 d-flex flex-column justify-content-center';
                optionDiv.innerHTML = `
                    <h5><i class="fas ${method.icon} me-2"></i>${method.name}</h5>
                    <p class="small text-muted mb-0">${method.details}</p>
                `;
                optionDiv.onclick = () => {
                    document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('selected'));
                    optionDiv.classList.add('selected');
                    selectedPaymentMethod = method.name;
                    if (payButton) payButton.disabled = false;
                };
                col.appendChild(optionDiv);
                row.appendChild(col);
            });
            container.appendChild(row);

            if(payButton && methods.length === 0){
                payButton.disabled = true;
            }
        }

        function processGenericPayment() {
            if (!selectedPaymentMethod) {
                alert('Silakan pilih metode pembayaran terlebih dahulu.');
                return;
            }

            const genericSuccessAlert = document.getElementById('genericSuccessAlert');
            const genericSuccessMessage = document.getElementById('genericSuccessMessage');
            const payButton = document.getElementById('payButton');

            if (genericSuccessMessage) {
                genericSuccessMessage.textContent = `Pembayaran dengan metode ${selectedPaymentMethod} sedang diproses!`;
            }
            if (genericSuccessAlert) {
                genericSuccessAlert.classList.remove('d-none');
            }

            if (payButton) {
                payButton.disabled = true;
                payButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            }

            setTimeout(() => {
                if (genericSuccessMessage) {
                    genericSuccessMessage.textContent = `Pembayaran dengan metode ${selectedPaymentMethod} telah berhasil diproses.`;
                }
                if (payButton) {
                    payButton.innerHTML = '<i class="fas fa-shield-alt me-2"></i>Proses Pembayaran Lain';
                    payButton.disabled = true;
                }
                document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('selected'));
                selectedPaymentMethod = null;

                setTimeout(() => {
                    if (genericSuccessAlert) {
                        genericSuccessAlert.classList.add('d-none');
                    }
                    if (payButton) {
                         payButton.innerHTML = '<i class="fas fa-shield-alt me-2"></i>Proses Pembayaran';
                         payButton.disabled = true; 
                    }
                }, 4000);

            }, 2500);
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadPaymentMethods();
            const payButton = document.getElementById('payButton');
            if (payButton) {
                 payButton.disabled = true;
            }
        });
    </script>
</body>
</html>