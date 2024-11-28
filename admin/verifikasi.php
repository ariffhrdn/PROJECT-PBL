<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// Query untuk mendapatkan laporan pelanggaran
$query = "SELECT * FROM laporan_pelanggaran WHERE status = 'Belum Diverifikasi'";
$result = sqlsrv_query($conn, $query);

// Cek jika query gagal
if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Laporan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Verifikasi Laporan Pelanggaran</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pelapor</th>
                <th>Jenis Pelanggaran</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row['id_laporan'] ?></td>
                    <td><?= $row['nama_pelapor'] ?></td>
                    <td><?= $row['jenis_pelanggaran'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <a href="proses_verifikasi.php?id=<?= $row['id_laporan'] ?>">Verifikasi</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
