<?php
include '../connection.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href='data_matkul.php';
          </script>";
    exit;
}

$sql = "DELETE FROM courses WHERE id = '$id'";

if (mysqli_query($connection, $sql)) {
    echo "<script>
            alert('Data mata kuliah berhasil dihapus!');
            window.location.href='data_matkul.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data: " . mysqli_error($connection) . "');
            window.location.href='data_matkul.php';
          </script>";
}
?>
