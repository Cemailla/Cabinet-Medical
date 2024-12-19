<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/ajouterusager.css">
    <title>Ajouter un Usager</title>
   
</head>

<body>
    <?php include('menu.php'); 
    include('connecter.php');
    include('BDD.php');?>  
    <h1>Ajouter un Usager</h1>

    <body>
    <form method="post" action="traitement_ajout_usag.php">
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
        Adresse: <input type="text" name="adresse" required>
        Lieu de Naissance: <input type="text" name="lieu_naissance" required>
        Date de Naissance: <input type="date" name="date_naissance" required>
        Numéro de Sécurité Sociale: <input type="text" name="numero_secu" pattern="\d{13}" title="Le numéro de sécurité sociale doit contenir 13 chiffres" required>
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
        <input type="submit" value="Ajouter">
    </form>

</body>
</html>
