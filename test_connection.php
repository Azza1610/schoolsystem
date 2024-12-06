<?php
$host = "localhost";
$user = "db_username";
$password = "dbpassword"; // MAMP default password
$db_name = "student"; // Your database name

// Establish the database connection
$con = mysqli_connect($host, $user, $password, $db_name);

// Check the connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>