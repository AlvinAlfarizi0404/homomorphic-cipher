<?php
session_start();
include "../config/database.php";

$nik_input = trim($_POST['nik'] ?? '');
$nik_hash = hash('sha256', $_POST['nik']);

$q = mysqli_query($conn,
 "SELECT * FROM pasien WHERE nik_hash='$nik_hash'"
);

if (mysqli_num_rows($q) > 0) {
    $_SESSION['user'] = $nik_hash;
    header("Location: dashboard.php");
}
echo "❌ NIK tidak ditemukan";
