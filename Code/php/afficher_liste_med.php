<?php

include 'BDD.php';
include('connecter.php');
try {
    $sqlMedecins = "SELECT ID_Medecin, Nom, Prenom FROM medecin";
    $stmtMedecins = $conn->query($sqlMedecins);

    if ($stmtMedecins->rowCount() > 0) {
        while ($medecin = $stmtMedecins->fetch()) {
            echo "<option value='" . $medecin['ID_Medecin'] . "'>" . $medecin['Nom'] . " " . $medecin['Prenom'] . "</option>";
        }
    } else {
        echo "<option value=''>Aucun médecin trouvé</option>";
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
