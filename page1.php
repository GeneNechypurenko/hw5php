<?php
session_start();
include 'functions.php';

$questions = loadQuestionsFromFile('test1.txt');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    foreach ($questions as $question) {
        $questionId = $question['id'];
        if (isset($_POST["question_$questionId"]) && $_POST["question_$questionId"] === $question['correct'][0]) {
            $score++;
        }
    }
    $_SESSION['score'] = $score;
    header("Location: page2.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<?php include 'partials/head.php'; ?>
<body class="bg-light">
<div class="container mt-5">
    <div class="card p-4 shadow" style="max-width: 600px; margin: 0 auto;">
        <h2 class="text-center">Страница 1</h2>
        <form action="" method="post">
            <?php foreach ($questions as $question): ?>
                <div class="mb-3">
                    <label><?= $question['id'] . ". " . $question['text'] ?></label><br>
                    <?php foreach ($question['answers'] as $index => $answer): ?>
                        <input type="radio" name="question_<?= $question['id'] ?>" value="<?= $index + 1 ?>" required> <?= $answer ?><br>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary w-100">Next</button>
        </form>
    </div>
</div>
</body>
</html>
