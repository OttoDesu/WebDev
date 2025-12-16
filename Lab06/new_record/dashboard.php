<?php 
require('db.php'); 
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard - Secured Page</title>
<link rel="stylesheet" href="../register/style.css" />
</head>
<body>
<div class="form">
<p>Welcome to Dashboard.</p>
<p><a href="../register/index.php">Home</a><p>
<p><a href="insert.php">Insert New Record</a></p>
<p><a href="view.php">View Records</a><p>
<p><a href="../register/logout.php">Logout</a></p>
</div>
</body>
</html> 
