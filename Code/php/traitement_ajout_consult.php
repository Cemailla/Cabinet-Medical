<?php
include 'BDD.php';
include('connecter.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $dateConsultation = $_POST['date_consultation'];
    $heure = $_POST['heure'];
    $duree = $_POST['duree'];
    $usagerID = $_POST['usager'];
    $medecinID = $_POST['medecin'];

    try {
        // Vérifier le chevauchement des consultations pour le même médecin
        $sqlChevauchement = "SELECT COUNT(*) as countChevauchement
                             FROM consultation
                             WHERE ID_Medecin = :medecinID
                             AND (:dateConsultation + INTERVAL :duree MINUTE) > Date_Consultation
                             AND :dateConsultation < (Date_Consultation + INTERVAL Duree MINUTE)";
        
        $stmtChevauchement = $conn->prepare($sqlChevauchement);
        $stmtChevauchement->bindParam(':medecinID', $medecinID, PDO::PARAM_INT);
        $stmtChevauchement->bindParam(':dateConsultation', $dateConsultation);
        $stmtChevauchement->bindParam(':duree', $duree, PDO::PARAM_INT);

        $stmtChevauchement->execute();
        $resultChevauchement = $stmtChevauchement->fetch(PDO::FETCH_ASSOC);

        if ($resultChevauchement['countChevauchement'] > 0) {
            // Consultation chevauche une autre, afficher un message d'erreur
            echo "Erreur : Le médecin a déjà une consultation planifiée pendant cette période.";
            echo "<br><br>";
            echo '<a href="ajouterconsultation.php">Retourner à la page d\'ajout de consultation</a>';
        } else {
            // Aucun chevauchement, insérer la nouvelle consultation dans la base de données
            $sqlInsert = "INSERT INTO consultation (Date_Consultation, Heure, Duree, ID_USAGER, ID_Medecin) 
                          VALUES (:dateConsultation, :heure, :duree, :usagerID, :medecinID)";
            $stmtInsert = $conn->prepare($sqlInsert);

            $stmtInsert->bindParam(':dateConsultation', $dateConsultation);
            $stmtInsert->bindParam(':heure', $heure);
            $stmtInsert->bindParam(':duree', $duree);
            $stmtInsert->bindParam(':usagerID', $usagerID, PDO::PARAM_INT);
            $stmtInsert->bindParam(':medecinID', $medecinID, PDO::PARAM_INT);

            $stmtInsert->execute();

            echo "Consultation ajoutée avec succès.";
            echo "<br><br>";
            echo '<a href="listeconsultation.php">Retourner à la liste des Consultations</a>';
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
