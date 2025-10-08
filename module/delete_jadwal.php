<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete = mysqli_query($connection, "DELETE FROM schedule WHERE id = '$id'");

    if ($delete) {
        echo "<script>
                alert('Data jadwal berhasil dihapus!');
                window.location.href='?page=jadwal';
              </script>";
    } else {
        echo "<script>alert('Gagal menghapus data jadwal!');</script>";
    }
}
?>
