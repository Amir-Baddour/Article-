// server/connection/db_connection.php
<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'article';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully\n";
return $conn;
?>