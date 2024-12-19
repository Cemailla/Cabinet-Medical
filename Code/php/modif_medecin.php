<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/ajoutermedecin.css">
    <title>Modifier un Médecin</title>
    <?php
    include('BDD.php');
    include('connecter.php');
    // Vérifier si l'ID du médecin est passé en paramètre
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $medecin_id = $_GET['id'];

        // Récupérer les informations actuelles du médecin
        $sql = "SELECT * FROM medecin WHERE ID_Medecin = :medecin_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':medecin_id', $medecin_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $medecin = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "Médecin non trouvé.";
            exit;
        }
    } else {
        echo "ID de médecin non spécifié.";
        exit;
    }
    ?>
</head>

<body>
    <?php include('menu.php'); ?>   
    <h1>Modifier un Médecin</h1>

    <form method="post" action="traitement_modif_med.php">
        <!-- Ajouter le champ caché pour l'ID du médecin -->
        <input type="hidden" name="medecin_id" value="<?php echo $medecin['ID_Medecin']; ?>">

        Civilité:
        <div class="civilite-options">
            <div class="civilite-option">
                <label>Monsieur:</label>
                <input type="radio" name="civilite" id="monsieur" value="Monsieur" <?php echo ($medecin['Civilite'] == 'Monsieur') ? 'checked' : ''; ?> required>
            </div>

            <div class="civilite-option">
                <label>Madame:</label>
                <input type="radio" name="civilite" id="madame" value="Madame" <?php echo ($medecin['Civilite'] == 'Madame') ? 'checked' : ''; ?> required>
            </div>
        </div>
        
        <br><br>
        Nom: <input type="text" name="nom" value="<?php echo htmlspecialchars($medecin['Nom']); ?>" required>
        Prénom: <input type="text" name="prenom" value="<?php echo htmlspecialchars($medecin['Prenom']); ?>" required>
        <input type="submit" value="Modifier Médecin">
    </form>

</body>
</html>
