<?php
session_start();
include 'config/database.php'; // Pastikan file ini terhubung dengan benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($conn === null) {
        die("Koneksi ke database gagal. Silakan cek konfigurasi database.");
    }

    // Query menggunakan parameterized statements
    $query = "SELECT * FROM users WHERE username = ?";
    $params = array($username);
    $result = sqlsrv_query($conn, $query, $params);

    if ($result && $user = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        // Verifikasi password menggunakan MD5 (sementara)
        if (md5($password) === $user['password']) {
            // Simpan data sesi
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];

            // Redirect berdasarkan role
            if ($user['role'] == 'admin') {
                header("Location: admin/dashboard.php");
            } elseif ($user['role'] == 'dosen') {
                header("Location: dosen/dashboard.php");
            } elseif ($user['role'] == 'mahasiswa') {
                header("Location: mahasiswa/dashboard.php");
            }
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Kampus</title>
    <link rel="stylesheet" href="login/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('assets/gambar/backpolinema.webp') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .container-login {
            background-color: rgba(255, 255, 255, 0.8); /* Warna transparan pada kontainer login */
            border-radius: 8px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-login vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow" style="max-width: 400px; width: 100%;">
            <div class="card-body">
                <!-- Logo -->
                <div class="text-center mb-4">
                    <img src="assets/gambar/polinema.png" alt="Logo Kampus" class="login-logo" style="max-width: 100px;">
                </div>
                <h3 class="text-center mb-4">SISTEM TATA TERTIB</h3>
                <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                <form method="POST">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <div class="text-center mt-3">
                    <small>&copy; 2024 Sistem Tata Tertib Kampus. All Rights Reserved.</small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
