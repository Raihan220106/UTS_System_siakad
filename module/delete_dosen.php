<?php
include '../connection.php'; // koneksi di luar folder

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM dosen WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data dosen berhasil dihapus!'); window.location='data_dosen.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data dosen!'); window.location='data_dosen.php';</script>";
    }
} else {
    header("Location: data_dosen.php");
}
?>
