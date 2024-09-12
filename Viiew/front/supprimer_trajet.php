<?php

include_once 'C:/xampp/htdocs/projetcovoiturage/config.php';
include_once 'C:/xampp/htdocs/projetcovoiturage/Controller/TrajetU.php';

// Vérifiez si l'ID du trajet et l'ID du conducteur sont passés dans l'URL
if (isset($_GET['id']) && isset($_GET['conducteur_id'])) {
    $id = $_GET['id'];
    $conducteur_id = $_GET['conducteur_id'];

    // Créez une instance du contrôleur
    $trajetController = new TrajetU();

    // Supprimer le trajet
    $trajetController->supprimerTrajet($id);

    // Redirigez vers la page d'affichage avec l'ID du conducteur dans l'URL
    header("Location: trajet.php?id=" . urlencode($conducteur_id) . "&message=" . urlencode("Trajet supprimé avec succès"));
    exit();
} else {
    echo "Aucun ID de trajet ou de conducteur spécifié.";
}
?>
