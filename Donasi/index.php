<?php
include 'header.php'; // Include the header file for session management and database connection
// Mulai session jika belum dimulai (diperlukan untuk $_SESSION['username'])
// Session start is commented out as the header (which used it) is removed.
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Sederhana</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Root variables */
        :root {
            --text-color: #333; /* Default text color */
        }

        /* Global Body Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(to right, #002366, lightcoral); /* Gradient background */
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
            min-height: 100vh;
            padding: 20px; /* Remove top padding as header is gone */
            display: flex; /* For centering the card */
            align-items: center; /* For centering the card vertically */
            justify-content: center; /* For centering the card horizontally */
        }

        /* Styling Konten (Profile Card & Lainnya) */
        .main-container {
            width: 100%;
            max-width: 700px; /* Adjusted max-width */
            margin: 20px auto;
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

        .alert-success { /* Kept for generic success message */
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(25, 135, 84, 0.1) 100%);
            border: 1px solid rgba(40, 167, 69, 0.2);
            color: #155724;
        }
        .alert-success i {
            color: inherit;
        }
         .profile-card .bg-primary-icon { /* Custom class for the icon background */
            background-color: #002366 !important; /* Match a theme color */
        }

    </style>
</head>
<body>
    <!-- Header is removed -->

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

                <!-- Bill status alert is removed -->

                <div id="paymentMethodsContainer" class="mb-4">
                    <!-- Payment methods will be loaded here by JavaScript -->
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // --- Script untuk Konten (Payment Card) ---
        let selectedPaymentMethod = null;
        // billsData and related logic are removed

        // Function to load and display payment methods
        function loadPaymentMethods() {
            const container = document.getElementById('paymentMethodsContainer');
            container.innerHTML = ''; // Clear previous methods
            const payButton = document.getElementById('payButton');

            const methods = [
                { name: 'Transfer Bank BNI', icon: 'fa-university', details: 'No. Rek: 4820055550 <br> a/n Caezarlov nugraha' },
                { name: 'Virtual Account Mandiri', icon: 'fa-credit-card', details: 'VA: 1728216177' },
                { name: 'QRIS', icon: 'fa-wallet', details: 'Scan QR Code yang tersedia' },
                //{ name: 'GoPay', icon: 'fa-mobile-alt', details: 'Bayar melalui aplikasi GoPay' },
                //{ name: 'OVO', icon: 'fa-mobile-alt', details: 'Bayar melalui aplikasi OVO' },
                //{ name: 'DANA', icon: 'fa-mobile-alt', details: 'Bayar melalui aplikasi DANA' }
            ];

            const row = document.createElement('div');
            row.className = 'row';

            methods.forEach(method => {
                const col = document.createElement('div');
                col.className = 'col-md-6 mb-3'; // Adjusted for 2 columns on medium screens
                const optionDiv = document.createElement('div');
                // Added h-100 and flex for consistent height and content centering
                optionDiv.className = 'payment-option text-center h-100 d-flex flex-column justify-content-center';
                optionDiv.innerHTML = `
                    <h5><i class="fas ${method.icon} me-2"></i>${method.name}</h5>
                    <p class="small text-muted mb-0">${method.details}</p>
                `;
                optionDiv.onclick = () => {
                    document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('selected'));
                    optionDiv.classList.add('selected');
                    selectedPaymentMethod = method.name;
                    payButton.disabled = false; // Enable button on selection
                };
                col.appendChild(optionDiv);
                row.appendChild(col);
            });
            container.appendChild(row);
             // If there are no payment methods (e.g., methods array is empty), disable button
            if(methods.length === 0){
                payButton.disabled = true;
            }
        }

        // Simplified function to process a generic payment
        function processGenericPayment() {
            if (!selectedPaymentMethod) {
                alert('Silakan pilih metode pembayaran terlebih dahulu.');
                return;
            }

            // Simulate payment processing
            const genericSuccessAlert = document.getElementById('genericSuccessAlert');
            const genericSuccessMessage = document.getElementById('genericSuccessMessage');

            genericSuccessMessage.textContent = `Pembayaran dengan metode ${selectedPaymentMethod} sedang diproses!`;
            genericSuccessAlert.classList.remove('d-none');

            // Disable button to prevent multiple submissions
            const payButton = document.getElementById('payButton');
            payButton.disabled = true;
            payButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';


            // Simulate a delay for processing
            setTimeout(() => {
                genericSuccessMessage.textContent = `Pembayaran dengan metode ${selectedPaymentMethod} telah berhasil diproses.`;
                // Optionally, reset the selection and button
                // selectedPaymentMethod = null;
                // document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('selected'));
                // payButton.disabled = true; // Or false if you want to allow another immediate payment
                 payButton.innerHTML = '<i class="fas fa-shield-alt me-2"></i>Proses Pembayaran Lain';
                 payButton.disabled = true; // Keep disabled or re-enable based on desired flow
                 document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('selected'));
                 selectedPaymentMethod = null;


                // Hide the success message after a few more seconds
                setTimeout(() => {
                    genericSuccessAlert.classList.add('d-none');
                     payButton.innerHTML = '<i class="fas fa-shield-alt me-2"></i>Proses Pembayaran';
                     // Re-enable if needed: payButton.disabled = true; (if no method selected yet)
                }, 4000);

            }, 2500); // Simulate 2.5 seconds processing time
        }

        // Initial setup when the DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            loadPaymentMethods(); // Load payment methods on page load
            // updatePaymentStatus(); // This function is no longer needed in its original form
            const payButton = document.getElementById('payButton');
            if (payButton) { // Ensure button exists
                 payButton.disabled = true; // Initially disable pay button until a method is selected
            }
        });
    </script>
</body>
</html>
