<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=github_test;charset=utf8', 'root', 'Phanel23!');

// Nombre d'inscrits par page
$parPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $parPage;

// Compter le total
$total = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$pages = ceil($total / $parPage);

// Récupérer tous les utilisateurs
if (!empty($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    $inscrip = $pdo->prepare("SELECT * FROM users WHERE nom LIKE ? OR email LIKE ? ORDER BY created_at DESC LIMIT $parPage OFFSET $offset");
    $inscrip->execute([$search, $search]);
    $users = $inscrip->fetchAll(PDO::FETCH_ASSOC);

    // Pour la pagination, on compte aussi les résultats filtrés
    $countInscrip = $pdo->prepare("SELECT COUNT(*) FROM users WHERE nom LIKE ? OR email LIKE ?");
    $countInscrip->execute([$search, $search]);
    $total = $countInscrip->fetchColumn();
    $pages = ceil($total / $parPage);
} else {
    $inscrip = $pdo->query("SELECT * FROM users ORDER BY created_at DESC LIMIT $parPage OFFSET $offset");
    $users = $inscrip->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des inscrits</title>
    <link rel="stylesheet" href="styleListe.css">
</head>
<body>
    <div class="container">
        <h2>Liste des utilisateurs inscrits</h2>
        <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Rechercher par nom ou email" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <button type="submit"> Rechercher</button>
        </form>
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
                        <a class="btn-edit" href="modifier.php?id=<?= $user['id'] ?>"> Modifier</a> |
                        <a class= "btn-delete" href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Confirmer la suppression ?');"> Supprimer</a>
                     </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
        <div class="pagination">
            <?php for ($i = 1; $i <= $pages; $i++) : ?>
                <a href="?page=<?= $i ?>" style="margin: 0 5px; <?= $i === $page ? 'font-weight: bold;' : '' ?>">
                <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
        <div class="export">
            <a href="export_csv.php<?= isset($_GET['search']) ? '?search=' . urlencode($_GET['search']) : '' ?>">
                <button >Exporter en CSV</button>
            </a>
            <a href="index.php">
                <button >Retour à l’accueil</button>
            </a>
        </div>
    </div>
</body>
</html>
