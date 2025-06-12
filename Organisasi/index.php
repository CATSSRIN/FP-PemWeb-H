<?php
include '../header.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Permata GBKP</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        }

        .main-nav li, .user-nav li {
            margin-left: 15px;
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
            max-width: 800px;
            margin: 0 auto;
        }

        .contact-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #333;
        }

        .contact-card h3, .contact-card p {
            color: #333;
        }
        .contact-card .text-muted {
            color: #6c757d !important;
        }

        .contact-card .bg-primary-icon {
            background-color: #002366 !important;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
        }
        .form-control:focus {
            border-color: #002366;
            box-shadow: 0 0 0 0.25rem rgba(0, 35, 102, 0.25);
        }

        .contact-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .contact-info-item i {
            font-size: 1.5rem;
            color: #002366;
            width: 40px;
            text-align: center;
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
        }

         @media (max-width: 768px) {
            .app-header .logo {
                font-size: 1.1em;
                padding-left: 15px;
                padding-right: 15px;
            }
            .app-header .logo span {
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
            .user-nav .fa-caret-down {
                display: none;
            }
        }
    </style>
</head>
<body>



    <div class="main-content-area">
        <div class="container main-container">
            <div class="contact-card">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary-icon rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-headset fa-lg text-white"></i>
                        </div>
                        <div>
                            <h3 class="mb-1">Hubungi Kami</h3>
                            <p class="text-muted mb-0">Kirim pesan atau temukan kami di sini</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <h5 class="mb-3">Informasi Kontak</h5>
                            <div class="contact-info-item">
                                <i class="fas fa-map-marker-alt me-3"></i>
                                <span>Jl. Mayjen HR. Muhammad No.275, Pradahkalikendal, Kec. Dukuhpakis, Surabaya, Jawa Timur 60226</span>
                            </div>
                            <div class="contact-info-item">
                                <i class="fas fa-phone-alt me-3"></i>
                                <span>083171752088 (Loren)
                                     <br> 082132281003 (Eginta)</span>
                            </div>
                            <div class="contact-info-item">
                                <i class="fas fa-envelope me-3"></i>
                                <span>kontak@permatagbkp.org</span>
                            </div>
                            <div class="mt-4">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7915.243375410588!2d112.68013549357909!3d-7.283812899999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fd004cb06ecf%3A0x1a1e4a50b18e6182!2sGBKP%20Runggun%20Surabaya!5e0!3m2!1sen!2sid!4v1749183183111!5m2!1sen!2sid" width="100%" height="200" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="mb-3">Kirim Pesan</h5>
                            <form id="contactForm">
                                <div class="mb-3">
                                    <label for="contactName" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="contactName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="contactEmail" class="form-label">Alamat Email</label>
                                    <input type="email" class="form-control" id="contactEmail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="contactMessage" class="form-label">Pesan Anda</label>
                                    <textarea class="form-control" id="contactMessage" rows="5" required></textarea>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </form>
                        </div>
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
        
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Terima kasih! Pesan Anda telah terkirim.');
            this.reset();
        });

    </script>
</body>
</html>