<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['last_name'] = $_POST['last_name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['number'] = rand(1, 1000);
    $_SESSION['attempts'] = 0;
    $_SESSION['max_attempts'] = 10;
}

if (!isset($_SESSION['number'])) {
    header('Location: index.php');
    exit();
}

$number = $_SESSION['number'];
$attempts = $_SESSION['attempts'];
$max_attempts = $_SESSION['max_attempts'];
$message = '';

if (isset($_POST['guess'])) {
    $guess = intval($_POST['guess']);
    $_SESSION['attempts']++;

    if ($guess > $number) {
        $message = "Daha küçük bir sayı girin.";
    } elseif ($guess < $number) {
        $message = "Daha büyük bir sayı girin.";
    } else {
        $message = "Tebrikler! Sayıyı doğru tahmin ettiniz.";
        saveScore($attempts + 1);
        session_destroy();
    }

    if ($_SESSION['attempts'] >= $max_attempts) {
        $message = "Tahmin hakkınız bitti. Doğru sayı: $number.";
        session_destroy();
    }
}

function saveScore($score) {
    $file = 'scores.txt';
    $scores = file($file, FILE_IGNORE_NEW_LINES);
    $scores[] = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . ' - ' . $score;
    file_put_contents($file, implode(PHP_EOL, $scores));
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Sayı Bulma Oyunu</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Sayı Bulma Oyunu</h1>
    <p><?php echo $message; ?></p>

    <?php if (!empty($message) && strpos($message, 'Tebrikler') === false && strpos($message, 'Tahmin hakkınız bitti') === false): ?>
        <form action="game.php" method="post">
            <label for="guess">Tahmininizi girin:</label>
            <input type="number" id="guess" name="guess" min="1" max="1000" required><br>
            <input type="submit" value="Tahmin Et">
        </form>
    <?php endif; ?>

    <?php if (strpos($message, 'Tebrikler') !== false || strpos($message, 'Tahmin hakkınız bitti') !== false): ?>
        <a href="index.php">Tekrar Oyna</a>
        <a href="results.php">En İyi Skorlar</a>
    <?php endif; ?>
</body>
</html>
