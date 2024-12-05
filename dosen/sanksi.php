<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'dosen') {
    header("Location: ../index.php");
    exit;
}

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
    <title>Lihat Sanksi</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Lihat Sanksi</h1>
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
</body>
</html>
