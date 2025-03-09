<?php
class QuestionSkeleton {
    private $id;
    private $question;
    private $answer;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function getAnswer() {
        return $this->answer;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

    public function setAnswer($answer) {
        $this->answer = $answer;
    }
}
?>