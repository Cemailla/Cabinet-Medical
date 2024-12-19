<?php
session_start();
include 'BDD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM utilisateurs WHERE NomUtilisateur = :username AND MotDePasse = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    
    if (!$stmt->execute()) {
        die("Erreur SQL : " . $stmt->errorInfo()[2]);
    }

    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['connected'] = true;
        header('Location: ./index.php');
    } else {
        
        echo '<a href="login.php">Retourner à la page de connexion</a>';
        $error = "Identifiants ou mot de passe Incorrects";
    }
}
if (isset($error) && !empty($error)) {
    echo "<p style='color: red;'>$error</p>";
}
?>