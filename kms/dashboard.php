<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='login.html';</script>";
    exit();
}

// Ambil data user dari session
$nama = $_SESSION['nama'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #ff9900, #004A91);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            color: white;
        }
        .container {
            text-align: center;
        }
        a {
            color: yellow;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Selamat Datang, <?php echo $nama; ?>!</h2>
        <p>Username: <?php echo $username; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <p><a href="data_karyawan.php">Lihat Data Karyawan & SOP/IK</a></p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
