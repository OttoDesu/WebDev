<?php
session_start();
if (!isset($_SESSION["username"])) {
    // Redirect to the shared login page if the user is not authenticated.
    header("Location: ../register/login.php");
    exit();
}
?>
