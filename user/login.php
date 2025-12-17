<?php
session_start();
require_once "../config/database.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = trim($_POST['nik']);
    $nik_hash = hash('sha256', $nik);

    $q = mysqli_query($conn, "SELECT id FROM pasien WHERE nik_hash='$nik_hash'");
    if (mysqli_num_rows($q) === 1) {
        $_SESSION['user_nik'] = $nik_hash;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "NIK tidak ditemukan";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Pasien</title>
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #1abc9c, #3498db);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.card {
    background: white;
    width: 350px;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 15px 30px rgba(0,0,0,.2);
}
h2 {
    text-align: center;
    margin-bottom: 20px;
}
input {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
}
button {
    width: 100%;
    padding: 12px;
    background: #3498db;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
}
.error {
    color: red;
    text-align: center;
    margin-bottom: 10px;
}
</style>
</head>
<body>

<div class="card">
    <h2>Login Pasien</h2>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="nik" placeholder="Masukkan NIK Anda" required>
        <button type="submit">Masuk</button>
    </form>
</div>

</body>
</html>
