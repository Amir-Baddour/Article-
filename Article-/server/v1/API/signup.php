<?php
header("Content-Type: application/json"); // Set response content type to JSON

// Include necessary files
require_once 'C:/xampp/htdocs/Article-/Article-/server/modul/user.php';// Function to validate input data
function validateInput($data) {
    $errors = [];

    // Validate full name
    if (empty($data['fullname'])) {
        $errors[] = "Full name is required.";
    }

    // Validate email
    if (empty($data['email'])) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password
    if (empty($data['password'])) {
        $errors[] = "Password is required.";
    } elseif (strlen($data['password']) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    return $errors;
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input data from the request body
    $input = json_decode(file_get_contents('php://input'), true);

    // Validate input
    $errors = validateInput($input);

    if (empty($errors)) {
        // Create a new user
        $user = new User();
        $result = $user->createUser($input['fullname'], $input['email'], $input['password']);

        if ($result) {
            // Success response
            echo json_encode([
                'status' => 'success',
                'message' => 'User registered successfully.'
            ]);
        } else {
            // Database error
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to register user. Please try again.'
            ]);
        }
    } else {
        // Validation error
        echo json_encode([
            'status' => 'error',
            'message' => 'Validation failed.',
            'errors' => $errors
        ]);
    }
} else {
    // Invalid request method
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method. Only POST requests are allowed.'
    ]);
}
?>