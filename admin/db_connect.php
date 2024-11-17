<?php 

$conn = new mysqli('localhost', 'root', '', 'alumni_db');

// Check connection
if ($conn->connect_error) {
    die("Could not connect to MySQL: " . $conn->connect_error);
}

// Connection successful
echo "";

// You can now use $conn for your queries

?>
