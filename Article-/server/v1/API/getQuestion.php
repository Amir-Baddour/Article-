<?php
header('Content-Type: application/json'); // Set response type to JSON

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once __DIR__ . '/../../modul/question.php';

// Fetch all FAQs
$questionObj = new Question();
$faqs = $questionObj->getAllQuestions();

echo json_encode($faqs);
?>