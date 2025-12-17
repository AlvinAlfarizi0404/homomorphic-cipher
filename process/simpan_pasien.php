<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config/database.php";
require_once "../cipher/homomorphic_cipher.php";
require_once "../pdf/generate_pdf.php";

// Ambil data
$nama_plain      = trim($_POST['nama']);
$nik_plain       = trim($_POST['nik']);
$diagnosis_plain = trim($_POST['diagnosis']);
$tanggal = date("Y-m-d");

// ================= ENKRIPSI DATABASE =================
$nama_enc      = encrypt($nama_plain);
$nik_enc       = encrypt($nik_plain);
$diagnosis_enc = encrypt($diagnosis_plain);

// hash untuk login user
$nik_hash = hash('sha256', $nik_plain);

// ================= GENERATE PDF (PLAIN) =================
$pdf_filename = "rekam_medis_" . time() . ".pdf";
$pdf_path = "../pdf/files/" . $pdf_filename;

generatePDF(
    $nama_plain,
    $nik_plain,
    $diagnosis_plain,
    $tanggal,
    $pdf_path
);

// ================= SIMPAN DATABASE =================
$query = "INSERT INTO pasien 
(nama, nik, diagnosis, tanggal, nik_hash, file_pdf)
VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param(
    $stmt,
    "ssssss",
    $nama_enc,
    $nik_enc,
    $diagnosis_enc,
    $tanggal,
    $nik_hash,
    $pdf_filename
);

mysqli_stmt_execute($stmt);

// ================= SELESAI =================
header("Location: ../admin/decrypt_pasien.php?status=sukses");
exit;
