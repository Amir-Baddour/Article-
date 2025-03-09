<?php
require_once __DIR__ . './server/connection/db.php';

$sql = "
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL -- Hashed password (SHA256)
);
";

if ($conn->query($sql) === TRUE) {
    echo "Table 'Users' created successfully\n";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>