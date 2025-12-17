<?php
session_start();
require_once "../config/database.php";

// Proteksi user
if (!isset($_SESSION['user_nik'])) {
    die("Akses ditolak");
}

$nik_hash = $_SESSION['user_nik'];

// Ambil nama file dari database
$q = mysqli_query($conn,
    "SELECT file_pdf FROM pasien WHERE nik_hash='$nik_hash'"
);

$data = mysqli_fetch_assoc($q);

if (!$data || empty($data['file_pdf'])) {
    die("File PDF belum tersedia");
}

// PATH SESUAI KEBUTUHANMU
$file = __DIR__ . "/../pdf/files/" . $data['file_pdf'];

if (!file_exists($file)) {
    die("File PDF tidak tersedia di server");
}

// Kirim PDF ke browser
header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=\"".$data['file_pdf']."\"");
header("Content-Length: " . filesize($file));
readfile($file);
exit;
