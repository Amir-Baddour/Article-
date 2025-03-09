<?php
header('Content-Type: application/json'); // Set response type to JSON

// CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Include the database connection
$conn = require_once __DIR__ . '/server/connection/db.php';

// Check if the connection was successful
if (!$conn) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // Get JSON input from the request body
        $data = json_decode(file_get_contents('php://input'), true);

        // Validate JSON input
        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid JSON']);
            exit();
        }

        // Check if required fields are present
        if (isset($data['fullname'], $data['email'], $data['password'])) {
            $fullName = $data['fullname'];
            $email = $data['email'];
            $password = $data['password'];

            // Split full name into first and last name
            $nameParts = explode(' ', $fullName, 2);
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

            // Default values for missing fields
            $phone = '';
            $address = '';
            $role = 'client'; // Default role for new users

            // Check if the email already exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                http_response_code(400); // Bad Request
                echo json_encode(['error' => 'Email already exists']);
            } else {
                // Hash the password
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // Insert the new user into the database
                $stmt = $conn->prepare("INSERT INTO users (email, password_hash, role, first_name, last_name, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $email, $passwordHash, $role, $firstName, $lastName, $phone, $address);

                if ($stmt->execute()) {
                    echo json_encode(['success' => true, 'message' => 'User created successfully']);
                } else {
                    http_response_code(500); // Internal Server Error
                    echo json_encode(['error' => 'Failed to create user']);
                }
            }

            $stmt->close(); // Close the statement
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Missing required fields']);
        }
        break;

    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
?>