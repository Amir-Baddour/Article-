<?php
require_once __DIR__ . './server/connection/db.php';

$sql = "
CREATE TABLE Questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL
);
";

if ($conn->query($sql) === TRUE) {
    echo "Table 'Questions' created successfully\n";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>