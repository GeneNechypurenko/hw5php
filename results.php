<?php
session_start();
$totalScore = $_SESSION['score'];
session_destroy();
?>
<!DOCTYPE html>
<html lang="ru">
<?php include 'partials/head.php'; ?>
<body class="bg-light">
<div class="container mt-5">
    <div class="card p-4 shadow" style="max-width: 600px; margin: 0 auto;">
        <h2 class="text-center">Ваш результат</h2>
        <p class="text-center">Вы набрали <?= $totalScore ?> баллов.</p>
        <a href="page1.php" class="btn btn-secondary w-100">Начать заново</a>
    </div>
</div>
</body>
</html>
