<?php
include "connection.php";

$sql = "SELECT s.*, p.name AS program_name FROM students s
        JOIN programs p ON s.program_id = p.id";
$exc = mysqli_query($connection, $sql);
?>

<h1 class="text-2xl font-semibold text-gray-800">Data Mahasiswa</h1>
<p class="text-gray-600 mb-4">Kelola informasi mahasiswa di sini.</p>

<div class="flex justify-end mb-4">
    <a href="?page=add_mhs" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
        <i data-feather="plus" class="w-4 h-4 mr-2"></i> Tambah Data
    </a>
</div>

<div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-800">Data Mahasiswa</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NPM</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program Studi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Angkatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php while ($data = mysqli_fetch_array($exc)) { ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900"><?php echo $data['npm']; ?></td>
                    <td class="px-6 py-4 text-sm text-gray-500"><?php echo $data['full_name']; ?></td>
                    <td class="px-6 py-4 text-sm text-gray-500"><?php echo $data['program_name']; ?></td>
                    <td class="px-6 py-4 text-sm text-gray-500"><?php echo $data['angkatan']; ?></td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <a href="?page=edit_mhs&id=<?php echo $data['id']; ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i data-feather="edit" class="w-4 h-4"></i>
                        </a>
                        <a href="?page=delete_mhs&id=<?php echo $data['id']; ?>"
                           onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"
                           class="text-red-600 hover:text-red-900">
                            <i data-feather="trash" class="w-4 h-4"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
