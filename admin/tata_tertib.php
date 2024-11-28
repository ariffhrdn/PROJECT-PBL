<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isi_tata_tertib = $_POST['isi_tata_tertib'];
    $query = "INSERT INTO tata_tertib (isi_tata_tertib) VALUES ('$isi_tata_tertib')";
    if ($conn->query($query) === TRUE) {
        $success_message = "Tata tertib berhasil ditambahkan!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

$query = "SELECT * FROM tata_tertib";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Tata Tertib</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Kelola Tata Tertib</h1>
    <?php if (isset($success_message)) echo "<p class='success'>$success_message</p>"; ?>
    <?php if (isset($error_message)) echo "<p class='error'>$error_message</p>"; ?>

    <form method="POST">
        <textarea name="isi_tata_tertib" placeholder="Isi Tata Tertib" required></textarea>
        <button type="submit">Tambah</button>
    </form>

    <h2>Daftar Tata Tertib</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Isi Tata Tertib</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_tata_tertib'] ?></td>
                    <td><?= $row['isi_tata_tertib'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
