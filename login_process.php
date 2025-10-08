<?php
include 'connection.php';

$email    = $_POST['email'];
$password = $_POST['password']; // <-- biarkan plain text di sini

// ambil user berdasarkan email saja
$stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    // verifikasi input password terhadap hash yang tersimpan
    if (password_verify($password, $data['password_hash'])) {
        session_start();
        $_SESSION['user_id']    = $data['id'];
        $_SESSION['user_name']  = $data['name'];
        $_SESSION['user_email'] = $data['email'];
        $_SESSION['user_role']  = $data['role_id'];

        header("Location: dashboard.php");
        exit;
    }
}

// kalau gagal login
header("Location: login.php?error=1");
exit;
?>