<?php
include 'db.php';

$success_message = '';
$error_message = '';

if (isset($_POST['register'])) {
    $username = trim($_POST['username'] ?? '');
    $password_raw = $_POST['password'] ?? '';

    if (empty($username) || empty($password_raw)) {
        $error_message = "Username dan password tidak boleh kosong.";
    } elseif (strlen($username) < 3 || strlen($username) > 50) {
        $error_message = "Username harus antara 3 hingga 50 karakter.";
    } elseif (strlen($password_raw) < 6) {
        $error_message = "Password minimal 6 karakter.";
    } else {
        $password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);

        $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        if (!$check_stmt) {
            $error_message = "Database query error: " . $conn->error;
        } else {
            $check_stmt->bind_param("s", $username);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows > 0) {
                $error_message = "Username sudah digunakan!";
            } else {
                $insert_stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                if (!$insert_stmt) {
                    $error_message = "Database query error: " . $conn->error;
                } else {
                    $insert_stmt->bind_param("ss", $username, $password_hashed);

                    if ($insert_stmt->execute()) {
                        $success_message = "Registrasi berhasil! Silakan login.";
                    } else {
                        $error_message = "Gagal mendaftar, coba lagi. Error: " . $conn->error;
                    }
                    $insert_stmt->close();
                }
            }
            $check_stmt->close();
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun Admin Gereja</title>
    <link rel="stylesheet" href="Pendataan_jemaat/style-login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to right, #002366, lightcoral);
            font-family: Arial, sans-serif;
            color: #333;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .register-container h2 {
            margin-bottom: 25px;
            color: #002366;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }
        .btn-primary {
            background-color: #002366;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #001a4d;
        }
        .login-link {
            display: block;
            margin-top: 15px;
            color: #002366;
            text-decoration: none;
        }
        .login-link:hover {
            text-decoration: underline;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Registrasi Akun Admin Gereja</h2>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="register.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn-primary">Daftar</button>
            <p><a href="login.php" class="login-link">Sudah punya akun? Login di sini!</a></p>
        </form>
    </div>
</body>
</html>