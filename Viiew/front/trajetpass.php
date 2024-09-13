<?php
include_once 'C:/xampp/htdocs/projetcovoiturage/config.php';
include_once 'C:/xampp/htdocs/projetcovoiturage/controller/TrajetU.php';


// Vérifiez si l'ID du passager est passé dans l'URL
if (isset($_GET['id'])) {
    $passager_id = $_GET['id'];

    // Créez une instance du contrôleur
    $trajetController = new TrajetU();

    // Obtenez les trajets pour le passager spécifié
    $trajets = $trajetController->afficherTousTrajets();
} else {
    echo "Aucun ID de passager spécifié.";
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
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-car me-3"></i>Ensemble en route</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="indexpass.php?id=<?php echo htmlspecialchars($passager_id); ?>" class="nav-item nav-link">Accueil</a>
                <a href="trajetpass.php?id=<?php echo htmlspecialchars($passager_id); ?>" class="nav-item nav-link active">Trajet</a>
              
              
              <a href="#" class="nav-item nav-link">Reclamation</a>
   
          </div>
                <div class="nav-item dropdown">
                    <a href="#" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block nav-lin" >Plus<i class="fa fa-arrow-right ms-3"></i> </a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="#" class="dropdown-item">Profil</a>
                        <a href="reservationpass.php?id=<?php echo htmlspecialchars($passager_id); ?>" class="dropdown-item">Historique</a>
                        <a href="/projetcovoiturage/Viiew/deconnexion.php" class="dropdown-item">Deconexion</a>
                      
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Carousel Start -->
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
    <!-- Carousel End -->

    <!-- Trajets Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Tous les Trajets</h2>
        <div class="row">
        <?php foreach ($trajets as $trajet): ?>
            <?php $estReserveParPassager = $trajetController->estTrajetReserveParPassager($trajet->getId(), $passager_id); ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Trajet ID: <?php echo htmlspecialchars($trajet->getId()); ?></h5>
                        <p class="card-text"><strong>Départ:</strong> <?php echo htmlspecialchars($trajet->getPointDepart()); ?></p>
                        <p class="card-text"><strong>Arrivée:</strong> <?php echo htmlspecialchars($trajet->getPointArrivee()); ?></p>
                        <p class="card-text"><strong>Date & Heure:</strong> <?php echo htmlspecialchars($trajet->getDateHeureDepart()); ?></p>
                        <p class="card-text"><strong>Nombre de Places Disponibles:</strong> <?php echo htmlspecialchars($trajet->getNombrePlacesDisponibles()); ?></p>
                        <p class="card-text"><strong>Prix:</strong> <?php echo htmlspecialchars($trajet->getPrix()); ?></p>

                        <?php if ($estReserveParPassager): ?>
                            <button style="background-color: red;" disabled>Trajet déjà réservé</button>
                            <?php else: ?>
    <form action="reserver_trajet.php" method="GET">
        <input type="hidden" name="trajet_id" value="<?php echo $trajet->getId(); ?>">
        <input type="hidden" name="passager_id" value="<?php echo htmlspecialchars($passager_id); ?>">
        <button style="background-color: green;">Réserver</button>
    </form>
<?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>

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
