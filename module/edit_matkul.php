<?php

// ambil ID dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID tidak ditemukan!";
    exit;
}

// ambil data lama
$sql = "SELECT * FROM courses WHERE id = '$id'";
$result = mysqli_query($connection, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data mata kuliah tidak ditemukan!";
    exit;
}

// proses update
if (isset($_POST['update'])) {
    $program_id = $_POST['program_id'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $sks = $_POST['sks'];
    $semester_plan = $_POST['semester_plan'];

    $update = "UPDATE courses 
               SET program_id='$program_id', code='$code', name='$name', sks='$sks', semester_plan='$semester_plan', updated_at=NOW()
               WHERE id='$id'";

    if (mysqli_query($connection, $update)) {
        echo "<script>
                alert('Data mata kuliah berhasil diperbarui!');
                window.location.href='data_matkul.php';
              </script>";
    } else {
        echo "Gagal update data: " . mysqli_error($connection);
    }
}
?>

<h1 class="text-2xl font-semibold text-gray-800 mb-4">Edit Mata Kuliah</h1>

<form method="POST" class="bg-white p-6 rounded shadow-md">
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Program ID</label>
        <input type="text" name="program_id" value="<?= $data['program_id']; ?>" 
               class="w-full border border-gray-300 px-3 py-2 rounded">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Kode Mata Kuliah</label>
        <input type="text" name="code" value="<?= $data['code']; ?>" 
               class="w-full border border-gray-300 px-3 py-2 rounded">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Mata Kuliah</label>
        <input type="text" name="name" value="<?= $data['name']; ?>" 
               class="w-full border border-gray-300 px-3 py-2 rounded">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">SKS</label>
        <input type="number" name="sks" value="<?= $data['sks']; ?>" 
               class="w-full border border-gray-300 px-3 py-2 rounded">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Semester</label>
        <input type="number" name="semester_plan" value="<?= $data['semester_plan']; ?>" 
               class="w-full border border-gray-300 px-3 py-2 rounded">
    </div>

    <div class="flex justify-end">
        <button type="submit" name="update" 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan Perubahan
        </button>
    </div>
</form>

<?php
