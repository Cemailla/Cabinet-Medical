<?php
include 'BDD.php';
include('connecter.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $civilite = $_POST['civilite'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    try {
        // Insérer un nouveau médecin dans la base de données
        $sql = "INSERT INTO medecin (Civilite, Nom, Prenom) VALUES (:civilite, :nom, :prenom)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':civilite', $civilite, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);

        $stmt->execute();

        echo "Médecin ajouté avec succès.";
        echo "<br><br>";
        echo '<a href="listemedecin.php">Retourner à la liste des Médecins</a>';
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
