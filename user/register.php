<?php
session_start();
require_once "../config/database.php";

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = trim($_POST['nik']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $error = "Konfirmasi password tidak sama";
    } else {
        // cek NIK sudah terdaftar atau belum
        $cek = mysqli_prepare($conn, "SELECT id FROM users WHERE nik = ?");
        mysqli_stmt_bind_param($cek, "s", $nik);
        mysqli_stmt_execute($cek);
        mysqli_stmt_store_result($cek);

        if (mysqli_stmt_num_rows($cek) > 0) {
            $error = "NIK sudah terdaftar";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = mysqli_prepare($conn, "INSERT INTO users (nik, password) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "ss", $nik, $hash);

            if (mysqli_stmt_execute($stmt)) {
                $success = "Registrasi berhasil. Silakan login.";
            } else {
                $error = "Registrasi gagal";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Registrasi Pasien</title>
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
    width: 380px;
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
    background: #1abc9c;
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
.success {
    color: green;
    text-align: center;
    margin-bottom: 10px;
}
.login {
    text-align: center;
    margin-top: 10px;
}
.login a {
    color: #3498db;
    text-decoration: none;
}
</style>
</head>
<body>

<div class="card">
    <h2>Registrasi Pasien</h2>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="nik" placeholder="NIK" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
        <button type="submit">Daftar</button>
    </form>

    <div class="login">
        Sudah punya akun? <a href="login.php">Login</a>
    </div>
</div>

</body>
</html>
