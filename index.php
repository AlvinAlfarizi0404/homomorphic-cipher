<!DOCTYPE html>
<html>
<head>
    <title>Sistem Rekam Medis</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }
        a {
            display: block;
            margin: 15px 0;
            padding: 12px;
            background: #2d89ef;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        a.pasien {
            background: #28a745;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Login Sebagai</h2>
    <a href="auth/login.php">Dokter</a>
    <a href="user/login.php" class="pasien">Pasien</a>
</div>

</body>
</html>
