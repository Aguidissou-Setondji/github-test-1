<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>
<body>
    <h2>Formulaire d'inscription des utilisateurs</h2>
    <form action="traitement.php" method="POST">
        <label>Nom :</label><br>
        <input type="text" name="nom" required><br><br>

        <label>Email :</label><br>
        <input type="email" name="email" required><br><br>

        <label>Mot de passe :</label><br>
        <input type="password" name="mot_de_passe" required><br><br>

        <button type="submit">S'inscrire</button>
    </form>
</body>
<footer class="footer">
    <a href="login.php" style="float: right;" class="home button">
        <button> Administrateur </button>
    </a>
    <a href="liste.php" style="float: right;" class="list button">
        <button> Liste des inscrits </button>
    </a>
</footer>
</html>
