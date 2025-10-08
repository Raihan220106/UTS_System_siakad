<?php
include '../connection.php';

$id = $_GET['id'];

$delete = "DELETE FROM students WHERE id='$id'";
if (mysqli_query($connection, $delete)) {
    header("Location: data_mhs.php");
    exit;
} else {
    echo "Gagal menghapus data: " . mysqli_error($connection);
}
?>
