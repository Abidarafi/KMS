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
$nama = trim($_POST['nama']);
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);

// Validasi password
if ($password !== $confirm_password) {
    echo "<script>alert('Password tidak cocok!'); window.location.href='daftar.html';</script>";
    exit();
}

// Cek apakah username atau email sudah ada
$sql_check = "SELECT * FROM daftar WHERE username = ? OR email = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ss", $username, $email);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    echo "<script>alert('Username atau Email sudah terdaftar!'); window.location.href='daftar.html';</script>";
    exit();
}

// Hash password sebelum disimpan
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Simpan ke database
$sql_insert = "INSERT INTO daftar (nama, username, email, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("ssss", $nama, $username, $email, $hashed_password);

if ($stmt->execute()) {
    echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location.href='login.html';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan, coba lagi!'); window.location.href='daftar.html';</script>";
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
