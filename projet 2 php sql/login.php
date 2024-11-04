<?php
session_start();

// Paramètres de connexion à la base de données
$host = 'mysql-x8x8x8.alwaysdata.net';
$dbname = 'x8x8x8_project2';
$username = 'x8x8x8';
$password = 'alemgi24';

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Requête pour vérifier si l'utilisateur existe
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: citationview.html"); // Redirige vers la page après connexion
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main">
        <p class="sign" align="center">Log in</p>
        <form class="form1" method="POST" action="login.php">
            <input class="un" type="text" name="username" placeholder="Username" required>
            <input class="pass" type="password" name="password" placeholder="Password" required>
            <button class="submit1" type="submit">Log In</button>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            <p class="forgot" align="center">You don't have an account ?</p>
            <a class="submit2" align="center" href="signup.html">Create an Account</a>
        </form>
    </div>
</body>
</html>
