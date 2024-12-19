<?php
include 'BDD.php';
include('connecter.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usager_id = $_POST['usager_id'];
    $civilite = $_POST['civilite'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $lieu_naissance = $_POST['lieu_naissance'];
    $date_naissance = $_POST['date_naissance'];
    $numero_secu = $_POST['numero_secu'];
    $medecin_ref = $_POST['medecin_ref'];

    try {
        $sql = "UPDATE usager 
                SET Civilite = :civilite, Nom = :nom, Prenom = :prenom, Adresse = :adresse, Lieu_Naissance = :lieu_naissance, 
                    Date_Naissance = :date_naissance, Numero_Secu = :numero_secu, ID_Medecin_Ref = :medecin_ref 
                WHERE ID_USAGER = :usager_id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':usager_id', $usager_id, PDO::PARAM_INT);
        $stmt->bindParam(':civilite', $civilite, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindParam(':lieu_naissance', $lieu_naissance, PDO::PARAM_STR);
        $stmt->bindParam(':date_naissance', $date_naissance);
        $stmt->bindParam(':numero_secu', $numero_secu, PDO::PARAM_STR);
        $stmt->bindParam(':medecin_ref', $medecin_ref, PDO::PARAM_INT);

        $stmt->execute();
        echo "Usager modifié avec succès.";
        echo "<br><br>";
        echo '<a href="listeusager.php">Retourner à la liste des usagers</a>';
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
