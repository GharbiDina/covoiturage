<?php
	class User {
        private $id= null;
        private $Nom = null;
        private $email = null;
        private $role = null;
        private $prenom=null;
        private $num_tel=null;
        private $password=null;
    
        function __construct($id, $Nom,$prenom,$password, $email,$num_tel, $role) {
            $this->id = $id;
            $this->Nom = $Nom;
            $this->prenom = $prenom;
            $this->email = $email;
            $this->num_tel = $num_tel;
            $this->role = $role;
            $this->password= $password;
            
        }
    
        // Getter for Id
        public function getId() {
            return $this->id;
        }
    
        // Setter for Id
        public function setId($id) {
            $this->id = $id;
        }
        public function getPassword() {
            return $this->password;
        }
    
        // Setter for Id
        public function setPassword($password) {
            $this->password = $password;
        }
        

    
        // Getter for Nom
        public function getNom() {
            return $this->Nom;
        }
    
        // Setter for preNom
        public function setPrenom(string $prenom) {
            $this->prenom = $prenom;
        }
        public function getPrenom() {
            return $this->prenom;
        }
    
        // Setter for Nom
        public function setNom(string $Nom) {
            $this->Nom = $Nom;
        }
    
        // Getter for email
        public function getEmail() {
            return $this->email;
        }
    
        // Setter for email
        public function setEmail(string $email) {
            $this->email = $email;
        }
    
        // Getter for role
        public function getRole() {
            return $this->role;
        }
    
        // Setter for role
        public function setRole(string $role) {
            $this->role = $role;
        }
        public function getNumTel(){
            return $this->num_tel;
        }
        public function setNumTel($num_tel)
        {
            $this->num_tel=$num_tel;
        }
    }
    


