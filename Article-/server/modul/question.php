<?php
require_once __DIR__ . '/questionskeleton.php';
require_once __DIR__ . '/../server/connection/db_connection.php';

class Question extends QuestionSkeleton {
    private $conn;

    public function __construct() {
        $this->conn = include __DIR__ . '/../server/connection/db_connection.php';
    }

    // Create a new question
    public function createQuestion($question, $answer) {
        $sql = "INSERT INTO Questions (question, answer) VALUES ('$question', '$answer')";
        return $this->conn->query($sql);
    }

    // Read question by ID
    public function getQuestionById($id) {
        $sql = "SELECT * FROM Questions WHERE id = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    // Update question
    public function updateQuestion($id, $question, $answer) {
        $sql = "UPDATE Questions SET question = '$question', answer = '$answer' WHERE id = $id";
        return $this->conn->query($sql);
    }

    // Delete question
    public function deleteQuestion($id) {
        $sql = "DELETE FROM Questions WHERE id = $id";
        return $this->conn->query($sql);
    }
}
?>