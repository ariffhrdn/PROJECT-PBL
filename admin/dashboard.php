<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Sistem Tata Tertib Kampus</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="verifikasi.php">Verifikasi Laporan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kategori.php">Kelola Kategori Sanksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tata_tertib.php">Kelola Tata Tertib</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="statistik.php">Statistik Pelanggaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1 class="display-4">Dashboard Admin</h1>
            <p class="lead">Selamat datang, Admin! Anda dapat mengelola laporan, kategori sanksi, tata tertib, dan statistik pelanggaran mahasiswa.</p>
        </div>

        <!-- Action Cards -->
        <div class="row">
            <!-- Card 1: Verifikasi Laporan -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Verifikasi Laporan</h5>
                        <p class="card-text">Verifikasi laporan pelanggaran yang dikirimkan oleh dosen.</p>
                        <a href="verifikasi.php" class="btn btn-info btn-block">Verifikasi Laporan</a>
                    </div>
                </div>
            </div>
            <!-- Card 2: Kelola Kategori Sanksi -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kelola Kategori Sanksi</h5>
                        <p class="card-text">Kelola kategori sanksi yang diterapkan untuk pelanggaran tata tertib.</p>
                        <a href="kategori.php" class="btn btn-warning btn-block">Kelola Kategori</a>
                    </div>
                </div>
            </div>
            <!-- Card 3: Kelola Tata Tertib -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kelola Tata Tertib</h5>
                        <p class="card-text">Kelola dan update tata tertib yang berlaku di kampus.</p>
                        <a href="tata_tertib.php" class="btn btn-success btn-block">Kelola Tata Tertib</a>
                    </div>
                </div>
            </div>
            <!-- Card 4: Statistik Pelanggaran -->
            <div class="col-md-4 mt-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Statistik Pelanggaran</h5>
                        <p class="card-text">Lihat statistik terkait pelanggaran yang terjadi di kampus.</p>
                        <a href="statistik.php" class="btn btn-danger btn-block">Lihat Statistik</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5 py-3 bg-primary text-white text-center">
        <div class="container">
            <span>&copy; 2024 Sistem Tata Tertib Kampus. All Rights Reserved.</span>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
