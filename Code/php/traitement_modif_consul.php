<?php
include 'BDD.php';
include('connecter.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idConsultation = $_POST['idConsultation'];
    $dateConsultation = $_POST['date_consultation'];
    $heure = $_POST['heure'];
    $duree = $_POST['duree'];
    $usager = $_POST['usager'];
    $medecin = $_POST['medecin'];

    try {
        $sql = "UPDATE consultation 
                SET Date_Consultation = :dateConsultation, 
                    Heure = :heure, 
                    Duree = :duree, 
                    ID_USAGER = :usager, 
                    ID_Medecin = :medecin
                WHERE ID_Consultation = :idConsultation";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':idConsultation', $idConsultation, PDO::PARAM_INT);
        $stmt->bindParam(':dateConsultation', $dateConsultation);
        $stmt->bindParam(':heure', $heure);
        $stmt->bindParam(':duree', $duree, PDO::PARAM_INT);
        $stmt->bindParam(':usager', $usager, PDO::PARAM_INT);
        $stmt->bindParam(':medecin', $medecin, PDO::PARAM_INT);

        $stmt->execute();
        
        echo "Consultation modifier avec succès.";

        // Ajoutez le bouton de retour vers listeusager.php
        echo "<br><br>";
        echo '<a href="listeconsultation.php">Retourner à la liste des consultations</a>';
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
