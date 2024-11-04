<?php
// Paramètres de connexion
$host = 'mysql-x8x8x8.alwaysdata.net'; // adresse du serveur MySQL
$dbname = 'x8x8x8_project2'; // nom de la base de données
$username = 'x8x8x8'; // nom d'utilisateur MySQL
$password = 'alemgi24'; // mot de passe MySQL

try {
    // Créer une connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les valeurs du formulaire
        $citation = $_POST['citation'];
        $auteur = !empty($_POST['auteur']) ? $_POST['auteur'] : NULL;

        // Préparer la requête SQL pour insérer les données
        $stmt = $pdo->prepare("INSERT INTO citations (citation, auteur) VALUES (:citation, :auteur)");
        $stmt->bindParam(':citation', $citation);
        $stmt->bindParam(':auteur', $auteur);

        // Exécuter la requête
        $stmt->execute();

        echo "La citation a été ajoutée avec succès !";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
