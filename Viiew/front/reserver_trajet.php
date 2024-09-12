<?php
include_once 'C:/xampp/htdocs/projetcovoiturage/controller/TrajetU.php';

// Vérifiez si l'ID du trajet est passé dans l'URL
if (isset($_GET['id'])) {
    $trajet_id = $_GET['id'];

    // Créez une instance du contrôleur
    $trajetController = new TrajetU();

    // Marquez le trajet comme réservé
    $trajetController->modifierTrajet($trajet_id, null, null, null, null, null, 1);

    // Redirigez vers la page des trajets
    header('Location: trajet.php');
    exit();
} else {
    echo "Aucun ID de trajet spécifié.";
}
?>