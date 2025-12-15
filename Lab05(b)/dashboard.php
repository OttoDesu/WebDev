<?php
session_start();
if (!isset($_SESSION['matric'])) {
header("Location: login.php");
}
include 'db.php';
?>


<!DOCTYPE html>
<html>
<head>
<title>User List</title>
<style>
body {
    font-family: "Segoe UI", sans-serif;
    background: linear-gradient(135deg, #f9f6ff 0%, #f1f8ff 100%);
    margin: 0;
    padding: 0;
}
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 28px;
}
h2 {
    color: #303145;
    margin: 0;
}
a {
    color: #7a6cff;
    text-decoration: none;
    font-weight: 600;
}
a:hover { text-decoration: underline; }
.container {
    max-width: 960px;
    margin: 0 auto;
    padding: 0 20px 40px;
}
.card {
    background: #fff;
    padding: 18px;
    border: 1px solid #e5e5ef;
    border-radius: 12px;
    box-shadow: 0 12px 35px rgba(42, 71, 109, 0.08);
}
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    text-align: left;
    padding: 12px 10px;
    border-bottom: 1px solid #eef0f7;
    color: #303145;
}
th {
    background: #f7f8ff;
    font-weight: 700;
}
tr:last-child td {
    border-bottom: none;
}
.actions a {
    margin-right: 10px;
}
.add {
    margin-left: 20px;
    font-size: 14px;
}
</style>
</head>
<body>
<div class="topbar">
    <h2>User List</h2>
    <div>
        <a href="logout.php">Logout</a>
    </div>
</div>
<div class="container">
    <div class="card">
        <table>
        <tr>
        <th>ID/Matric</th>
        <th>Name</th>
        <th>Access Level</th>
        <th>Action</th>
        </tr>

        <?php
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);


        while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['matric']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['role']}</td>";
        echo "<td class='actions'>
        <a href='update.php?matric={$row['matric']}'>Update</a>
        <a href='delete.php?matric={$row['matric']}'>Delete</a>
        </td>";
        echo "</tr>";
        }
        ?>
        </table>
    </div>
</div>
</body>
</html>
