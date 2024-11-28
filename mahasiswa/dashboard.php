<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
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

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1 class="display-4">Dashboard Mahasiswa</h1>
            <p class="lead">Selamat datang, Mahasiswa! Di sini Anda dapat melihat tata tertib dan sanksi yang diterapkan di kampus.</p>
        </div>

        <!-- Action Cards -->
        <div class="row">
            <!-- Card 1: Lihat Tata Tertib -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Lihat Tata Tertib</h5>
                        <p class="card-text">Pelajari tata tertib kampus untuk menjaga kedisiplinan.</p>
                        <a href="tata_tertib.php" class="btn btn-info btn-block">Lihat Tata Tertib</a>
                    </div>
                </div>
            </div>
            <!-- Card 2: Lihat Sanksi -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Lihat Sanksi</h5>
                        <p class="card-text">Ketahui sanksi yang diterapkan untuk pelanggaran tata tertib.</p>
                        <a href="sanksi.php" class="btn btn-warning btn-block">Lihat Sanksi</a>
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
