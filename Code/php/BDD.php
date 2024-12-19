<?php

    $servername = "localhost";
    $username = "etu";
    $password = "iutinfo";
    $dbname = "cabinet";
    

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Retiré l'écho de "Connexion réussie" pour éviter des outputs inutiles.
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

?>
