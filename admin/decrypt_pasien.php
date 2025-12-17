<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/database.php";
include "../cipher/homomorphic_cipher.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Rekam Medis Pasien</title>

<style>
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    margin: 0;
    padding: 40px;
    background: #ffffff;
}

.header {
    text-align: center;
    margin-bottom: 30px;
}

.header h1 {
    margin: 0;
    font-size: 32px;
    font-weight: bold;
}

.header span {
    color: #ff4081;
}

.header b {
    color: black;
}

.logout-btn {
    border: 3px solid #ff4081;
    background: #ffe1ec;
    padding: 10px 30px;
    border-radius: 18px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    color: black;
}

.input-btn {
    border: 3px solid #ff4081;
    background: #ffe1ec;
    padding: 10px 30px;
    border-radius: 18px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    color: black;
    margin-right: 10px;
}

.input-btn:hover {
    background: #ff4081;
    color: white;
}


.logout-btn:hover {
    background: #ff4081;
    color: white;
}

.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.table-wrapper {
    border: 3px solid #ff4081;
    border-radius: 20px;
    overflow: hidden;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #ff4081;
    color: white;
    padding: 16px;
    font-size: 18px;
}

td {
    padding: 14px;
    text-align: center;
    font-size: 16px;
}

tr:nth-child(even) {
    background: #ffe1ec;
}

tr:nth-child(odd) {
    background: #e0e0e0;
}

.download-btn {
    background: #ff4081;
    color: white;
    padding: 8px 20px;
    border-radius: 16px;
    text-decoration: none;
    font-weight: bold;
    font-size: 14px;
}

.download-btn:hover {
    background: #d81b60;
}
</style>
</head>

<body>

<div class="header">
    <h1>
        <span>DATA REKAM MEDIS PASIEN</span> <b>(DOKTER ONLY)</b>
    </h1>
</div>

<div class="top-bar">
    <div>
         <a href="input_pasien.php" class="input-btn">+ Input Data Pasien</a>
    </div>
    <a href="../index.php" class="logout-btn">Logout</a>
</div>



<div class="table-wrapper">
<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIK</th>
        <th>Diagnosa</th>
        <th>Tanggal</th>
        <th>PDF</th>
    </tr>

<?php
$no = 1;
$data = mysqli_query($conn, "SELECT * FROM pasien ORDER BY id DESC");

while ($row = mysqli_fetch_assoc($data)) {
?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= decrypt($row['nama']) ?></td>
        <td><?= decrypt($row['nik']) ?></td>
        <td><?= decrypt($row['diagnosis']) ?></td>
        <td><?= $row['tanggal'] ?></td>
        <td>
            <a class="download-btn"
               href="download_pdf.php?file=<?= $row['file_pdf'] ?>">
               Download PDF
            </a>
        </td>
    </tr>
<?php } ?>

</table>
</div>

</body>
</html>
