<?php
include_once 'C:/xampp/htdocs/projetcovoiturage/config.php';
include_once 'C:/xampp/htdocs/projetcovoiturage/Model/Reservation.php';

class ReservationU {

    // Ajouter une réservation

    // Obtenir les réservations par passager
    public function getReservationsByPassager($passager_id) {
        $db = config::getConnexion();
        $sql = "SELECT * FROM reservation WHERE passager_id = :passager_id";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':passager_id', $passager_id);
            $stmt->execute();
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array_map(function($data) {
                return new Reservation($data['id'], $data['trajet_id'], $data['passager_id'], $data['date_reservation']);
            }, $reservations);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Supprimer une réservation
    public function supprimerReservation($id) {
        $db = config::getConnexion();
        $sql = "DELETE FROM reservation WHERE id = :id";

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
