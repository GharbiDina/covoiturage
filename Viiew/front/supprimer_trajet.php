<?php

include 'C:/xampp/htdocs/projetcovoiturage/controller/TrajetU.php';

// Vérifier si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Créer une instance de TrajetU
    $trajetController = new TrajetU();

    // Supprimer le trajet
    try {
        $trajetController->supprimerTrajet($id);
        // Rediriger vers la page d'affichage après la suppression avec un message de succès
        header("Location: indexcondu.php?message=Trajet supprimé avec succès");
    } catch (Exception $e) {
        // En cas d'erreur, rediriger avec un message d'erreur
        header("Location: indexcondu.php?message=" . urlencode($e->getMessage()));
    }
    exit();
} else {
    echo "Aucun ID spécifié.";
}
?>
