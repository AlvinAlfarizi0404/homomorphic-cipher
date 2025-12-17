<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Input Rekam Medis</title>

<style>
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    margin: 0;
    padding: 0;
    background: #fff;
}

.header {
    text-align: center;
    padding: 30px 0 10px;
}

.header h1 {
    color: #ff4081;
    margin: 0;
    font-weight: bold;
}

.container {
    padding: 40px 60px;
}

.title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 30px;
}

.form-wrapper {
    display: flex;
    gap: 40px;
}

.card {
    background: #ffe1ec;
    border-radius: 20px;
    padding: 25px;
    width: 350px;
    border: 3px solid #ff4081;
}

.card-header {
    background: #ff4081;
    color: white;
    padding: 12px;
    border-radius: 14px 14px 0 0;
    text-align: center;
    font-weight: bold;
    margin: -25px -25px 20px;
}

label {
    font-weight: 600;
    display: block;
    margin-bottom: 8px;
}

input, textarea {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: none;
    margin-bottom: 20px;
    outline: none;
}

textarea {
    resize: none;
    height: 100px;
}

.submit-wrapper {
    display: flex;
    justify-content: flex-end;
    margin-top: 40px;
}

button {
    background: #ffd1e3;
    border: 3px solid #ff4081;
    padding: 15px 40px;
    border-radius: 18px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
}

.view-btn {
    border: 3px solid #ff4081;
    background: #ffd1e3;
    padding: 12px 30px;
    border-radius: 18px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    color: black;
    margin-right: 15px;
}

.view-btn:hover {
    background: #ff4081;
    color: white;
}


button:hover {
    background: #ff4081;
    color: white;
}
</style>
</head>

<body>

<div class="header">
    <h1>SISTEM REKAM MEDIS</h1>
</div>

<div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <a href="decrypt_pasien.php" class="view-btn">📋 Lihat Data Pasien</a>
    </div>
    <div class="title">Input Rekam Medis Pasien</div>

    <form method="POST" action="../process/simpan_pasien.php">
        <div class="form-wrapper">

            <div class="card">
                <div class="card-header">Informasi Pasien</div>

                <label>Nama</label>
                <input type="text" name="nama" placeholder="Masukkan Nama" required>

                <label>NIK</label>
                <input type="text" name="nik" placeholder="Masukkan NIK Pasien" required>
            </div>

            <div class="card">
                <div class="card-header">Informasi Pasien</div>

                <label>Diagnosa</label>
                <textarea name="diagnosis" placeholder="Masukkan Diagnosa Penyakit" required></textarea>
            </div>

        </div>

        <div class="submit-wrapper">
            <button type="submit">Simpan Rekam Medis</button>
        </div>
    </form>
</div>

</body>
</html>
