<?php
session_start();
include 'functions.php';

$questions = loadQuestionsFromFile('test2.txt');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    foreach ($questions as $question) {
        $questionId = $question['id'];
        $userAnswers = isset($_POST["question_$questionId"]) ? $_POST["question_$questionId"] : [];
        if ($userAnswers === $question['correct']) {
            $score += 3;
        }
    }
    $_SESSION['score'] += $score;
    header("Location: page3.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<?php include 'partials/head.php'; ?>
<body class="bg-light">
<div class="container mt-5">
    <div class="card p-4 shadow" style="max-width: 600px; margin: 0 auto;">
        <h2 class="text-center">Страница 2</h2>
        <form action="" method="post">
            <?php foreach ($questions as $question): ?>
                <div class="mb-3">
                    <label><?= $question['id'] . ". " . $question['text'] ?></label><br>
                    <?php foreach ($question['answers'] as $index => $answer): ?>
                        <input type="checkbox" name="question_<?= $question['id'] ?>[]" value="<?= $index + 1 ?>"> <?= $answer ?><br>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary w-100">Next</button>
        </form>
    </div>
</div>
</body>
</html>
