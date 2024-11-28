<?php
session_start();
include '../config/database.php';

// Cek sesi dan role
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: ../index.php");
    exit;
}

// Query ke database menggunakan sqlsrv_query
$query = "SELECT * FROM tata_tertib";
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
    <title>Lihat Tata Tertib</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Tata Tertib</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Isi Tata Tertib</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['aturan']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
