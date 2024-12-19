<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Se connecter</title>
</head>
<body>
    <div class="login-container">
        <form action="./traitement_login.php" method="post">
            <h1>Se connecter</h1>
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" name="username" required>
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" required>
            <button type="submit" name="connecter">Se connecter</button>
        </form>
    </div>
</body>
</html>

