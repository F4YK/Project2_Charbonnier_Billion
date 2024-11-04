<?php
// Paramètres de connexion
$host = 'mysql-x8x8x8.alwaysdata.net';
$dbname = 'x8x8x8_project2';
$username = 'x8x8x8';
$password = 'alemgi24';

try {
    // Vérifier si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les valeurs du formulaire
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $confirm_pass = $_POST['confirm_password'];

        // Vérifier si les mots de passe correspondent
        if ($pass === $confirm_pass) {
            // Hacher le mot de passe pour plus de sécurité
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // Préparer la requête SQL pour insérer les données
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $user);
            $stmt->bindParam(':password', $hashed_password);

            // Exécuter la requête
            $stmt->execute();

            echo "Compte créé avec succès !";
        } else {
            echo "Les mots de passe ne correspondent pas.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
