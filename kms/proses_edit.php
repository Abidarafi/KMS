<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $divisi = $_POST['divisi'];
    $email = $_POST['email'];

    $sql = "UPDATE karyawan_id SET nama = '$nama', divisi = '$divisi', email = '$email' WHERE id_karyawan = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<div style='background-image: linear-gradient(to right, #ff9900, #004A91); color: white; padding: 20px; text-align: center;'>Data berhasil diupdate. <a href='index.html' style='color: white; text-decoration: none;'>Kembali ke Halaman Utama</a></div>";
    } else {
        echo "<div style='background-image: linear-gradient(to right, #ff9900, #004A91); color: white; padding: 20px; text-align: center;'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

$conn->close();
?>