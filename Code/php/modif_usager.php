<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/ajouterusager.css">
    <title>Modifier un Usager</title>
    <?php
    // Assurez-vous d'inclure les fichiers nécessaires (menu.php, connecter.php, BDD.php)
    include('menu.php');
    include('connecter.php');
    include('BDD.php');

    // Vérifier si l'ID de l'usager est passé en paramètre
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $usager_id = $_GET['id'];

        // Récupérer les informations actuelles de l'usager
        $sql = "SELECT * FROM usager WHERE ID_USAGER = :usager_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usager_id', $usager_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usager = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "Usager non trouvé.";
            exit;
        }
    } else {
        echo "ID d'usager non spécifié.";
        exit;
    }
    ?>
</head>

<body>
    <h1>Modifier un Usager</h1>

    <form method="post" action="traitement_modif_usag.php">
        <input type="hidden" name="usager_id" value="<?php echo $usager['ID_USAGER']; ?>">

        Civilité:
        <div class="civilite-options">
            <div class="civilite-option">
                <label>Monsieur:</label>
                <input type="radio" name="civilite" value="Monsieur" <?php echo ($usager['Civilite'] == 'Monsieur') ? 'checked' : ''; ?> required>
            </div>

            <div class="civilite-option">
                <label>Madame:</label>
                <input type="radio" name="civilite" value="Madame" <?php echo ($usager['Civilite'] == 'Madame') ? 'checked' : ''; ?> required>
            </div>
        </div>
        
        <br><br>
        Nom: <input type="text" name="nom" value="<?php echo $usager['Nom']; ?>" required>
        Prénom: <input type="text" name="prenom" value="<?php echo $usager['Prenom']; ?>" required>
        Adresse: <input type="text" name="adresse" value="<?php echo $usager['Adresse']; ?>" required>
        Lieu de Naissance: <input type="text" name="lieu_naissance" value="<?php echo $usager['Lieu_Naissance']; ?>" required>
        Date de Naissance: <input type="date" name="date_naissance" value="<?php echo $usager['Date_Naissance']; ?>" required>
        Numéro de Sécurité Sociale: <input type="text" name="numero_secu" pattern="\d{13}" title="Le numéro de sécurité sociale doit contenir 13 chiffres" value="<?php echo $usager['Numero_Secu']; ?>" required>
        Usager:
        <select name="usager_ref">
            <?php 
            // Assurez-vous de sélectionner le médecin référent actuel dans la liste.
            include 'afficher_liste_usag.php';  
            ?>
        </select><br><br>
        Médecin référent:
        <select name="medecin_ref">
            <?php 
            // Assurez-vous de sélectionner le médecin référent actuel dans la liste.
            include 'afficher_liste_med.php';  
            ?>
        </select><br><br>
        <input type="submit" value="Modifier">
    </form>

</body>
</html>
