<?php
session_start();
require_once "../config/database.php";
require_once "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_nik'])) {
    die("Akses ditolak");
}

// email dari form
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
if (!$email) {
    die("Email tidak valid");
}

$user_id = $_SESSION['user_id'];

// generate token
$token = bin2hex(random_bytes(32));
$expired = date('Y-m-d H:i:s', strtotime('+10 minutes'));

// simpan token
mysqli_query($conn, "
    INSERT INTO download_tokens (user_id, token, expires_at)
    VALUES ($user_id, '$token', '$expired')
");

$link = "http://localhost/rekam-medis/user/download_pdf.php?token=$token";

// kirim email
$mailConfig = require "../config/email.php";

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = $mailConfig['host'];
$mail->SMTPAuth = true;
$mail->Username = $mailConfig['username'];
$mail->Password = $mailConfig['password'];
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = $mailConfig['port'];

$mail->setFrom($mailConfig['from_email'], $mailConfig['from_name']);
$mail->addAddress($email);

$mail->isHTML(true);
$mail->Subject = "Link Download Rekam Medis";
$mail->Body = "
    <p>Halo,</p>
    <p>Silakan klik link berikut untuk mengunduh rekam medis:</p>
    <p><a href='$link'>$link</a></p>
    <p><b>Link hanya berlaku 10 menit dan sekali pakai.</b></p>
";

$mail->send();

echo "✅ Link download berhasil dikirim ke email <b>$email</b>";
