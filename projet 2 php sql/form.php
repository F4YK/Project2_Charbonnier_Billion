<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h3>PDO : Connexion à une BDD SQL</h3>
    <?php
    //Identification de connexion à la BDD
    $server='mysql-x8x8x8.alwaysdata.net';
    $db='x8x8x8_testproject2';
    $user='x8x8x8';
    $password='alemgi24';
    
    try
    {
        $connexion=new PDO("mysql:host=$server;dbname=$db", $user, $password);
        if($connexion) echo 'Connexion réussie';
    }
    catch (PDOException $event)
    {
        die('Erreur :' .$event->getMessage());
    }

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $id_number = $_POST['id_number'];
  
    $inserer="INSERT INTO connexion VALUES ('', '$username', '$password', '$role')";
    $inserer=$connexion->exec($inserer);

    $selectionner="SELECT username, id_user FROM connexion";
    $selectionner=$connexion->query($selectionner);
    while ($res=$selectionner->FETCH(PDO::FETCH_OBJ))
        var_dump($res);
    }

?>

</head>
</body>
