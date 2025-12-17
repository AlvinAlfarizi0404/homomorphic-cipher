<?php
session_start();
require_once "../config/database.php";

if (!isset($_SESSION['user_nik'])) {
    header("Location: login.php");
    exit;
}

$nik_hash = $_SESSION['user_nik'];
$q = mysqli_query($conn, "SELECT file_pdf FROM pasien WHERE nik_hash='$nik_hash'");
$data = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Pasien</title>
<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f4f6f8;
}
.header {
    background: #2c3e50;
    color: white;
    padding: 20px;
}
.container {
    padding: 30px;
}
.card {
    background: white;
    padding: 25px;
    border-radius: 10px;
    max-width: 600px;
    box-shadow: 0 10px 25px rgba(0,0,0,.1);
}
.btn {
    display: inline-block;
    padding: 12px 20px;
    background: #27ae60;
    color: white;
    text-decoration: none;
    border-radius: 6px;
}
.logout {
    background: #e74c3c;
}
.footer {
    margin-top: 40px;
    color: #777;
}
</style>
</head>
<body>

<div class="header">
    <h2>Dashboard Pasien</h2>
</div>

<div class="container">
    <div class="card">
        <h3>Rekam Medis Anda</h3>
        <p>Data rekam medis Anda tersimpan aman dan terenkripsi di sistem.</p>

        <?php if ($data && $data['file_pdf']): ?>
            <a href="download_pdf.php" class="btn">⬇ Download Rekam Medis (PDF)</a>
        <?php else: ?>
            <p><i>PDF belum tersedia</i></p>
        <?php endif; ?>

        <br><br>
        <a href="logout.php" class="btn logout">Logout</a>
    </div>

    <div class="footer">
        <p>Sistem Rekam Medis Terenkripsi © <?= date('Y') ?></p>
    </div>
</div>

</body>
</html>
