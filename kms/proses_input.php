<?php
include 'config.php';

// Proses input data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $divisi = $_POST['divisi'];
    $email = $_POST['email'];

    // Pastikan nama tabel dan kolom sesuai dengan database baru Anda
    $sql = "INSERT INTO karyawan_new (nama, divisi, email) VALUES ('$nama', '$divisi', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "<div style='padding: 20px; background-image: linear-gradient(to right, #ff9900, #004A91); color: white; border-radius: 5px; text-align: center;'>";
        echo "Data karyawan berhasil ditambahkan!";
        echo "</div>";
    } else {
        echo "<div style='padding: 20px; background-image: linear-gradient(to right, #ff9900, #004A91); color: white; border-radius: 5px; text-align: center;'>";
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "</div>";
    }
}

// Proses hapus data
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];

    // Pastikan nama tabel dan kolom id_karyawan sesuai
    $sql_hapus = "DELETE FROM karyawan_new WHERE id_karyawan = '$id_hapus'";

    if ($conn->query($sql_hapus) === TRUE) {
        echo "<div style='padding: 20px; background-color: lightgreen; color: white; border-radius: 5px; text-align: center;'>";
        echo "Data berhasil dihapus!";
        echo "</div>";
    } else {
        echo "<div style='padding: 20px; background-color: lightcoral; color: white; border-radius: 5px; text-align: center;'>";
        echo "Error menghapus data: " . $conn->error;
        echo "</div>";
    }
}


// Ambil data dari database
// Pastikan nama tabel dan kolom id_karyawan sesuai
$sql_select = "SELECT id_karyawan, nama, divisi, email FROM karyawan_new";
$result = $conn->query($sql_select);

// Tampilkan data dalam tabel
echo "<table style='margin-top: 20px; width: 100%; border-collapse: collapse; text-align: center;'>";
echo "<tr><th style='padding: 8px; border: 1px solid #ddd;'>Nama</th><th style='padding: 8px; border: 1px solid #ddd;'>Divisi</th><th style='padding: 8px; border: 1px solid #ddd;'>Email</th><th style='padding: 8px; border: 1px solid #ddd;'>Opsi</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td style='padding: 8px; border: 1px solid #ddd;'>" . $row["nama"] . "</td><td style='padding: 8px; border: 1px solid #ddd;'>" . $row["divisi"] . "</td><td style='padding: 8px; border: 1px solid #ddd;'>" . $row["email"] . "</td>";
        echo "<td style='padding: 8px; border: 1px solid #ddd;'><a href='edit.php?id=" . $row["id_karyawan"] . "' style='color: #007bff; text-decoration: none;'>Edit</a> | <a href='proses_input.php?hapus=" . $row["id_karyawan"] . "' style='color: #dc3545; text-decoration: none;' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">Hapus</a></td></tr>";
    }
} else {
    echo "<tr><td colspan='4' style='padding: 8px; border: 1px solid #ddd; text-align: center;'>Tidak ada data karyawan.</td></tr>";
}
echo "</table>";


echo "<div style='text-align: center; margin-top: 20px;'><a href='index.html?t=" . time() . "' style='display: inline-block; padding: 10px 20px; background-image: linear-gradient(to right, #ff9900, #004A91); color: white; text-decoration: none; border-radius: 5px;'>Kembali ke Halaman Utama</a></div>";

$conn->close();
?>