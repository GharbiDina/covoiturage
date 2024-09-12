<?php
include_once 'C:/xampp/htdocs/projetcovoiturage/config.php';
include_once 'C:/xampp/htdocs/projetcovoiturage/controller/TrajetU.php';

// Vérifiez si les paramètres nécessaires sont passés dans l'URL
if (isset($_GET['trajet_id']) && isset($_GET['passager_id'])) {
    $trajet_id = $_GET['trajet_id'];
    $passager_id = $_GET['passager_id'];

    // Créez une instance du contrôleur
    $trajetController = new TrajetU();

    // Ajouter la réservation
    $db = config::getConnexion();
    $sql = "INSERT INTO reservation (trajet_id, passager_id, date_reservation) VALUES (:trajet_id, :passager_id, NOW())";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':trajet_id', $trajet_id);
        $stmt->bindParam(':passager_id', $passager_id);
        $stmt->execute();

        // Redirection vers la page des trajets après la réservation
        header("Location: trajetpass.php?id=" . urlencode($passager_id));
        exit();
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
} else {
    echo "Les informations de réservation sont manquantes.";
    exit();
}
?>
