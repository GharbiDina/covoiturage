<?php
class Reservation {
    private $id;
    private $trajet_id;
    private $passager_id;
    private $date_reservation;

    public function __construct($id, $trajet_id, $passager_id, $date_reservation) {
        $this->id = $id;
        $this->trajet_id = $trajet_id;
        $this->passager_id = $passager_id;
        $this->date_reservation = $date_reservation;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getTrajetId() { return $this->trajet_id; }
    public function getPassagerId() { return $this->passager_id; }
    public function getDateReservation() { return $this->date_reservation; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setTrajetId($trajet_id) { $this->trajet_id = $trajet_id; }
    public function setPassagerId($passager_id) { $this->passager_id = $passager_id; }
    public function setDateReservation($date_reservation) { $this->date_reservation = $date_reservation; }
}
?>
