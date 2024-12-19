<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/ajouterconsultation.css">
    <title>Ajouter une Consultation</title>
    
</head>

<body>
    <?php include('menu.php'); 
    include('connecter.php');
    include('BDD.php');?>
    <h1>Ajouter une Consultation</h1>

    <form method="post" action="traitement_ajout_consult.php">
        Date de Consultation: <input type="date" name="date_consultation" required><br><br>
        Heure: <input type="time" name="heure" required><br><br>
        Durée (en minutes): <input type="number" name="duree" value="30" required><br><br>
        Usager:
        <select name="usager" onchange="this.form.submit()">
            <?php include 'afficher_liste_usag.php'; ?>
        </select>
        
    
        Médecin référant:
            <select name="medecin">
                 <?php include 'afficher_liste_med.php'; ?>
            </select><br><br>
           
        <input type="submit" value="Ajouter Consultation">
    </form>
</body>
</html>
