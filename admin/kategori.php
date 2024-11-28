<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// Proses form jika ada pengiriman POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $nama_kategori = $_POST['nama_kategori'];

    // Menggunakan prepared statement untuk keamanan
    $sql = "INSERT INTO kategori_sanksi (nama_kategori) VALUES (?)";
    $params = array($nama_kategori);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt) {
        $success_message = "Kategori berhasil ditambahkan!";
    } else {
        $error_message = "Error: " . print_r(sqlsrv_errors(), true);
    }
}

// Ambil data kategori sanksi
$query = "SELECT * FROM kategori_sanksi";
$result = sqlsrv_query($conn, $query);  // Menggunakan sqlsrv_query untuk SQL Server

if (!$result) {
    die("Query gagal: " . print_r(sqlsrv_errors(), true));  // Jika query gagal
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kategori Sanksi</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Kelola Kategori Sanksi</h1>
    
    <!-- Pesan sukses atau error -->
    <?php if (isset($success_message)) echo "<p class='success'>$success_message</p>"; ?>
    <?php if (isset($error_message)) echo "<p class='error'>$error_message</p>"; ?>

    <!-- Form untuk menambahkan kategori -->
    <form method="POST">
        <input type="text" name="nama_kategori" placeholder="Nama Kategori" required>
        <button type="submit">Tambah</button>
    </form>

    <h2>Daftar Kategori Sanksi</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)):  // Menggunakan sqlsrv_fetch_array untuk SQL Server
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_kategori']) ?></td>
                    <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
