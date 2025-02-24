<?php
include 'koneksi.php'; // Pastikan file koneksi ke database tersedia
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan & SOP/IK</title>
    <style>
         body {
            background-image: url("assets/panduan 1.png");
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Arial', sans-serif;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #003399, #ff9900);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            text-align: center;
            width: 80%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background: #003399;
            color: white;
        }
        input, select {
            padding: 5px;
            margin: 5px;
        }
        button {
            background: #ff9900;
            border: none;
            padding: 10px;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Karyawan</h2>
        <form action="" method="POST">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="text" name="jabatan" placeholder="Jabatan" required>
            <input type="text" name="divisi" placeholder="Divisi" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit" name="tambah_karyawan">Tambah</button>
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Divisi</th>
                <th>Email</th>
            </tr>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM data_karyawan");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['jabatan']}</td>
                        <td>{$row['divisi']}</td>
                        <td>{$row['email']}</td>
                      </tr>";
            }
            ?>
        </table>

        <h2>Data SOP/IK</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <select name="jenis">
                <option value="SOP">SOP</option>
                <option value="IK">IK</option>
            </select>
            <input type="text" name="klasifikasi" placeholder="Klasifikasi" required>
            <input type="date" name="tgl_terbit" required>
            <input type="date" name="masa_berlaku" required>
            <input type="text" name="lokasi" placeholder="Lokasi" required>
            <input type="text" name="versi" placeholder="Versi" required>
            <input type="file" name="berkas" required>
            <button type="submit" name="tambah_sopik">Tambah</button>
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Jenis</th>
                <th>Klasifikasi</th>
                <th>Tanggal Terbit</th>
                <th>Masa Berlaku</th>
                <th>Lokasi</th>
                <th>Versi</th>
                <th>File</th>
            </tr>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM documents");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['jenis']}</td>
                        <td>{$row['klasifikasi']}</td>
                        <td>{$row['tgl_terbit']}</td>
                        <td>{$row['masa_berlaku']}</td>
                        <td>{$row['lokasi']}</td>
                        <td>{$row['versi']}</td>
                        <td><a href='uploads/{$row['berkas']}' target='_blank'>Download</a></td>
                    </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
if (isset($_POST['tambah_karyawan'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $divisi = $_POST['divisi'];
    $email = $_POST['email'];
    mysqli_query($conn, "INSERT INTO data_karyawan (nama, jabatan, divisi, email) VALUES ('$nama', '$jabatan', '$divisi', '$email')");
    header("Location: data_karyawan.php");
}

if (isset($_POST['tambah_sopik'])) {
    $jenis = $_POST['jenis'];
    $klasifikasi = $_POST['klasifikasi'];
    $tgl_terbit = $_POST['tgl_terbit'];
    $masa_berlaku = $_POST['masa_berlaku'];
    $lokasi = $_POST['lokasi'];
    $versi = $_POST['versi'];
    
    $berkas = $_FILES['berkas']['name'];
    $tmp_name = $_FILES['berkas']['tmp_name'];
    $upload_dir = "uploads/";
    move_uploaded_file($tmp_name, $upload_dir.$berkas);
    
    mysqli_query($conn, "INSERT INTO documents (jenis, klasifikasi, tgl_terbit, masa_berlaku, lokasi, versi, berkas) 
                        VALUES ('$jenis', '$klasifikasi', '$tgl_terbit', '$masa_berlaku', '$lokasi', '$versi', '$berkas')");
    header("Location: data_karyawan.php");
}
?>
