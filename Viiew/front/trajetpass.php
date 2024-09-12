<?php
include_once 'C:/xampp/htdocs/projetcovoiturage/config.php';
include_once 'C:/xampp/htdocs/projetcovoiturage/controller/TrajetU.php';

// Vérifiez si l'ID du pas est passé dans l'URL
if (isset($_GET['id'])) {
    $passager_id = $_GET['id'];

    // Créez une instance du contrôleur
    $trajetController = new TrajetU();

    // Obtenez les trajets pour le pass spécifié
    $trajets = $trajetController->afficherTousTrajets();
} else {
    echo "Aucun ID de pass spécifié.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CarServ - Car Repair HTML Template</title>
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
    <style>
        .btn-reservation {
            padding: 10px 20px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-reserve {
            background-color: green;
        }
        .btn-cancel {
            background-color: red;
        }
    </style>
</head>

<body>
 


   

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-car me-3"></i>CarServ</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="indexcondu.php?id=<?php echo htmlspecialchars($passager_id); ?>" class="nav-item nav-link ">Accueil</a>
            <a href="trajetpass.php?id=<?php echo htmlspecialchars($passager_id); ?>" class="nav-item nav-link active">Trajet</a>
                <a href="service.html" class="nav-item nav-link">Services</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="booking.html" class="dropdown-item">Booking</a>
                        <a href="team.html" class="dropdown-item">Technicians</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <a href="ajouter_trajet.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">AJOUTER UN TRAJET <i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
      <!-- Carousel -->
      <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Carousel items here... -->
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Trajets Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Tous les Trajets</h2>
        <div class="row">
       <?php foreach ($trajets as $trajet): ?>
        <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Trajet ID:<?php echo htmlspecialchars($trajet->getId()); ?></h2>
                        <p class="card-text"><strong>Départ:</strong> <?php echo htmlspecialchars($trajet->getPointDepart()); ?></p>
                          <p class="card-text"><strong>Arrivée:</strong><?php echo htmlspecialchars($trajet->getPointArrivee()); ?></p>
                          <p class="card-text"><strong>Date & Heure:</strong><?php echo htmlspecialchars($trajet->getDateHeureDepart()); ?></p>
                          <p class="card-text"><strong>Nombre de Places Disponibles:</strong> <?php echo htmlspecialchars($trajet->getNombrePlacesDisponibles()); ?></p>
                          <p class="card-text"><strong>Prix:</strong>  <?php echo htmlspecialchars($trajet->getPrix()); ?></p>
        
        <?php if ($trajet->getReserve()): ?>
            <button class="btn-reservation btn-cancel">Réservé</button>
        <?php else: ?>
            <button class="btn-reservation btn-reserve" onclick="window.location.href='reserver_trajet.php?id=<?php echo htmlspecialchars($trajet->getId()); ?>'">Réserver</button>
        <?php endif; ?>
        </div>
                    </div>
                </div>
<?php endforeach; ?>

        </div>
    </div>
</body>
    <!-- Carousel End -->




    


   



    








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