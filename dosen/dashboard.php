<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'dosen') {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Sistem Tata Tertib Kampus</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="lapor.php">Laporkan Pelanggaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tata_tertib.php">Lihat Tata Tertib</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sanksi.php">Lihat Sanksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1 class="display-4">Dashboard Dosen</h1>
            <p class="lead">Selamat datang, Dosen! Anda dapat mengelola pelanggaran, tata tertib, dan melihat sanksi mahasiswa.</p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Laporkan Pelanggaran</h5>
                        <p class="card-text">Laporkan pelanggaran mahasiswa secara langsung.</p>
                        <a href="lapor.php" class="btn btn-primary btn-block">Lapor Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Lihat Tata Tertib</h5>
                        <p class="card-text">Lihat dan pelajari tata tertib kampus.</p>
                        <a href="tata_tertib.php" class="btn btn-success btn-block">Lihat Tata Tertib</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Lihat Sanksi</h5>
                        <p class="card-text">Ketahui daftar sanksi yang diterapkan.</p>
                        <a href="sanksi.php" class="btn btn-warning btn-block">Lihat Sanksi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-5 py-3 bg-primary text-white text-center">
        <div class="container">
            <span>&copy; 2024 Sistem Tata Tertib Kampus. All Rights Reserved.</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
