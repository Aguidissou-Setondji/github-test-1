<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=github_test;charset=utf8', 'root', 'Phanel23!');

// Récupérer tous les utilisateurs
$sql = "SELECT * FROM users ORDER BY created_at DESC";
$inscrip = $pdo->query($sql);
$users = $inscrip->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des inscrits</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f4f9;
            margin: 0;
        }
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: left;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Liste des utilisateurs inscrits</h2>
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Date d’inscription</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['nom']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= $user['created_at'] ?></td>
                    <td>
                        <a href="modifier.php?id=<?= $user['id'] ?>">✏️ Modifier</a> |
                        <a href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Confirmer la suppression ?');">❌ Supprimer</a>
                     </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div style="text-align: center; margin-top: 20px;">
        <a href="index.php">
            <button style="padding: 10px 20px; font-size: 16px; cursor: pointer;">⬅️ Retour à l’accueil</button>
        </a>
    </div>
</body>
</html>
