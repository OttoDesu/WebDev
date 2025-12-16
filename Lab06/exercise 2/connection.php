<?php
// Create connection to the database
$link = mysqli_connect('localhost', 'root', '', 'shoutbox');

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
