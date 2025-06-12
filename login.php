<?php
session_start();

include 'db.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_input = $_POST['username'] ?? '';
    $password_input = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    
    if (!$stmt) {
        $error_message = "Terjadi kesalahan database. Silakan coba lagi nanti. (" . $conn->error . ")";
    } else {
        $stmt->bind_param("s", $username_input);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashed_password_from_db = $row['password'];

            if (password_verify($password_input, $hashed_password_from_db)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username_input;
                header('Location: index.php');
                exit;
            } else {
                $error_message = "Username atau password salah.";
            }
        } else {
            $error_message = "Username atau password salah.";
        }
        $stmt->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengurus Permata GBKP</title>
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
        .login-container {
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
        .login-container h2 {
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
        .register-link {
            display: block;
            margin-top: 15px;
            color: #002366;
            text-decoration: none;
        }
        .register-link:hover {
            text-decoration: underline;
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
    <div class="login-container">
        <h2>Login Pengurus Permata GBKP</h2>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn-primary">Login</button>
            <p><a href="register.php" class="register-link">Belum punya akun? Daftar di sini</a></p>
        </form>
    </div>
</body>
</html>