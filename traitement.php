<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=github_test;charset=utf8', 'root', 'Phanel23!');

// Vérifie si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT); // on sécurise le mot de passe

    // Préparation de la requête
    $inscrip = $pdo->prepare("INSERT INTO users (nom, email, mot_de_passe) VALUES (?, ?, ?)");
    $result = $inscrip->execute([$nom, $email, $mot_de_passe]);

    if ($result) {
        echo "Inscription réussie !";
    } else {
        echo "Une erreur est survenue.";
    }

      // Redirection
      header("Location: liste.php");
      exit;
}
?>
