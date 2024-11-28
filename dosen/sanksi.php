<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'dosen') {
    header("Location: ../index.php");
    exit;
}

$query = "SELECT * FROM sanksi";
$result = $conn->query($query);
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
                <th>Nama Sanksi</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_sanksi'] ?></td>
                    <td><?= $row['nama_sanksi'] ?></td>
                    <td><?= $row['deskripsi'] ?></td>
                    <td><?= $row['kategori'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
