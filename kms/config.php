<?php
// Atur batas memori (opsional, jika diperlukan)
ini_set('memory_limit', '512M'); // Cukup 512M kecuali kalau butuh lebih besar

// Konfigurasi database
$host = "localhost"; // Biasanya "localhost"
$user = "root"; // Default XAMPP biasanya "root"
$password = ""; // Kosongkan kalau default
$database = "kms"; // Pastikan nama database benar

// Buat koneksi ke database
$conn = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set karakter UTF-8 biar support karakter khusus (misal é, ü, dll.)
$conn->set_charset("utf8");

// Atur timezone ke Jakarta
date_default_timezone_set('Asia/Jakarta');

// Debugging (Opsional, buat cek koneksi jalan atau enggak)
// echo "Koneksi sukses!";
?>
