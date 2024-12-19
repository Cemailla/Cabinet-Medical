<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/ajoutermedecin.css">
    <title>Ajouter un Médecin</title>
   
</head>

<body>
    <?php include('menu.php'); 
    include('BDD.php');
    include('connecter.php');?>
    <h1>Ajouter un Médecin</h1>

    <body>
    <form method="post" action="traitement_ajout_med.php">
        Civilité:
        <div class="civilite-options">
            <div class="civilite-option">
                <label >Monsieur:</label>
            </div>
            <div class="civilite-option">
                <input type="radio" name="civilite" id="monsieur" value="Monsieur" required>
            </div>

            <div class="civilite-option">
                <label>Madame:</label>
            </div>
            <div class="civilite-option">
                <input type="radio" name="civilite" id="madame" value="Madame" required>
        </div>
        </div>
        
        <br><br>
        Nom: <input type="text" name="nom" required>
        Prénom: <input type="text" name="prenom" required>
        <input type="submit" value="Ajouter Medecin">
    </form>

</body>
</html>
