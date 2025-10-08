<?php
$sql = "SELECT * FROM schedules";
$exc = mysqli_query($connection, $sql);
?>

<h1 class="text-2xl font-semibold text-gray-800" data-aos="fade-down">Data Jadwal Kuliah</h1>
<p class="text-gray-600 mb-4" data-aos="fade-down" data-aos-delay="100">
    Kelola informasi jadwal per kelas di sini.
</p>

<div class="flex justify-end mb-4" data-aos="fade-up" data-aos-delay="200">
    <a href="?page=tambah_jadwal"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
        <i data-feather="plus" class="w-4 h-4 mr-2"></i> Tambah Jadwal
    </a>
</div>

<!-- Tabel Data Jadwal -->
<div class="mt-6 bg-white rounded-lg shadow overflow-hidden" data-aos="fade-up">
    <div class="p-4 border-b flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Jadwal</h2>
        <a href="#" class="text-blue-600 text-sm font-medium">Lihat semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Mulai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Selesai</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (mysqli_num_rows($exc) > 0) { ?>
                    <?php while ($data = mysqli_fetch_assoc($exc)) { ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <?= htmlspecialchars($data['class_group_id']); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= htmlspecialchars($data['day_of_week']); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= htmlspecialchars($data['start_time']); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= htmlspecialchars($data['end_time']); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="?page=edit_jadwal&id=<?= $data['id']; ?>" 
                                   class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                                    <i data-feather="edit" class="w-4 h-4"></i>
                                </a>
                                <a href="?page=delete_jadwal&id=<?= $data['id']; ?>"
                                   class="text-red-500 hover:text-red-700" 
                                   onclick="return confirm('Yakin ingin menghapus jadwal ini?')" title="Hapus">
                                    <i data-feather="trash-2" class="w-4 h-4"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">
                            Belum ada data jadwal.
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
