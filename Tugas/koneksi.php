<?php
// Fungsi untuk menghubungkan ke database
function koneksiDatabase() {
    $host = "localhost"; // Nama host database
    $username = "root"; // Username database
    $password = ""; // Password database
    $database = "rental_mobil"; // Nama database

    // Membuat koneksi ke database
    $conn = mysqli_connect($host, $username, $password, $database);

    // Memeriksa apakah koneksi berhasil
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    return $conn;
}
?>
