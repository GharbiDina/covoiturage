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
    public function ajouterTrajet($conducteur_id, $point_depart, $point_arrivee, $date_heure_depart, $nombre_places_disponibles, $prix) {
        $sql = "INSERT INTO trajet (conducteur_id, point_depart, point_arrivee, date_heure_depart, nombre_places_disponibles, prix)
                VALUES (:conducteur_id, :point_depart, :point_arrivee, :date_heure_depart, :nombre_places_disponibles, :prix)";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':conducteur_id', $conducteur_id);
            $stmt->bindParam(':point_depart', $point_depart);
            $stmt->bindParam(':point_arrivee', $point_arrivee);
            $stmt->bindParam(':date_heure_depart', $date_heure_depart);
            $stmt->bindParam(':nombre_places_disponibles', $nombre_places_disponibles);
            $stmt->bindParam(':prix', $prix);
            $stmt->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function modifierTrajet($id, $point_depart, $point_arrivee, $date_heure_depart, $nombre_places_disponibles, $prix) {
        $sql = "UPDATE trajet SET point_depart = :point_depart, point_arrivee = :point_arrivee, date_heure_depart = :date_heure_depart, nombre_places_disponibles = :nombre_places_disponibles, prix = :prix WHERE id = :id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':point_depart', $point_depart);
            $stmt->bindParam(':point_arrivee', $point_arrivee);
            $stmt->bindParam(':date_heure_depart', $date_heure_depart);
            $stmt->bindParam(':nombre_places_disponibles', $nombre_places_disponibles);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
    // Méthode pour obtenir un trajet par ID
    public function getTrajetById($id) {
        $sql = "SELECT * FROM trajet WHERE id = :id";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row) {
                return new Trajet(
                    $row['id'],
                    $row['conducteur_id'],
                    $row['point_depart'],
                    $row['point_arrivee'],
                    $row['date_heure_depart'],
                    $row['nombre_places_disponibles'],
                    $row['prix']
                );
            } else {
                return null;
            }
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
}
?>
