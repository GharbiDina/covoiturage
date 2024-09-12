<?php


include 'C:/xampp/htdocs/projetcovoiturage/controller/UserU.php';

// Vérifier si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Créer une instance de UserU
    $userController = new UserU();

    // Supprimer l'utilisateur
    $userController->supprimerUtilisateurs($id);

    // Rediriger vers la page d'affichage après la suppression
    header("Location: index.php");
    exit();
} else {
    echo "Aucun ID spécifié.";
}
?>
