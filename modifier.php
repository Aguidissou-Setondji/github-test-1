<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=github_test;charset=utf8', 'root', 'Phanel23!');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupère les données actuelles
    $inscrip = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $inscrip->execute([$id]);
    $user = $inscrip->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("Utilisateur non trouvé.");
    }

    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];
        $email = $_POST['email'];

        $inscrip = $pdo->prepare("UPDATE users SET nom = ?, email = ? WHERE id = ?");
        $inscrip->execute([$nom, $email, $id]);

        header("Location: liste.php");
        exit;
    }
} else {
    die("ID non fourni.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l’utilisateur</title>
</head>
<body>
    <h2>Modifier l'utilisateur</h2>
    <form method="POST">
        <label>Nom :</label><br>
        <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required><br><br>

        <label>Email :</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
