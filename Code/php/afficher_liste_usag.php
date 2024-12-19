<?php
include 'BDD.php';
include('connecter.php');
try {
    $sqlUsagers = "SELECT ID_USAGER, Nom, Prenom FROM usager";
    $stmtUsagers = $conn->query($sqlUsagers);

    if ($stmtUsagers->rowCount() > 0) {
        while ($usager = $stmtUsagers->fetch()) {
            echo "<option value='" . $usager['ID_USAGER'] . "'>" . $usager['Nom'] . " " . $usager['Prenom'] . "</option>";
        }
    } else {
        echo "<option value=''>Aucun usager trouvé</option>";
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
