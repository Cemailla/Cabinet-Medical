<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <title>Modifier une Consultation</title>
    <?php
    include('BDD.php');
    ?>
</head>

<body>
<nav>
    <ul>
        <li class="first">
        <a href="../php/index.php">
            <img src="../images/maison.png" alt="Accueil" class="img" style="height: 50px;">
        </a>
        </li>
        <li><a href="listemedecin.php"><h3>Médecins</h3></a></li>
        <li><a href="listeusager.php"><h3>Usagers</h3></a></li>
        <li><a href="listeconsultation.php"><h3>Consultations</h3></a></li>
        <li><a href="statistique.php"><h3>Statistiques</h3></a></li>
        <li class="logout">    
            <a href="logout.php">
                <img src="../images/logout.png" alt="Usagers" class="img" style="height: 50px;">
            </a>
        </li>
    </ul>
</nav>


</body>

</html>
