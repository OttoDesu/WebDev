<?php
$conn = mysqli_connect("localhost", "root", "", "webdev_lab5b");


if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
?>