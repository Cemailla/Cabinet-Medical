<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/listeconsultation.css">
    <title>Liste des Consultations</title>
    
</head>

<body>
    
    <?php include('menu.php');  
    ?>
    <h1>Liste des consultations</h1>
    <?php
    include('connecter.php');
        // Récupérer l'ID du médecin sélectionné si présent
    $medecinSelectionne = isset($_GET['medecin']) ? $_GET['medecin'] : '';

    // Afficher le menu déroulant pour sélectionner un médecin
    echo "<form action='' method='get' class='filter-form'>";
    echo "Filtrer par médecin: <select name='medecin' onchange='this.form.submit()'>";
    echo "<option value=''>Tous les médecins</option>";

    // Générer les options pour le menu déroulant
    $sqlMedecins = "SELECT ID_Medecin, Nom, Prenom FROM medecin";
    foreach ($conn->query($sqlMedecins) as $medecin) {
        $selected = $medecin['ID_Medecin'] == $medecinSelectionne ? 'selected' : '';
        echo "<option value='" . $medecin['ID_Medecin'] . "' $selected>" . $medecin['Nom'] . " " . $medecin['Prenom'] . "</option>";
    }
    echo "</select>";
    echo "</form>";
  

include 'BDD.php';

$sortBy = isset($_GET['sortBy']) ? $_GET['sortBy'] : 'Date_Consultation'; // Colonne par défaut
$sortOrder = isset($_GET['sortOrder']) && $_GET['sortOrder'] === 'desc' ? 'DESC' : 'ASC';

function getSortIcon($column, $currentSortBy, $currentSortOrder) {
    if ($column === $currentSortBy) {
        return $currentSortOrder === 'ASC' ? '▲' : '▼';
    }
    return '';
}

try {
    
    $sql = "SELECT c.ID_Consultation, c.Date_Consultation, c.Heure, c.Duree, u.Nom AS UsagerNom, CONCAT(m.Prenom, ' ', m.Nom) AS MedecinNom
    FROM consultation c
    LEFT JOIN usager u ON c.ID_USAGER = u.ID_USAGER
    LEFT JOIN medecin m ON c.ID_Medecin = m.ID_Medecin";

    // Ajouter le filtre pour le médecin si sélectionné
    if (!empty($medecinSelectionne)) {
        $sql .= " WHERE m.ID_Medecin = :medecin";
    }

    $sql .= " ORDER BY $sortBy $sortOrder";

    $stmt = $conn->prepare($sql);

    // Bind du paramètre médecin si nécessaire
    if (!empty($medecinSelectionne)) {
        $stmt->bindParam(':medecin', $medecinSelectionne, PDO::PARAM_INT);
    }

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th><a href='listeconsultation.php?sortBy=Date_Consultation&sortOrder=" . ($sortBy === 'Date_Consultation' && $sortOrder === 'ASC' ? 'desc' : 'asc') . "'>Date Consultation " . getSortIcon('Date_Consultation', $sortBy, $sortOrder) . "</a></th>";
        echo "<th><a href='listeconsultation.php?sortBy=Heure&sortOrder=" . ($sortBy === 'Heure' && $sortOrder === 'ASC' ? 'desc' : 'asc') . "'>Heure " . getSortIcon('Heure', $sortBy, $sortOrder) . "</a></th>";
        echo "<th><a href='listeconsultation.php?sortBy=Duree&sortOrder=" . ($sortBy === 'Duree' && $sortOrder === 'ASC' ? 'desc' : 'asc') . "'>Durée " . getSortIcon('Duree', $sortBy, $sortOrder) . "</a></th>";
        echo "<th><a href='listeconsultation.php?sortBy=UsagerNom&sortOrder=" . ($sortBy === 'UsagerNom' && $sortOrder === 'ASC' ? 'desc' : 'asc') . "'>Usager " . getSortIcon('UsagerNom', $sortBy, $sortOrder) . "</a></th>";
        echo "<th><a href='listeconsultation.php?sortBy=MedecinNom&sortOrder=" . ($sortBy === 'MedecinNom' && $sortOrder === 'ASC' ? 'desc' : 'asc') . "'>Médecin " . getSortIcon('MedecinNom', $sortBy, $sortOrder) . "</a></th>";
        echo "<th class='invisible'>ID</th>";  // Colonne invisible
        echo "<th>Actions</th>";
        echo "</tr>";

        while ($row = $stmt->fetch()) {
            // Formater la date au format jour/mois/année
            $dateConsultation = date("d/m/Y", strtotime($row['Date_Consultation']));
     
            echo "<tr>";
            echo "<td>" . htmlspecialchars($dateConsultation) . "</td>";
            echo "<td>" . htmlspecialchars($row['Heure']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Duree']) . "</td>";
            echo "<td>" . htmlspecialchars($row['UsagerNom']) . "</td>";
            echo "<td>" . htmlspecialchars($row['MedecinNom']) . "</td>";
            echo "<td class='invisible'>" . htmlspecialchars($row['ID_Consultation']) . "</td>";
            echo "<td><a href='modif_consul.php?id=" . $row['ID_Consultation'] . "'>Modifier</a> | <a href='supp_consultation.php?id=" . $row['ID_Consultation'] . "'>Supprimer</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Aucune consultation trouvée.";
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
    <a href="ajouterconsultation.php" id="ajouterLink">
        <img src="../images/logo_plus.png" alt="Ajouter une consultation">
        Ajouter une consultation
    </a>
    
</body>
</html>
