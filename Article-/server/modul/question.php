<?php
require_once __DIR__ . '/questionskeleton.php';
require_once __DIR__ . '/../server/connection/db.php';

class Question extends QuestionSkeleton {
    private $conn;

    public function __construct() {
        $this->conn = include __DIR__ . '/../server/connection/db_connection.php';
    }
    // In the Question class
public function getConnection() {
    return $this->conn;
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
    // fetching question
public function getAllQuestions() {
    $sql = "SELECT * FROM Questions";
    $result = $this->conn->query($sql);
    $questions = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row;
        }
    }
    return $questions;
}
}
?>