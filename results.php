<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>En İyi Skorlar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>En İyi Skorlar</h1>
    <ul>
        <?php
        $file = 'scores.txt';
        $scores = file($file, FILE_IGNORE_NEW_LINES);
        usort($scores, function($a, $b) {
            return (int)explode(' - ', $a)[1] - (int)explode(' - ', $b)[1];
        });
        $top_scores = array_slice($scores, 0, 3);
        foreach ($top_scores as $score) {
            echo "<li>$score</li>";
        }
        ?>
    </ul>
    <a href="index.php">Ana Sayfa</a>
</body>
</html>
