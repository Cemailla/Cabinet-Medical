<?php
include 'BDD.php';
include('connecter.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idConsultation = $_GET['id'];

    try {
        $sql = "SELECT * FROM consultation WHERE ID_Consultation = :idConsultation";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idConsultation', $idConsultation, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $consultation = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "Consultation non trouvée.";
            exit();
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
} else {
    // Redirection si l'ID de la consultation n'est pas spécifié
    header("Location: listeconsultation.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/supp_usager.css">
    <title>Supprimer une Consultation</title>
</head>

<body>
    <?php include('menu.php'); ?>

    <h1>Supprimer une Consultation</h1>

    <p>Voulez-vous vraiment supprimer la consultation du <?php echo htmlspecialchars($consultation['Date_Consultation']); ?> à <?php echo htmlspecialchars($consultation['Heure']); ?> </p>

    <form method="post" action="traitement_supp_consul.php">
        <input type="hidden" name="consultation_id" value="<?php echo $consultation['ID_Consultation']; ?>">
        <button class="supp" type="submit" name="confirm" value="1">Oui, supprimer</button>
        <a class="annuler" href="listeconsultation.php">Annuler</a>
    </form>

</body>
</html>
