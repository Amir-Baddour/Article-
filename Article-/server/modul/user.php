<?php
// Include the database connection file
require_once __DIR__ . '/../connection/db.php';

class User extends UserSkeleton {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // Create a new user
    public function createUser($fullname, $email, $password) {
        $hashedPassword = hash('sha256', $password);
        $sql = "INSERT INTO Users (fullname, email, password) VALUES ('$fullname', '$email', '$hashedPassword')";
        return $this->conn->query($sql);
    }

    // Read user by ID
    public function getUserById($id) {
        $sql = "SELECT * FROM Users WHERE id = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    // Update user
    public function updateUser($id, $fullname, $email, $password) {
        $hashedPassword = hash('sha256', $password);
        $sql = "UPDATE Users SET fullname = '$fullname', email = '$email', password = '$hashedPassword' WHERE id = $id";
        return $this->conn->query($sql);
    }

    // Delete user
    public function deleteUser($id) {
        $sql = "DELETE FROM Users WHERE id = $id";
        return $this->conn->query($sql);
    }
}
?>