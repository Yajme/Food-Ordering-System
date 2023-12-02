<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_boos";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Close connection when you're done
$conn->close();
?>
