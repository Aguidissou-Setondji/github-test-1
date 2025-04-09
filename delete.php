<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

// Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=github_test;charset=utf8', 'root', 'Phanel23!');

    $inscrip = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $inscrip->execute([$id]);

    // Redirection
    header("Location: liste.php");
    exit;
} else {
    echo "ID invalide.";
}
