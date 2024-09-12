<?php
include 'C:/xampp/htdocs/projetcovoiturage/config.php';
include 'C:/xampp/htdocs/projetcovoiturage/model/Trajet.php';

class TrajetU {
    public function afficherTrajets() {
        $sql = "SELECT t.id, t.conducteur_id, t.point_depart, t.point_arrivee, t.date_heure_depart, t.nombre_places_disponibles, t.prix, 
                       u.nom AS conducteur_nom, u.prenom AS conducteur_prenom
                FROM trajet t
                INNER JOIN user u ON t.conducteur_id = u.id";
        $db = config::getConnexion();
        try {
            $stmt = $db->query($sql);
            $trajets = [];
            while ($row = $stmt->fetch()) {
                $trajets[] = new Trajet(
                    $row['id'],
                    $row['conducteur_id'],
                    $row['point_depart'],
                    $row['point_arrivee'],
                    $row['date_heure_depart'],
                    $row['nombre_places_disponibles'],
                    $row['prix'],
                    $row['conducteur_nom'],
                    $row['conducteur_prenom']
                );
            }
            return $trajets;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>
