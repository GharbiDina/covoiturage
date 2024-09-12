<?php
require_once 'C:/xampp/htdocs/PW/config.php';

try {
    // Essayer d'établir la connexion
    $db = config::getConnexion();
    echo "Connexion réussie à la base de données!";
} catch (Exception $e) {
    // Afficher un message d'erreur si la connexion échoue
    echo "Erreur de connexion: " . $e->getMessage();
}
?>
