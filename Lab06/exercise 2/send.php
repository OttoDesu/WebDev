<?php
// Connect to the database
require_once("connection.php");

// Check if the shout text is not empty
if ($_POST['shout'] != "") {
    // Add shout to the database
    $shout_text = mysqli_real_escape_string($link, $_POST['shout']);
    $shout_date = date("Y-m-d H:i:s");

    $result = mysqli_query($link, "INSERT INTO shouts (shout_text, shout_date) VALUES ('$shout_text', '$shout_date')")
        or die(mysqli_error($link));
}
?>

<html>
<head>
    <meta http-equiv="refresh" content="0;url=index.php">
    <title>Redirecting...</title>
</head>
<body>
    <p>Please wait...</p>
</body>
</html>
