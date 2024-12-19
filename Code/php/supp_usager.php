<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/supp_usager.css">
    <title>Supprimer un Usager</title>
    <?php
    include('BDD.php');
    include('connecter.php');
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
    <?php include('menu.php'); ?>   
    <h1>Supprimer un Usager</h1>

    <p>Voulez-vous vraiment supprimer l'usager <?php echo $usager['Nom'] . ' ' . $usager['Prenom']; ?> ?</p>
    
    <form method="post" action="traitement_supp_usag.php">
        <!-- Ajouter le champ caché pour l'ID de l'usager -->
        <input type="hidden" name="usager_id" value="<?php echo $usager['ID_USAGER']; ?>">
        
        <!-- Ajouter les boutons de confirmation et d'annulation -->
        <button class="supp"type="submit" name="confirm" value="1">Oui, supprimer</button>
        <a class="annuler"href="listeusager.php">Annuler</a>
    </form>

</body>
</html>
