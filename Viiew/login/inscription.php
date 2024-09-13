<?php
include_once 'C:/xampp/htdocs/projetcovoiturage/config.php';

// Vérifiez si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $num_tel = $_POST['num_tel'];
    
    // Hacher le mot de passe avec SHA-256
    $hashedPassword = hash('sha256', $password);
    
    // Connexion à la base de données
    $db = config::getConnexion();
    
    // Préparer la requête d'insertion
    $sql = "INSERT INTO user (nom, prenom, email, password, num_tel, role) 
            VALUES (:nom, :prenom, :email, :password, :num_tel, 'passager')";
    
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':num_tel', $num_tel);
        $stmt->execute();
        
        header('Location: index.php');
        exit();
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ensemble en route</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Login Start -->
    <div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 py-5">
                    <div class="py-5">
                        <h1 class="text-white mb-4">Ensemble en route</h1>
                        <p class="text-white mb-0">Bienvenue sur notre plateforme de covoiturage. Connectez-vous pour accéder à vos trajets, gérer vos réservations et plus encore. Si vous n'avez pas encore de compte, vous pouvez vous inscrire dès maintenant. Pour toute assistance, n'hésitez pas à nous contacter.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s">
                        <h1 class="text-white mb-4">inscription</h1>
                        <form action="inscription.php" method="POST">
                            <div class="row g-3">
                                <div class="col-12">
                                    <input type="text" name="nom" class="form-control border-0" placeholder="Votre Nom" style="height: 55px;" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="prenom" class="form-control border-0" placeholder="Votre Prénom" style="height: 55px;" required>
                                </div>
                                <div class="col-12">
                                    <input type="email" name="email" class="form-control border-0" placeholder="Votre Email" style="height: 55px;" required>
                                </div>
                                <div class="col-12">
                                    <input type="password" name="password" class="form-control border-0" placeholder="Mot de Passe" style="height: 55px;" required>
                                </div>
                                <div class="col-12">
                                    <input type="tel" name="num_tel" class="form-control border-0" placeholder="Numéro de Téléphone" style="height: 55px;" required>
                                </div>
                                <input type="hidden" name="role" value="passager"> <!-- Valeur par défaut -->
                                <div class="col-12">
                                    <button class="btn btn-secondary w-100 py-3" type="submit">Inscription</button>
                                </div>
                                <div class="col-12 text-center mt-3">
                                    <a href="forgot_password.php" class="text-white">Mot de Passe Oublié ?</a><br>
                                    <a href="login.php" class="text-white">Déjà un compte ? Connectez-vous</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

