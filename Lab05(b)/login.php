<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
body {
    font-family: "Segoe UI", sans-serif;
    background: linear-gradient(135deg, #f9f6ff 0%, #f1f8ff 100%);
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
.card {
    background: #fff;
    width: 360px;
    padding: 22px;
    border: 1px solid #e5e5ef;
    border-radius: 12px;
    box-shadow: 0 12px 35px rgba(42, 71, 109, 0.08);
}
h2 {
    margin-top: 0;
    margin-bottom: 16px;
    color: #303145;
    text-align: center;
}
label {
    font-size: 14px;
    color: #4b4d63;
}
input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    margin-top: 6px;
    margin-bottom: 16px;
    border: 1px solid #d6d8e7;
    border-radius: 8px;
    font-size: 14px;
    box-sizing: border-box;
}
input[type="text"]:focus, input[type="password"]:focus {
    outline: none;
    border-color: #9d8cff;
    box-shadow: 0 0 0 3px rgba(157, 140, 255, 0.2);
}
.actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
input[type="submit"] {
    background: linear-gradient(120deg, #8f9bff, #7cb7ff);
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: transform 0.1s ease, box-shadow 0.2s ease;
}
input[type="submit"]:hover {
    box-shadow: 0 8px 18px rgba(124, 183, 255, 0.35);
}
input[type="submit"]:active {
    transform: translateY(1px);
}
a {
    color: #7a6cff;
    text-decoration: none;
    font-weight: 600;
}
a:hover {
    text-decoration: underline;
}
.message {
    margin-top: 12px;
    font-size: 13px;
    color: #4b4d63;
    text-align: center;
}
</style>
</head>
<body>
<div class="card">
<h2>Login</h2>
<form method="post">
<label>Matric</label>
<input type="text" name="matric" required>
<label>Password</label>
<input type="password" name="password" required>
<div class="actions">
    <input type="submit" name="login" value="Login">
</div>
</form>
<div class="message"><a href="register.php">Register</a> if you have not yet.</div>
</div>


<?php
include 'db.php';


if (isset($_POST['login'])) {
$matric = $_POST['matric'];
$password = $_POST['password'];


$sql = "SELECT * FROM users WHERE matric='$matric'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) == 1) {
$row = mysqli_fetch_assoc($result);
if (password_verify($password, $row['password'])) {
$_SESSION['matric'] = $row['matric'];
header("Location: dashboard.php");
} else {
echo "Invalid password, try login again";
}
} else {
echo "User not found";
}
}
?>
</body>
</html>
