<?php
$sql = "SELECT * FROM courses";
$exc = mysqli_query($connection, $sql);
?>

<h1 class="text-2xl font-semibold text-gray-800" data-aos="fade-down">Data Mata Kuliah</h1>
<p class="text-gray-600 mb-4" data-aos="fade-down" data-aos-delay="100">
    Kelola informasi mata kuliah di sini.
</p>

<div class="flex justify-end mb-4" data-aos="fade-up" data-aos-delay="200">
    <a href="tambah_matkul.php"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
        <i data-feather="plus" class="w-4 h-4 mr-2"></i> Tambah Mata Kuliah
    </a>
</div>

<!-- Tabel Data Mata Kuliah -->
<div class="mt-6 bg-white rounded-lg shadow overflow-hidden" data-aos="fade-up">
    <div class="p-4 border-b flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Mata Kuliah</h2>
        <a href="#" class="text-blue-600 text-sm font-medium">Lihat semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mata Kuliah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php while ($data = mysqli_fetch_array($exc)) { ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <?= $data['code']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?= $data['name']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?= $data['sks']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?= $data['semester_plan']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="?page=edit_matkul&id=<?php echo $data['id']; ?>" 
                               class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                                <i data-feather="edit" class="w-4 h-4"></i>
                            </a>
                            <a href="?page=delete_matkul&id=<?php echo $data['id']; ?>"
                               class="text-red-500 hover:text-red-700" 
                               onclick="return confirm('Yakin ingin menghapus mata kuliah ini?')" title="Hapus">
                                <i data-feather="trash-2" class="w-4 h-4"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
