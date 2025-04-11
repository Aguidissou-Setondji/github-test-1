<?php
// Fichier temporaire pour créer un admin
$pdo = new PDO("mysql:host=localhost;dbname=github_test", "root", "Phanel23!");

$username = "admin";
$password = password_hash("motdepasse123", PASSWORD_DEFAULT);

$inscrip = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
$inscrip->execute([$username, $password]);

echo "Admin créé avec succès.";