<?php
// Ambil data jadwal berdasarkan ID
$id = $_GET['id'];
$query = mysqli_query($connection, "SELECT * FROM schedules WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika form disubmit
if (isset($_POST['update'])) {
    $class_group_id = $_POST['class_group_id'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $update = mysqli_query($connection, "UPDATE schedules SET 
        class_group_id = '$class_group_id',
        day_of_week = '$day_of_week',
        start_time = '$start_time',
        end_time = '$end_time'
        WHERE id = '$id'
    ");

    if ($update) {
        echo "<script>
                alert('Jadwal berhasil diperbarui!');
                window.location.href='?page=jadwal';
              </script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}
?>

<h1 class="text-2xl font-semibold text-gray-800 mb-4" data-aos="fade-down">
    Edit Jadwal Kuliah
</h1>

<form method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-lg" data-aos="fade-up">
    <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Kelas</label>
        <input type="text" name="class_group_id" value="<?= $data['class_group_id']; ?>"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Hari</label>
        <select name="day_of_week" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            <?php
            $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            foreach ($days as $day) {
                $selected = ($data['day_of_week'] == $day) ? 'selected' : '';
                echo "<option value='$day' $selected>$day</option>";
            }
            ?>
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Jam Mulai</label>
        <input type="time" name="start_time" value="<?= $data['start_time']; ?>"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Jam Selesai</label>
        <input type="time" name="end_time" value="<?= $data['end_time']; ?>"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
    </div>

    <div class="flex justify-end">
        <a href="?page=jadwal" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 mr-2">Batal</a>
        <button type="submit" name="update" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </div>
</form>

<?php   