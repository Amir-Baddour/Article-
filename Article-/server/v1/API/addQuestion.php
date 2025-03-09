<?php
header('Content-Type: application/json'); // Set response type to JSON

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


require_once __DIR__ . '/../server/classes/question.php';

// Get the raw POST data
$data = file_get_contents('php://input');
$faq = json_decode($data, true);

// Validate input
if (empty($faq['question']) || empty($faq['answer'])) {
    echo json_encode(['success' => false, 'message' => 'Question and answer are required.']);
    exit;
}

// Create a new question
$questionObj = new Question();
$result = $questionObj->createQuestion($faq['question'], $faq['answer']);

if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to add FAQ.']);
}
?>