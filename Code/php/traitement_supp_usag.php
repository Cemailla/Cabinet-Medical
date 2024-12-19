<?php
include 'BDD.php';
include('connecter.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    $usager_id = $_POST['usager_id'];

    try {
        $sql = "DELETE FROM usager WHERE ID_USAGER = :usager_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usager_id', $usager_id, PDO::PARAM_INT);
        $stmt->execute();
        echo "Usager supprimé avec succès.";
        // Ajoutez le bouton de retour vers listeusager.php
        echo "<br><br>";
        echo '<a href="listeusager.php">Retourner à la liste des usagers</a>';
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
