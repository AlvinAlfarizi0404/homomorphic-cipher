<?php
session_start();
include "../config/database.php";

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
$admin = mysqli_fetch_assoc($query);

if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['admin'] = $admin['username'];
    header("Location: ../admin/input_pasien.php");
    exit;
} else {
    echo "❌ Username atau password salah";
}
