<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'dosen') {
    header("Location: ../index.php");
    exit;
}

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
    <h1>Lihat Tata Tertib</h1>
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
</body>
</html>
