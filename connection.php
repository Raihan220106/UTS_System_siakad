<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'db_siakad';

$connection = new mysqli($host, $user, $pass, $db);

if(!$connection){
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>