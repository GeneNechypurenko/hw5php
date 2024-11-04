<?php
session_start();
include 'functions.php';

$questions = loadQuestionsFromFile('test3.txt');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    foreach ($questions as $question) {
        $questionId = $question['id'];
        if (isset($_POST["question_$questionId"]) && strtolower($_POST["question_$questionId"]) === strtolower($question['correct'][0])) {
            $score += 5;
        }
    }
    $_SESSION['score'] += $score;
    header("Location: results.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<?php include 'partials/head.php'; ?>
<body class="bg-light">
<div class="container mt-5">
    <div class="card p-4 shadow" style="max-width: 600px; margin: 0 auto;">
        <h2 class="text-center">Страница 3</h2>
        <form action="" method="post">
            <?php foreach ($questions as $question): ?>
                <div class="mb-3">
                    <label><?= $question['id'] . ". " . $question['text'] ?></label><br>
                    <input type="text" name="question_<?= $question['id'] ?>" class="form-control" required><br>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary w-100">Finish</button>
        </form>
    </div>
</div>
</body>
</html>
