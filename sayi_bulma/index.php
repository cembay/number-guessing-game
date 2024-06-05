<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Sayı Bulma Oyunu</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Sayı Bulma Oyununa Hoş Geldiniz</h1>
    <form action="game.php" method="post">
        <label for="first_name">Ad:</label>
        <input type="text" id="first_name" name="first_name" required><br>
        <label for="last_name">Soyad:</label>
        <input type="text" id="last_name" name="last_name" required><br>
        <label for="email">Eposta:</label>
        <input type="email" id="email" name="email" required><br>
        <input type="submit" value="Oyuna BAŞLA">
    </form>
</body>
</html>
