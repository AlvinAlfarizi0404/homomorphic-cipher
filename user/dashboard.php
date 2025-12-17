<?php
session_start();
require_once "../config/database.php";

// proteksi halaman
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_nik'])) {
    header("Location: login.php");
    exit;
}

$nik = $_SESSION['user_nik'];
$nik_hash = hash('sha256', $nik);

// ambil data rekam medis pasien
$stmt = mysqli_prepare($conn, "SELECT file_pdf FROM pasien WHERE nik_hash = ?");
mysqli_stmt_bind_param($stmt, "s", $nik_hash);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);
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
    border: none;
    cursor: pointer;
}
.logout {
    background: #e74c3c;
}
.footer {
    margin-top: 40px;
    color: #777;
}
.info {
    background: #ecf0f1;
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 15px;
    font-size: 14px;
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

        <p>
            Data rekam medis Anda tersimpan aman dalam bentuk terenkripsi
            dan hanya dapat diakses oleh Anda dan tenaga medis berwenang.
        </p>

        <?php if ($data && $data['file_pdf']): ?>
            <form action="send_token_email.php" method="POST">
                <label><b>Email tujuan unduhan</b></label>
                <input type="email" name="email" required
                    placeholder="contoh@email.com"
                    style="width:100%;padding:10px;margin:10px 0;border-radius:6px;border:1px solid #ccc">

                <button type="submit" class="btn">
                    Kirim Link Download ke Email
                </button>
            </form>
        <?php else: ?>
            <p><i>Rekam medis belum tersedia</i></p>
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
