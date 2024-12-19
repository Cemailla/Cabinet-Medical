<?php
include 'BDD.php';
include('connecter.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    $consultationID = $_POST['consultation_id'];

    try {
        // Supprimer la consultation de la base de données
        $sql = "DELETE FROM consultation WHERE ID_Consultation = :consultationID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':consultationID', $consultationID, PDO::PARAM_INT);
        $stmt->execute();

        echo "Consultation supprimée avec succès.";
        echo "<br><br>";
        echo '<a href="listeconsultation.php">Retourner à la liste des Consultations</a>';
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
} else {
    echo "Confirmation non reçue.";
}
?>
