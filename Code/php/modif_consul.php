<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/ajouterconsultation.css">
    <title>Modifier une Consultation</title>
    

</head>

<body>
    <?php
    include('menu.php');
    ?>
    <h1>Modifier une Consultation</h1>

<?php
include 'BDD.php';

include('connecter.php');
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idConsultation = $_GET['id'];

    try {
        $sql = "SELECT * FROM consultation WHERE ID_Consultation = :idConsultation";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idConsultation', $idConsultation, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
?>
            <form method="post" action="traitement_modif_consul.php">
                <input type="hidden" name="idConsultation" value="<?php echo $idConsultation; ?>">
                Date de Consultation: <input type="date" name="date_consultation" value="<?php echo $row['Date_Consultation']; ?>" required><br><br>
                Heure: <input type="time" name="heure" value="<?php echo $row['Heure']; ?>" required><br><br>
                Durée (en minutes): <input type="number" name="duree" value="<?php echo $row['Duree']; ?>" required><br><br>
                Usager:
                <select name="usager">
                    <?php include 'afficher_liste_usag.php'; ?>
                </select><br><br>
                Médecin:
                <select name="medecin">
                    <?php include 'afficher_liste_med.php'; ?>
                </select><br><br>
                <input type="submit" value="Modifier Consultation">
            </form>
<?php
        } else {
            echo "Consultation non trouvée.";
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
} else {
    echo "ID de consultation non spécifié.";
}
?>

</body>
</html>
