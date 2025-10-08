<?php
// Jika parameter page tidak ada, default ke dashboard
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

switch ($page) {
    case 'dashboard':
        echo "<h1>Ini Dashboard</h1>";
        break;

    case 'mahasiswa':
        include "module/data_mhs.php";
        break;

    case 'edit_mhs':
        include "module/edit_mhs.php";
        break;

    case 'delete_mhs':
        include "module/delete_mhs.php";
        break;

    case 'dosen':
        include "module/data_dosen.php";
        break;

    case 'edit_dosen':
        include "module/edit_dosen.php";
        break;    

    case 'delete_dosen':
        include "module/delete_dosen.php";    

    case 'matkul':
        include "module/data_matkul.php";
        break;
        
    case 'edit_matkul':
        include "module/edit_matkul.php";
        break;

    case 'delete_matkul':
        include "module/delete_matkul.php";
        break;

    case 'jadwal':
        include "module/jadwal.php";
        break;

    case 'edit_jadwal':
        include "module/edit_jadwal.php";
        break;

    case 'delete_jadwal':
        include "module/delete_jadwal.php";
        break;

    case 'nilai':
        include "module/data_nilai.php";
        break;

    case 'pengaturan':
        echo "<h1>Pengaturan Aplikasi</h1>";
        break;

    default:
        echo "<h1>404 - Halaman tidak ditemukan!</h1>";
        break;
}
?>
