<?php
session_start();
require_once "../config/database.php";

// proteksi login
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_nik'])) {
    header("Location: login.php");
    exit;
}

$nik = $_SESSION['user_nik'];
$nik_hash = hash('sha256', $nik);

// ambil file pdf berdasarkan nik user
$stmt = mysqli_prepare($conn, "SELECT file_pdf FROM pasien WHERE nik_hash = ?");
mysqli_stmt_bind_param($stmt, "s", $nik_hash);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data || empty($data['file_pdf'])) {
    die("File rekam medis tidak ditemukan.");
}

$file = "../pdf/files/" . basename($data['file_pdf']);

if (!file_exists($file)) {
    die("File PDF tidak tersedia di server.");
}

header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"rekam_medis_$nik.pdf\"");
header("Content-Length: " . filesize($file));

readfile($file);
exit;

