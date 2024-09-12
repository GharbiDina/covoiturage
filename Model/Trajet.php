<?php
class Trajet {
    private $id;
    private $conducteur_id;
    private $point_depart;
    private $point_arrivee;
    private $date_heure_depart;
    private $nombre_places_disponibles;
    private $prix;
    private $conducteur_nom;
    private $conducteur_prenom;

    public function __construct($id, $conducteur_id, $point_depart, $point_arrivee, $date_heure_depart, $nombre_places_disponibles, $prix, $conducteur_nom, $conducteur_prenom) {
        $this->id = $id;
        $this->conducteur_id = $conducteur_id;
        $this->point_depart = $point_depart;
        $this->point_arrivee = $point_arrivee;
        $this->date_heure_depart = $date_heure_depart;
        $this->nombre_places_disponibles = $nombre_places_disponibles;
        $this->prix = $prix;
        $this->conducteur_nom = $conducteur_nom;
        $this->conducteur_prenom = $conducteur_prenom;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getConducteurId() { return $this->conducteur_id; }
    public function getPointDepart() { return $this->point_depart; }
    public function getPointArrivee() { return $this->point_arrivee; }
    public function getDateHeureDepart() { return $this->date_heure_depart; }
    public function getNombrePlacesDisponibles() { return $this->nombre_places_disponibles; }
    public function getPrix() { return $this->prix; }
    public function getConducteurNom() { return $this->conducteur_nom; }
    public function getConducteurPrenom() { return $this->conducteur_prenom; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setConducteurId($conducteur_id) { $this->conducteur_id = $conducteur_id; }
    public function setPointDepart($point_depart) { $this->point_depart = $point_depart; }
    public function setPointArrivee($point_arrivee) { $this->point_arrivee = $point_arrivee; }
    public function setDateHeureDepart($date_heure_depart) { $this->date_heure_depart = $date_heure_depart; }
    public function setNombrePlacesDisponibles($nombre_places_disponibles) { $this->nombre_places_disponibles = $nombre_places_disponibles; }
    public function setPrix($prix) { $this->prix = $prix; }
    public function setConducteurNom($conducteur_nom) { $this->conducteur_nom = $conducteur_nom; }
    public function setConducteurPrenom($conducteur_prenom) { $this->conducteur_prenom = $conducteur_prenom; }
}
?>
