<!DOCTYPE html>
<html>
<head>
<title>Register</title>
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
    width: 380px;
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
input[type="text"], input[type="password"], select {
    width: 100%;
    padding: 10px 12px;
    margin-top: 6px;
    margin-bottom: 16px;
    border: 1px solid #d6d8e7;
    border-radius: 8px;
    font-size: 14px;
    box-sizing: border-box;
}
input[type="text"]:focus, input[type="password"]:focus, select:focus {
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
<h2>User Registration</h2>
<form method="post">
<label>Matric</label>
<input type="text" name="matric" required>
<label>Name</label>
<input type="text" name="name" required>
<label>Password</label>
<input type="password" name="password" required>
<label>Access Level</label>
<select name="role">
<option value="lecturer">Lecturer</option>
<option value="student">Student</option>
</select>
<div class="actions">
<input type="submit" name="register" value="Register">
</div>
</form>
<div class="message">Already have an account? <a href="login.php">Login</a> instead.</div>
</div>


<?php
include 'db.php';


if (isset($_POST['register'])) {
$matric = $_POST['matric'];
$name = $_POST['name'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];


$sql = "INSERT INTO users (matric, name, password, role)
VALUES ('$matric', '$name', '$password', '$role')";


if (mysqli_query($conn, $sql)) {
echo "Registration successful";
} else {
echo "Error";
}
}
?>
</body>
</html>
