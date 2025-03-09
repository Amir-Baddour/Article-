// server/database/seeds/seed_users.php
<?php
require_once __DIR__ . './server/connection/db.php';

// Sample data
$users = [
    [
        'fullname' => 'Amir Baddour',
        'email' => 'amirbaddour@gmail.com.com',
        'password' => hash('sha256', 'Abaddour') // Hash the password
    ],
    [
        'fullname' => 'Adham Ghannam',
        'email' => 'adham@gmail.com',
        'password' => hash('sha256', '123') // Hash the password
    ]
];

// Insert data
foreach ($users as $user) {
    $sql = "INSERT INTO Users (fullname, email, password) VALUES (
        '{$user['fullname']}',
        '{$user['email']}',
        '{$user['password']}'
    )";

    if ($conn->query($sql) === TRUE) {
        echo "User '{$user['fullname']}' inserted successfully\n";
    } else {
        echo "Error inserting user: " . $conn->error;
    }
}

$conn->close();
?>