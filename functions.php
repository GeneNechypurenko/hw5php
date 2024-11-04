<?php
function loadQuestionsFromFile($filename) {
    $questions = [];
    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $parts = explode(';', $line);
            if (count($parts) >= 3) {
                $id = $parts[0];
                $questionText = $parts[1];
                $answersString = $parts[2];
                $correctAnswer = isset($parts[3]) ? $parts[3] : '';

                $answers = explode('|', $answersString);
                $questions[] = [
                    'id' => $id,
                    'text' => $questionText,
                    'answers' => $answers,
                    'correct' => explode(',', $correctAnswer)
                ];
            } else {
                error_log("Warning: Строка имеет неправильный формат: $line");
            }
        }
    }
    return $questions;
}
?>
