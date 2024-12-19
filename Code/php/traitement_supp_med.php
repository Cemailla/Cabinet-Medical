<?php
include 'BDD.php';
include('connecter.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    $medecin_id = $_POST['medecin_id'];

    try {
        $sql = "DELETE FROM medecin WHERE ID_Medecin = :medecin_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':medecin_id', $medecin_id, PDO::PARAM_INT);
        $stmt->execute();
        echo "Médecin supprimé avec succès.";
        
        echo "<br><br>";
        echo '<a href="listemedecin.php">Retourner à la liste des médecin</a>';
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
