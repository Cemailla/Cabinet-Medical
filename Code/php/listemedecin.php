<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/listemedecin.css">
    <title>Liste des Médecins</title>
</head>
<body>
   
    <?php
    include('menu.php');
    ?>
    <h1>Liste des Médecins</h1>
        

    <?php
    include 'BDD.php';
    include('connecter.php');
    
    try {
    $sql = "SELECT * FROM medecin";
    $stmt = $conn->query($sql);

    if ($stmt->rowCount() > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Civilité</th><th>Nom</th><th>Prénom</th><th>Actions</th>";

        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['ID_Medecin']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Civilite']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Nom']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Prenom']) . "</td>";
            echo "<td><a href='modif_medecin.php?id=" . $row['ID_Medecin'] . "'>Modifier</a> | <a href='supp_medecin.php?id=" . $row['ID_Medecin'] . "'>Supprimer</a></td>";
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
<a href="ajoutermedecin.php" id="ajouterLink">
        <img src="../images/logo_plus.png" alt="Ajouter un medecin">
        Ajouter un médecin
</a>


</body>
</html>