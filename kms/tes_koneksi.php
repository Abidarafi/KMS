<?php
$conn = new mysqli("localhost", "root", "", "kms");

if ($conn->connect_error) {
    die("Koneksi GAGAL: " . $conn->connect_error);
} else {
    echo "Koneksi BERHASIL!";
}
?>
