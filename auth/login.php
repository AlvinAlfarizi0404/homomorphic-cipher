<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin</title>
<style>
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    margin: 0;
    height: 100vh;
    background: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    width: 500px;
    text-align: center;
}

.title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 40px;
}

.title span {
    color: #ff4f87;
}

.form-box {
    text-align: left;
}

label {
    font-weight: 600;
    display: block;
    margin-bottom: 6px;
    margin-top: 20px;
}

input {
    width: 100%;
    padding: 16px;
    font-size: 16px;
    border-radius: 14px;
    border: 3px solid #ff4f87;
    background: #ffdbe6;
    outline: none;
}

input::placeholder {
    color: #555;
}

button {
    margin-top: 40px;
    width: 260px;
    padding: 14px;
    font-size: 18px;
    font-weight: bold;
    border-radius: 16px;
    border: 3px solid #ff4f87;
    background: #ffdbe6;
    cursor: pointer;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

button:hover {
    background: #ff4f87;
    color: #fff;
    transition: 0.3s;
}
</style>
</head>
<body>

<div class="container">

    <div class="title">
        <span>SISTEM</span> REKAM MEDIS
    </div>

    <form action="login_proses.php" method="post" class="form-box">

        <label>Username</label>
        <input type="text" name="username" placeholder="Username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">LOGIN</button>

    </form>

</div>

</body>
</html>
