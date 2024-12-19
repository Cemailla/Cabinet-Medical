<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/statistique.css">
    <title>Statistiques</title>
   
</head>

<body>
    <?php include('menu.php'); ?>

    <h1>Statistiques</h1>

<?php
include 'BDD.php';
include('connecter.php');
// Statistique 1 : Répartition des usagers par sexe et âge

try {
    echo "<h2>Répartition des usagers selon leur sexe et leur âge</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Tranche d'âge</th><th>Nb Hommes</th><th>Nb Femmes</th></tr>";

    // Calcul de la répartition par tranche d'âge et sexe
    $tranches = [
        'Moins de 25 ans' => 'YEAR(CURDATE()) - YEAR(Date_Naissance) < 25',
        'Entre 25 et 50 ans' => 'YEAR(CURDATE()) - YEAR(Date_Naissance) BETWEEN 25 AND 50',
        'Plus de 50 ans' => 'YEAR(CURDATE()) - YEAR(Date_Naissance) > 50'
    ];

    foreach ($tranches as $tranche => $condition) {
        $sql = "SELECT Civilite, COUNT(*) as Nombre FROM usager WHERE $condition GROUP BY Civilite";
        $stmt = $conn->query($sql);
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $nbHommes = $nbFemmes = 0;
        foreach ($resultats as $ligne) {
            if ($ligne['Civilite'] == 'Monsieur') {
                $nbHommes = $ligne['Nombre'];
            } elseif ($ligne['Civilite'] == 'Madame') {
                $nbFemmes = $ligne['Nombre'];
            }
        }

        echo "<tr><td>$tranche</td><td>$nbHommes</td><td>$nbFemmes</td></tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Statistique 2 : Durée totale des consultations par médecin (en nombre d'heures)
try {
    echo "<h2>Durée totale des consultations par médecin</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Médecin</th><th>Durée totale (heures)</th></tr>";

    // Remplacez 'ID_Medecin' par la colonne appropriée si différente dans votre table de consultation
    $sql = "SELECT medecin.Nom, medecin.Prenom, SUM(consultation.Duree) as TotalDuree 
            FROM consultation 
            JOIN medecin ON consultation.ID_Medecin = medecin.ID_Medecin 
            GROUP BY consultation.ID_Medecin";
    $stmt = $conn->query($sql);

    while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $nomMedecin = $ligne['Nom'] . " " . $ligne['Prenom'];
        $totalHeures = $ligne['TotalDuree'];
        echo "<tr><td>$nomMedecin</td><td>$totalHeures</td></tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

?>

</body>

</html>
