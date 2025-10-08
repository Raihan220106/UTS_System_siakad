<?php
include 'connection.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SIAKAD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar-collapsed {
            width: 80px;
        }
        .sidebar-collapsed .nav-text {
            display: none;
        }
        .content {
            transition: margin-left 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar bg-blue-800 text-white w-64 flex flex-col">
            <div class="p-4 flex items-center justify-between border-b border-blue-700">
                <div class="flex items-center">
                    <i data-feather="book-open" class="w-6 h-6 mr-2"></i>
                    <span class="text-xl font-bold">SIAKAD</span>
                </div>
                <button id="toggleSidebar" class="text-white focus:outline-none">
                    <i data-feather="chevron-left"></i>
                </button>
            </div>
            <div class="p-4 flex items-center space-x-3 border-b border-blue-700">
                <img src="http://static.photos/people/200x200/1" alt="Admin" class="w-10 h-10 rounded-full">
                <div>
                    <p class="font-medium"><?php echo $_SESSION['user_name']; ?></p>
                    <p class="text-xs text-blue-200">
                        <?php if ($_SESSION['user_role'] == '1') 
                            { 
                                echo "Admin"; 
                            } elseif ($_SESSION['user_role'] == '2') 
                            { 
                                echo "Dosen"; 
                            } elseif ($_SESSION['user_role'] == '3') 
                            { 
                                echo "Mahasiswa"; 
                            } 
                        ?>
                    </p>
                </div>
            </div>

            <?php 
            if($_SESSION['user_role'] == '1'){
            ?>
            <nav class="flex-1 overflow-y-auto">
                <div class="p-2">
                    <!-- Dashboard -->
                    <a href="?page=dashboard" class="flex items-center p-3 rounded-lg <?php echo ($page=='dashboard') ? 'bg-blue-700 text-white' : 'hover:bg-blue-700 text-white mt-1'; ?>">
                        <i data-feather="home" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Dashboard</span>
                    </a>
                    <!-- Mahasiswa -->
                    <a href="?page=mahasiswa" 
                    class="flex items-center p-3 rounded-lg <?php echo ($page=='mahasiswa') ? 'bg-blue-700 text-white' : 'hover:bg-blue-700 text-white mt-1'; ?>">
                        <i data-feather="users" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Mahasiswa</span>
                    </a>
                    <!-- Dosen -->
                    <a href="?page=dosen" 
                    class="flex items-center p-3 rounded-lg <?php echo ($page=='dosen') ? 'bg-blue-700 text-white' : 'hover:bg-blue-700 text-white mt-1'; ?>">
                        <i data-feather="user" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Dosen</span>
                    </a>
                    <!-- Mata Kuliah -->
                    <a href="?page=matkul" 
                    class="flex items-center p-3 rounded-lg <?php echo ($page=='matkul') ? 'bg-blue-700 text-white' : 'hover:bg-blue-700 text-white mt-1'; ?>">
                        <i data-feather="book" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Mata Kuliah</span>
                    </a>
                    <!-- Jadwal -->
                    <a href="?page=jadwal" 
                    class="flex items-center p-3 rounded-lg <?php echo ($page=='jadwal') ? 'bg-blue-700 text-white' : 'hover:bg-blue-700 text-white mt-1'; ?>">
                        <i data-feather="calendar" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Jadwal</span>
                    </a>
                    <!-- Nilai -->
                    <a href="?page=nilai" 
                    class="flex items-center p-3 rounded-lg <?php echo ($page=='nilai') ? 'bg-blue-700 text-white' : 'hover:bg-blue-700 text-white mt-1'; ?>">
                        <i data-feather="file-text" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Nilai</span>
                    </a>
                    <!-- Pengaturan -->
                    <a href="?page=pengaturan" 
                    class="flex items-center p-3 rounded-lg <?php echo ($page=='pengaturan') ? 'bg-blue-700 text-white' : 'hover:bg-blue-700 text-white mt-1'; ?>">
                        <i data-feather="settings" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Pengaturan</span>
                    </a>
                </div>
            </nav>
            <?php 
            } elseif($_SESSION['user_role'] == '2'){
            ?>
            <nav class="flex-1 overflow-y-auto">
                <div class="p-2">
                    <a href="#" class="flex items-center p-3 rounded-lg bg-blue-700 text-white">
                        <i data-feather="home" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Dashboard</span>
                    </a>
                    <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 text-white mt-1">
                        <i data-feather="book" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Mata Kuliah</span>
                    </a>
                    <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 text-white mt-1">
                        <i data-feather="calendar" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Jadwal</span>
                    </a>
                    <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 text-white mt-1">
                        <i data-feather="file-text" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Nilai</span>
                    </a>
                    <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 text-white mt-1">
                        <i data-feather="settings" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Pengaturan</span>
                    </a>
                </div>
            </nav>
            <?php
            }elseif($_SESSION['user_role'] == '3'){
            ?>
            <nav class="flex-1 overflow-y-auto">
                <div class="p-2">
                    <a href="#" class="flex items-center p-3 rounded-lg bg-blue-700 text-white">
                        <i data-feather="home" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Dashboard</span>
                    </a>
                    <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 text-white mt-1">
                        <i data-feather="calendar" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Jadwal</span>
                    </a>
                    <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 text-white mt-1">
                        <i data-feather="file-text" class="w-5 h-5"></i>
                        <span class="nav-text ml-3">Nilai</span>
                    </a>
                </div>
            </nav>
            <?php
            }
            ?>


            <div class="p-4 border-t border-blue-700">
                <a href="logout.php" class="flex items-center p-3 rounded-lg hover:bg-blue-700 text-white">
                    <i data-feather="log-out" class="w-5 h-5"></i>
                    <span class="nav-text ml-3">Logout</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <button id="mobileToggle" class="mr-4 text-gray-600 focus:outline-none md:hidden">
                            <i data-feather="menu"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="text-gray-600 focus:outline-none">
                                <i data-feather="bell"></i>
                                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>
                        </div>
                        <div class="relative">
                            <button class="text-gray-600 focus:outline-none">
                                <i data-feather="mail"></i>
                                <span class="absolute top-0 right-0 w-2 h-2 bg-blue-500 rounded-full"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 bg-gray-100">
                <?php include 'menu.php'; ?>  
            </main>
        </div>
    </div>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Toggle sidebar
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.querySelector('.content');
        const mobileToggle = document.getElementById('mobileToggle');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            content.classList.toggle('md:ml-64');
            content.classList.toggle('md:ml-20');
            
            const icon = toggleSidebar.querySelector('i');
            if (sidebar.classList.contains('sidebar-collapsed')) {
                feather.icons['chevron-right'].toSvg().then(svg => icon.innerHTML = svg);
            } else {
                feather.icons['chevron-left'].toSvg().then(svg => icon.innerHTML = svg);
            }
        });

        mobileToggle.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });

        // Replace icons
        feather.replace();
    </script>
</body>
</html>