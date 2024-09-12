<?php
include 'C:/xampp/htdocs/projetcovoiturage/config.php';
include 'C:/xampp/htdocs/projetcovoiturage/model/User.php';

class UserU {

    function afficherUtilisateurs() {
        $sql = "SELECT * FROM user";
        $db = config::getConnexion();
        try {
            $stmt = $db->query($sql);
            $users = [];
            while ($row = $stmt->fetch()) {
                $users[] = new User($row['id'], $row['nom'], $row['prenom'], $row['password'], $row['email'], $row['num_tel'], $row['role']);
            }
            return $users;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
   
    
    
    function supprimerUtilisateurs($id){
        $sql="DELETE FROM user WHERE id=:id";
        $db = config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':id', $id);
        try{
            $req->execute();
        }
        catch(Exception $e){
            die('Erreur:'. $e->getMessage());
        }
    }
    

}
?>
