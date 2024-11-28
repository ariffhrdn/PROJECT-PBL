<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

$query = "SELECT jenis_pelanggaran, COUNT(*) as jumlah FROM laporan_pelanggaran GROUP BY jenis_pelanggaran";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Statistik Pelanggaran</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Statistik Pelanggaran</h1>
    <table>
        <thead>
            <tr>
                <th>Jenis Pelanggaran</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['jenis_pelanggaran'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
