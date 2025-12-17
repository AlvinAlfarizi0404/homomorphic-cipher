<?php
include "../config/database.php";

$username = "admin";
$password_plain = "admin123";

$hash = password_hash($password_plain, PASSWORD_DEFAULT);

mysqli_query($conn, "INSERT INTO admin (username, password)
                     VALUES ('$username', '$hash')");

echo "ADMIN BERHASIL DIBUAT";
