// server/database/seeds/seed_questions.php
<?php
require_once __DIR__ . './server/connection/db.php';

// Sample data
$questions = [
    [
        'question' => 'What is the capital of France?',
        'answer' => 'Paris'
    ],
    [
        'question' => 'What is 2 + 2?',
        'answer' => '4'
    ]
];

// Insert data
foreach ($questions as $question) {
    $sql = "INSERT INTO Questions (question, answer) VALUES (
        '{$question['question']}',
        '{$question['answer']}'
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Question '{$question['question']}' inserted successfully\n";
    } else {
        echo "Error inserting question: " . $conn->error;
    }
}

$conn->close();
?>