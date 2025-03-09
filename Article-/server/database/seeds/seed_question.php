// server/database/seeds/seed_questions.php
<?php
require_once __DIR__ . './server/connection/db.php';

// Sample data
$questions = [
    [
        'question' => 'What are some anti-patterns mentioned in the paper?',
        'answer' => 'The paper identifies several anti-patterns in ML system design, including:

          Glue code: Excessive use of ad-hoc code to connect different components, leading to fragility.
          
          Pipeline jungles: Overly complex and tangled data processing pipelines.
          
          Dead experimental codepaths: Unused or obsolete code from past experiments that remains in the system'
    ],
   
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