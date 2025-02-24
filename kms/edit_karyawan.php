<?php
include 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM karyawan WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_karyawan = $_POST['id_karyawan'];
    $nama = $_POST['nama'];
    $divisi = $_POST['divisi'];
    $email = $_POST['email'];

    $update_sql = "UPDATE karyawan SET id_karyawan='$id_karyawan', nama='$nama', divisi='$divisi', email='$email' WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Data berhasil diperbarui!";
        header("Location: data_karyawan.php");
    } else {
        echo "Error: " . $update_sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Karyawan</title>
</head>
<body>
    <h2>Edit Karyawan</h2>
    <form method="post">
        ID Karyawan: <input type="text" name="id_karyawan" value="<?= $row['id_karyawan'] ?>" required><br>
        Nama: <input type="text" name="nama" value="<?= $row['nama'] ?>" required><br>
        Divisi: <input type="text" name="divisi" value="<?= $row['divisi'] ?>" required><br>
        Email: <input type="email" name="email" value="<?= $row['email'] ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
