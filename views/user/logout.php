<?php 
/**
 * Script only for unsetting Session;
 */
session_start();

if (isset($_POST['logout'])) {
    unset($_SESSION['user_name']);
    // Redirect to the desired page after logout
    header('Location: index.php');
    exit();
}

?>