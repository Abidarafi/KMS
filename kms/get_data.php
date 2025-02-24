<?php
include 'config.php';
$sql = "SELECT * FROM karyawan_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr data-id='" . $row['id_karyawan'] . "'>";
        echo "<td>" . $row['id_karyawan'] . "</td>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . $row['divisi'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td><button class='btn btn-danger btn-xs btn-hapus' data-id='" . $row['id_karyawan'] . "'>Hapus</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Tidak ada data karyawan.</td></tr>";
}
$conn->close();
?>