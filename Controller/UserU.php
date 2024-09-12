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
   
    
   function recupererUtilisateurs($id) {
    $sql = "SELECT * FROM user WHERE id = :id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $utilisateur = $query->fetch(PDO::FETCH_ASSOC); // Ensure you fetch associative array or map to User object
        return $utilisateur;
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

function modifierUtilisateurs($user) {
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE user SET 
                nom = :nom, 
                prenom = :prenom, 
                num_tel = :num_tel, 
                email = :email, 
                role = :role
            WHERE id = :id'
        );
        $query->execute([
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'num_tel' => $user->getNumTel(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
            'id' => $user->getId()
        ]);
        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

}
?>
