<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data karyawan berdasarkan id
    $sql = "DELETE FROM karyawan_id WHERE id_karyawan = '$id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman data_karyawan.php setelah data dihapus
        header("Location: data_karyawan.php?t=" . time());
        exit(); // Pastikan kode setelah header tidak dieksekusi
    } else {
        echo "<div style='background-image: linear-gradient(to right, #ff9900, #004A91); color: white; padding: 20px; text-align: center;'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
} else {
    echo "<div style='background-image: linear-gradient(to right, #ff9900, #004A91); color: white; padding: 20px; text-align: center;'>ID tidak valid.</div>";
}

$conn->close();
?>