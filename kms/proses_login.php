<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$database = "kms";

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari form
$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Cek username di database
$sql = "SELECT * FROM daftar WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Login sukses -> Set session
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['email'] = $row['email'];

        echo "<script>alert('Login berhasil!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Password salah!'); window.location.href='login.html';</script>";
    }
} else {
    echo "<script>alert('Username tidak ditemukan!'); window.location.href='login.html';</script>";
}

$stmt->close();
$conn->close();
?>
