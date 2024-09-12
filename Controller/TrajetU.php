<?php
include_once 'C:/xampp/htdocs/projetcovoiturage/config.php';
include_once 'C:/xampp/htdocs/projetcovoiturage/model/Trajet.php';

class TrajetU {
    public function afficherTrajets($conducteur_id) {
        $sql = "SELECT id, conducteur_id, point_depart, point_arrivee, date_heure_depart, nombre_places_disponibles, prix
                FROM trajet
                WHERE conducteur_id = :conducteur_id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':conducteur_id', $conducteur_id);
            $stmt->execute();
            $trajets = [];
            while ($row = $stmt->fetch()) {
                $trajets[] = new Trajet(
                    $row['id'],
                    $row['conducteur_id'],
                    $row['point_depart'],
                    $row['point_arrivee'],
                    $row['date_heure_depart'],
                    $row['nombre_places_disponibles'],
                    $row['prix']
                );
            }
            return $trajets;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function supprimerTrajet($id) {
        $sql = "DELETE FROM trajet WHERE id = :id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>
