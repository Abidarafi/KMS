<?php
session_start();
include 'koneksi.php'; // Pastikan file koneksi ke database lo sudah benar

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    echo "Silakan login terlebih dahulu.";
    exit;
}

// Ambil ID user dari session
$user_id = $_SESSION['user_id'];

// Query untuk mendapatkan divisi user
$queryUser = "SELECT divisi FROM users WHERE id = ?";
$stmtUser = $conn->prepare($queryUser);
$stmtUser->bind_param("i", $user_id);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$userData = $resultUser->fetch_assoc();
$divisi_user = $userData['divisi'];

// Query untuk menampilkan dokumen sesuai divisi user
$queryDocs = "SELECT * FROM documents WHERE divisi = ?";
$stmtDocs = $conn->prepare($queryDocs);
$stmtDocs->bind_param("s", $divisi_user);
$stmtDocs->execute();
$resultDocs = $stmtDocs->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dokumen Berdasarkan Divisi</title>
</head>
<body>
    <h2>Daftar Dokumen</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Dokumen</th>
            <th>Divisi</th>
        </tr>
        <?php while ($row = $resultDocs->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nama_dokumen']; ?></td>
                <td><?php echo $row['divisi']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
