<?php
include 'connection.php'; // koneksi
$id = $_GET['id'];

// Ambil data mahasiswa berdasarkan ID
$result = mysqli_query($connection, "SELECT * FROM students WHERE id='$id'");
$data = mysqli_fetch_array($result);

// Ambil data program studi untuk dropdown
$programs = mysqli_query($connection, "SELECT * FROM programs");

// Jika form disubmit
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $birth_place = $_POST['birth_place'];
    $birth_date = $_POST['birth_date'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $program_id = $_POST['program_id'];
    $angkatan = $_POST['angkatan'];
    $status = $_POST['status'];

    $update = "UPDATE students SET 
        full_name='$full_name',
        gender='$gender',
        birth_place='$birth_place',
        birth_date='$birth_date',
        address='$address',
        phone='$phone',
        program_id='$program_id',
        angkatan='$angkatan',
        status='$status',
        updated_at=NOW()
        WHERE id='$id'";

    if (mysqli_query($connection, $update)) {
        header('Location:data_mhs');
        exit;
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($connection);
    }
}
?>

<h2 class="text-2xl font-semibold mb-4">Edit Data Mahasiswa</h2>
<form method="POST">
    <div class="mb-3">
        <label>Nama Lengkap</label>
        <input type="text" name="full_name" value="<?php echo $data['full_name']; ?>" class="border p-2 w-full">
    </div>

    <div class="mb-3">
        <label>Jenis Kelamin</label>
        <select name="gender" class="border p-2 w-full">
            <option value="Laki-laki" <?php if ($data['gender']=='Laki-laki') echo 'selected'; ?>>Laki-laki</option>
            <option value="Perempuan" <?php if ($data['gender']=='Perempuan') echo 'selected'; ?>>Perempuan</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Tempat Lahir</label>
        <input type="text" name="birth_place" value="<?php echo $data['birth_place']; ?>" class="border p-2 w-full">
    </div>

    <div class="mb-3">
        <label>Tanggal Lahir</label>
        <input type="date" name="birth_date" value="<?php echo $data['birth_date']; ?>" class="border p-2 w-full">
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="address" class="border p-2 w-full"><?php echo $data['address']; ?></textarea>
    </div>

    <div class="mb-3">
        <label>No. HP</label>
        <input type="text" name="phone" value="<?php echo $data['phone']; ?>" class="border p-2 w-full">
    </div>

    <div class="mb-3">
        <label>Program Studi</label>
        <select name="program_id" class="border p-2 w-full">
            <?php while ($p = mysqli_fetch_array($programs)) { ?>
                <option value="<?php echo $p['id']; ?>" <?php if ($data['program_id'] == $p['id']) echo 'selected'; ?>>
                    <?php echo $p['name']; ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Angkatan</label>
        <input type="text" name="angkatan" value="<?php echo $data['angkatan']; ?>" class="border p-2 w-full">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <input type="text" name="status" value="<?php echo $data['status']; ?>" class="border p-2 w-full">
    </div>

    <button type="submit" name="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
    <a href="data_mhs.php" class="ml-2 text-blue-600">Batal</a>
</form>
