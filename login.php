<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=github_test", "root", "Phanel23!");

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $inscrip = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $inscrip->execute([$username]);
    $admin = $inscrip->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['username'];
        header("Location: liste.php");
        exit();
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Se Connecter</title>
</head>
<body>
    <h2>Se connecter en tant qu'admin</h2>
    <?php if ($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required><br><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
<footer class="home">
    <a href="index.php" style="float: right;">
        <button> Accueil </button>
    </a>
</footer>
</html>
