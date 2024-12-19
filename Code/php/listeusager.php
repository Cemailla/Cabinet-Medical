<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/listesusagers.css">
    <title>Liste des Usagers</title>
</head>

<body>
    <?php
        include('menu.php');
    ?>
    <h1>Liste des Usagers</h1>
    
    <?php
    include 'BDD.php';
    include('connecter.php');
    try {
        $sql = "SELECT * FROM usager";
        $stmt = $conn->query($sql);

        if ($stmt->rowCount() > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Civilité</th><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Lieu de Naissance</th><th>Date de Naissance</th><th>Actions</th></tr>";
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['ID_USAGER']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Civilite']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Nom']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Prenom']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Adresse']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Lieu_Naissance']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Date_Naissance']) . "</td>";
                echo "<td><a href='modif_usager.php?id=" . $row['ID_USAGER'] . "'>Modifier</a> | <a href='supp_usager.php?id=" . $row['ID_USAGER'] . "'>Supprimer</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Aucun usager trouvé.";
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
    ?>

    <a href="ajouterusager.php" id="ajouterLink">
        <img src="../images/logo_plus.png" alt="Ajouter un usager">
        Ajouter un usager
    </a>
</body>
</html>