<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connection, "SELECT * FROM lecturers WHERE id='$id'");
    $data = mysqli_fetch_assoc($query);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nidn = $_POST['nidn'];
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];

    $sql = "UPDATE lecturers SET nidn='$nidn', full_name='$full_name', phone='$phone', updated_at=NOW() WHERE id='$id'";
    $update = mysqli_query($connection, $sql);

    if ($update) {
        echo "<script>alert('Data dosen berhasil diperbarui!');window.location.href='data_dosen.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');window.location.href='data_dosen.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Dosen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-4">Edit Data Dosen</h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">
        <div class="mb-3">
            <label class="form-label">NIDN</label>
            <input type="text" class="form-control" name="nidn" value="<?= $data['nidn']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="full_name" value="<?= $data['full_name']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" class="form-control" name="phone" value="<?= $data['phone']; ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
        <a href="data_dosen.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
