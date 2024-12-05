<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: ../index.php");
    exit;
}

// Query untuk mengambil data sanksi
$query = "SELECT * FROM sanksi";
$result = sqlsrv_query($conn, $query);

// Cek apakah query berhasil
if ($result === false) {
    die(print_r(sqlsrv_errors(), true)); // Debug jika terjadi error pada query
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Sanksi</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        header {
            background-color: #003366;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 36px;
        }

        .navbar {
            background-color: #005b96;
            overflow: hidden;
        }

        .navbar a {
            color: white;
            padding: 14px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .navbar a:hover {
            background-color: #003366;
        }

        .content {
            margin: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #005b96;
            margin-top: 20px;
            display: inline-block;
        }

        a:hover {
            color: #003366;
        }
    </style>
</head>
<body>

    <header>
        <h1>Daftar Sanksi untuk Mahasiswa</h1>
    </header>

    <div class="navbar">
        <a href="dashboard.php">Dashboard</a>
        <a href="lihat_sanksi.php">Lihat Sanksi</a>
        <a href="../logout.php">Logout</a>
    </div>

    <div class="content">
        <h2>Sanksi yang Diberikan</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        <td><?= htmlspecialchars($row['kategori']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="dashboard.php">Kembali ke Dashboard</a>
    </div>

</body>
</html>
