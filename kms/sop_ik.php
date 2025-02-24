<?php
session_start();
include 'koneksi.php'; // Pastikan file ini ada dan benar

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil data dari database
$query = "SELECT * FROM documents"; // Sesuaikan dengan nama tabel
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data SOP/IK</title>
</head>
<body>
    <h2>Data SOP/IK</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Dokumen</th>
            <th>Divisi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['nama_dokumen']; ?></td>
            <td><?= $row['divisi']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
