<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data karyawan berdasarkan id
    // Pastikan nama tabel dan kolom id_karyawan sesuai dengan yang baru
    $sql = "SELECT id_karyawan, nama, divisi, email FROM karyawan_new WHERE id_karyawan = '$id'";
    $result = $conn->query($sql);

    if ($result) { // Periksa apakah query berhasil dieksekusi
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Form untuk edit data dengan CSS inline
            echo "<div style='background-image: linear-gradient(to right, #ff9900, #004A91); color: white; padding: 20px; text-align: center;'>";
            echo "<h2>Edit Data Karyawan</h2>";
            // Pastikan action form menuju file yang benar (misalnya proses_edit.php atau proses_input.php jika Anda ingin memproses di halaman yang sama)
            echo "<form action='proses_input.php' method='post' style='text-align: left; display: inline-block; width: 300px; margin: 0 auto;'>";
            echo "<input type='hidden' name='id' value='" . $row['id_karyawan'] . "'>"; // id_karyawan
            echo "Nama: <input type='text' name='nama' value='" . $row['nama'] . "' required style='width: 100%; padding: 5px; margin-bottom: 10px;'><br>";
            echo "Divisi: <input type='text' name='divisi' value='" . $row['divisi'] . "' required style='width: 100%; padding: 5px; margin-bottom: 10px;'><br>";
            echo "Email: <input type='email' name='email' value='" . $row['email'] . "' required style='width: 100%; padding: 5px; margin-bottom: 10px;'><br>";
            echo "<input type='submit' name='submit_edit' value='Simpan' style='background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;'>"; // Tambahkan name untuk submit edit
            echo "</form>";
            echo "</div>";
        } else {
            echo "<div style='background-image: linear-gradient(to right, #ff9900, #004A91); color: white; padding: 20px; text-align: center;'>Data tidak ditemukan.</div>";
        }
    } else {
        echo "<div style='background-image: linear-gradient(to right, #ff9900, #004A91); color: white; padding: 20px; text-align: center;'>Error: " . $conn->error . "</div>"; // Tampilkan pesan error dari database
    }
} else {
    echo "<div style='background-image: linear-gradient(to right, #ff9900, #004A91); color: white; padding: 20px; text-align: center;'>ID tidak valid.</div>";
}

$conn->close();
?>