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
// UserU.php



function login($email, $password) {
    $db = config::getConnexion();
    $sql = "SELECT * FROM user WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        // Hash the input password with SHA-256
        $hashed_password = hash('sha256', $password);

        // Check if the hashed password matches
        if ($user['password'] === $hashed_password) {
            // Get the user's ID
            $user_id = $user['id'];

            // Redirect based on user role, including user ID in the URL
            switch ($user['role']) {
                case 'admin':
                    header('Location: /projetcovoiturage/Viiew/back/darkpan-1.0.0/index.php');
                    break;
                case 'conducteur':
                    header('Location: /projetcovoiturage/Viiew/front/indexcondu.php?id=' . $user_id);
                    break;
                case 'passager':
                    header('Location: /projetcovoiturage/Viiew/front/indexpass.php?id=' . $user_id);
                    break;
                default:
                    echo 'Rôle inconnu.';
                    break;
            }
            exit();
        } else {
            echo 'Mot de passe incorrect.';
        }
    } else {
        echo 'Email non trouvé.';
    }
}



}
?>
