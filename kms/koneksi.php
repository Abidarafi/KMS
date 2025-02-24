<?php
// koneksi.php
$host = "localhost";
$user = "root";
$pass = "";
$db = "kms"; // Ganti dengan nama database yang benar

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
