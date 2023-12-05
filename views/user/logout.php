<?php 
/**
 * Script only for unsetting Session;
 */
ob_start(); // Turn on output buffering
session_start();

if (isset($_POST['logout'])) {
    unset($_SESSION['user_name']);
    setcookie('userid', '', time() - 3600, "/"); // set the cookie value to empty string
    setcookie('customerid', '', time() - 3600, "/");
    // Redirect to the desired page after logout
    header('Location: index.php');
    exit();
}
ob_end_flush(); // Send the output buffer and turn off output buffering
?>