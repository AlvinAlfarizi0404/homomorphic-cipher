<?php
session_start();
include "../config/database.php";
include "../cipher/homomorphic_cipher.php";

$data = mysqli_query($conn, "SELECT * FROM pasien");

while ($row = mysqli_fetch_assoc($data)) {
    echo decrypt($row['nama']) . " | ";
    echo decrypt($row['nik']) . " | ";
    echo decrypt($row['diagnosis']) . "<br>";
}
