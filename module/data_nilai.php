<?php

include "connection.php";
$sql = "SELECT * FROM grades";
$exc = mysqli_query($connection, $sql);
?>

<h1 class="text-2xl font-semibold text-gray-800" data-aos="fade-down">Data Nilai Mahasiswa</h1>
<p class="text-gray-600 mb-4" data-aos="fade-down" data-aos-delay="100">
    Kelola informasi nilai mahasiswa di sini.
</p>

<div class="flex justify-end mb-4" data-aos="fade-up" data-aos-delay="200">
    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
        <i data-feather="plus" class="w-4 h-4 mr-2"></i> Tambah Nilai
    </button>
</div>

<div class="mt-6 bg-white rounded-lg shadow overflow-hidden" data-aos="fade-up">
    <div class="p-4 border-b flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-800">Data Nilai Mahasiswa</h2>
        <a href="#" class="text-blue-600 text-sm font-medium">Lihat semua</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrollment ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Point</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">GPA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                <?php while ($data = mysqli_fetch_array($exc)) { ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <?= $data['enrollment_id']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?= $data['grade_letter']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?= $data['grade_point']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?= $data['score_numeric']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a href="edit_nilai.php?id=<?= $data['id']; ?>" class="text-yellow-500 hover:text-yellow-700 mr-3" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="delete_nilai.php?id=<?= $data['id']; ?>" class="text-red-600 hover:text-red-800" 
                               onclick="return confirm('Yakin ingin menghapus nilai ini?')" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
