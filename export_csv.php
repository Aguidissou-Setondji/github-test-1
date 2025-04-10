<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=github_test;charset=utf8', 'root', 'Phanel23!');

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=utilisateurs.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'Nom', 'Email', 'Date d’inscription']);

$search = !empty($_GET['search']) ? '%' . $_GET['search'] . '%' : null;

if ($search) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE nom LIKE ? OR email LIKE ? ORDER BY created_at DESC");
    $stmt->execute([$search, $search]);
} else {
    $stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
}

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, [$row['id'], $row['nom'], $row['email'], $row['created_at']]);
}
fclose($output);
exit;
