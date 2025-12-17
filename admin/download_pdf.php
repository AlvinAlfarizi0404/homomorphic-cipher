<?php
session_start();

// Cek login admin
if (!isset($_SESSION['admin'])) {
    die("AKSES DITOLAK");
}

// Ambil nama file (aman)
$file = basename($_GET['file']);
$path = "../pdf/files/" . $file;

// Cek file ada
if (!file_exists($path)) {
    die("FILE TIDAK DITEMUKAN");
}

// Force download PDF
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"$file\"");
header("Content-Length: " . filesize($path));

readfile($path);
exit;
