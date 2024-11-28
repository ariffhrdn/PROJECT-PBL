<?php
session_start();
include '../config/database.php';  // Pastikan path ini benar

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'dosen') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenis_pelanggaran = $_POST['jenis_pelanggaran'];
    $deskripsi = $_POST['deskripsi'];
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $tanggal = date('Y-m-d');

    // Query untuk insert data
    $query = "INSERT INTO laporan_pelanggaran (jenis_pelanggaran, deskripsi, id_mahasiswa, tanggal) 
              VALUES (?, ?, ?, ?)";

    // Persiapkan statement untuk menghindari SQL injection
    $params = array($jenis_pelanggaran, $deskripsi, $id_mahasiswa, $tanggal);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        $error_message = "Error: " . print_r(sqlsrv_errors(), true);
    } else {
        $success_message = "Laporan berhasil dikirim!";
    }
}

// Query untuk mengambil data mahasiswa
$mahasiswa_query = "SELECT id_mahasiswa, nama FROM mahasiswa";
$mahasiswa_result = sqlsrv_query($conn, $mahasiswa_query);

// Mengambil data mahasiswa
$mahasiswa_list = [];
if ($mahasiswa_result) {
    while ($row = sqlsrv_fetch_array($mahasiswa_result, SQLSRV_FETCH_ASSOC)) {
        $mahasiswa_list[] = $row;
    }
}

// Query untuk mengambil daftar laporan yang sudah dibuat
$laporan_query = "
    SELECT lp.jenis_pelanggaran, lp.deskripsi, lp.tanggal, m.nama
    FROM laporan_pelanggaran lp
    JOIN mahasiswa m ON lp.id_mahasiswa = m.id_mahasiswa
    ORDER BY lp.tanggal DESC
";
$laporan_result = sqlsrv_query($conn, $laporan_query);

// Mengambil daftar laporan
$laporan_list = [];
if ($laporan_result) {
    while ($row = sqlsrv_fetch_array($laporan_result, SQLSRV_FETCH_ASSOC)) {
        $laporan_list[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Pelanggaran - DigiMart</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        /* Styling dasar untuk tampilan web kampus */
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

        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }

        label {
            display: block;
            font-size: 16px;
            margin: 10px 0 5px;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #005b96;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #003366;
        }

        .success, .error {
            text-align: center;
            font-size: 18px;
            margin: 10px 0;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        footer {
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .laporan-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .laporan-table th, .laporan-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .laporan-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <header>
        <h1>Sistem Laporan Pelanggaran</h1>
    </header>

    <div class="navbar">
        <a href="../index.php">Beranda</a>
        <a href="lapor.php">Lapor Pelanggaran</a>
        <a href="../logout.php">Logout</a>
    </div>

    <div class="content">
        <h2>Lapor Pelanggaran</h2>

        <?php if (isset($success_message)) echo "<p class='success'>$success_message</p>"; ?>
        <?php if (isset($error_message)) echo "<p class='error'>$error_message</p>"; ?>

        <div class="form-container">
            <form method="POST">
                <label>Jenis Pelanggaran:</label>
                <input type="text" name="jenis_pelanggaran" required>

                <label>Deskripsi:</label>
                <textarea name="deskripsi" required></textarea>

                <label>Mahasiswa:</label>
                <select name="id_mahasiswa" required>
                    <?php foreach ($mahasiswa_list as $row): ?>
                        <option value="<?= $row['id_mahasiswa'] ?>"><?= $row['nama'] ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit">Laporkan</button>
            </form>
        </div>

        <h3>Daftar Laporan Pelanggaran</h3>
        <table class="laporan-table">
            <thead>
                <tr>
                    <th>Jenis Pelanggaran</th>
                    <th>Deskripsi</th>
                    <th>Nama Mahasiswa</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($laporan_list as $laporan): ?>
                    <tr>
                        <td><?= $laporan['jenis_pelanggaran'] ?></td>
                        <td><?= $laporan['deskripsi'] ?></td>
                        <td><?= $laporan['nama'] ?></td>
                        <td><?= $laporan['tanggal'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <footer>
        <p>&copy; 2024 DigiMart - Sistem Laporan Pelanggaran</p>
    </footer>

</body>
</html>
