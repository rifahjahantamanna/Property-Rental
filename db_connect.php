<?php
// Database credentials
$host = 'localhost';  // Hostname (usually 'localhost')
$username = 'root';   // Database username
$password = '';       // Database password (leave empty if no password)
$dbname = 'test1';  // Name of your database

// Create connection using MySQLi (MySQL Improved Extension)
$connection = mysqli_connect($host, $username, $password, $dbname);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
