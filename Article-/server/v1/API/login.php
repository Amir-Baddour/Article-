<?php
header('Content-Type: application/json'); // Set response type to JSON

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Include the database connection
$conn = require_once __DIR__ . './server/connection/db.php';

// Check if the connection was successful
if (!$conn) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // Handle login
        $data = json_decode(file_get_contents('php://input'), true);

        // Validate JSON input
        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid JSON']);
            exit();
        }

        error_log('Received Data: ' . print_r($data, true));  // Log received data for debugging

        if (isset($data['email_phone'], $data['password'])) {
            $emailPhone = $data['email_phone'];
            $password = $data['password'];

            // Fetch the user by email or phone
            $stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE email = ? OR phone_number = ?");
            $stmt->bind_param("ss", $emailPhone, $emailPhone);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($userId, $passwordHash);

            if ($stmt->fetch() && password_verify($password, $passwordHash)) {
                // Login successful
                error_log("Login successful for user: " . $emailPhone);  // Log successful login
                echo json_encode(['success' => true, 'message' => 'Login successful', 'user_id' => $userId]);
            } else {
                // Invalid credentials
                http_response_code(401); // Unauthorized
                error_log("Invalid credentials for: " . $emailPhone);  // Log invalid attempt
                echo json_encode(['error' => 'Invalid email/phone or password']);
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