<?php
include 'config.php';

if (isset($_POST['id_karyawan'])) {
    $id_karyawan = $_POST['id_karyawan'];
    $sql_delete = "DELETE FROM karyawan_id WHERE id_karyawan='$id_karyawan'";

    if ($conn->query($sql_delete) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $sql_delete . "<br>" . $conn->error;
    }
} else {
    echo "ID tidak valid.";
}

$conn->close();
?>