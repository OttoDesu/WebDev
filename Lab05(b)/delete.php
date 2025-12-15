<?php
session_start();
include 'db.php';


$matric = $_GET['matric'];
mysqli_query($conn, "DELETE FROM users WHERE matric='$matric'");
header("Location: dashboard.php");
?>
