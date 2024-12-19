<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/supp_usager.css">
    <title>Supprimer un Médecin</title>
    <?php
    include('BDD.php');
    include('connecter.php');
    
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $medecin_id = $_GET['id'];

        
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
        echo "ID du Médecin non spécifié.";
        exit;
    }
    ?>
</head>

<body>
    <?php include('menu.php'); ?>    
    <h1>Supprimer un Médecin</h1>

    <p>Voulez-vous vraiment supprimer Docteur <?php echo $medecin['Nom'] . ' ' . $medecin['Prenom']; ?> ?</p>
    
    <form method="post" action="traitement_supp_med.php">
        
        <input type="hidden" name="medecin_id" value="<?php echo $medecin['ID_Medecin']; ?>">
        
        
        <button class="supp"type="submit" name="confirm" value="1">Oui, supprimer</button>
        <a class="annuler"href="listemedecin.php">Annuler</a>
    </form>

</body>
</html>
