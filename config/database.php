<?php
// Konfigurasi koneksi ke SQL Server
$host = "LAPTOP-VHERRFEN"; // Nama server dan instance SQL Server
$connInfo = array(
    "Database" => "projectdb",  // Nama database
    "UID" => "",          // Username SQL Server (kosong jika menggunakan autentikasi Windows)
    "PWD" => ""           // Password SQL Server (kosong jika menggunakan autentikasi Windows)
);

// Membuat koneksi ke SQL Server
$conn = sqlsrv_connect($host, $connInfo);

// Cek koneksi
if ($conn) {
    echo "Koneksi berhasil.<br />";
} else {
    echo "Koneksi gagal.<br />";
    die(print_r(sqlsrv_errors(), true)); // Menampilkan pesan kesalahan jika koneksi gagal
}
?>
