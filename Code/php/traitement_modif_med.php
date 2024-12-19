<?php
include 'BDD.php';
include('connecter.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $medecin_id = $_POST['medecin_id'];
    $civilite = $_POST['civilite'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    try {
        // Mettre à jour les informations du médecin dans la base de données
        $sql = "UPDATE medecin SET Civilite = :civilite, Nom = :nom, Prenom = :prenom WHERE ID_Medecin = :medecin_id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':medecin_id', $medecin_id, PDO::PARAM_INT);
        $stmt->bindParam(':civilite', $civilite, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);

        $stmt->execute();

        echo "Médecin modifié avec succès.";
        echo "<br><br>";
        echo '<a href="listemedecin.php">Retourner à la liste des médecin</a>';
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
