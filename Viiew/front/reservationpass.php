<?php
include_once 'C:/xampp/htdocs/projetcovoiturage/config.php';
include_once 'C:/xampp/htdocs/projetcovoiturage/controller/ReservationU.php';
include_once 'C:/xampp/htdocs/projetcovoiturage/controller/TrajetU.php';

// Vérifiez si l'ID du passager est passé dans l'URL
if (isset($_GET['id'])) {
    $passager_id = $_GET['id'];

    // Créez une instance du contrôleur de réservation
    $reservationController = new ReservationU();
    $trajetController = new TrajetU();

    // Obtenez les réservations pour le passager spécifié
    $reservations = $reservationController->getReservationsByPassager($passager_id);

    // Obtenez les trajets pour les réservations
    $trajets = [];
    foreach ($reservations as $reservation) {
        $trajets[] = $trajetController->getTrajetById($reservation->getTrajetId());
    }
} else {
    echo "Aucun ID de passager spécifié.";
    exit();
}
// Traitement de l'annulation
if (isset($_GET['cancel_id'])) {
    $reservation_id = $_GET['cancel_id'];
    $reservationController->supprimerReservation($reservation_id);
    header("Location: reservationpass.php?id=" . urlencode($passager_id)); // Redirection pour éviter la soumission multiple
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mes Réservations</title>
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
                <a href="indexpass.php?id=<?php echo htmlspecialchars($passager_id); ?>" class="nav-item nav-link">Accueil</a>
                <a href="trajetpass.php?id=<?php echo htmlspecialchars($passager_id); ?>" class="nav-item nav-link">Trajet</a>
              
                <a href="#" class="nav-item nav-link">Reclamation</a>
            </div>
            <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Plus</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="#" class="dropdown-item">Profil</a>
                        <a href="reservationpass.php?id=<?php echo htmlspecialchars($passager_id); ?>" class="dropdown-item">Historique</a>
                        <a href="#" class="dropdown-item">Deconexion</a>
                      
                    </div>
                </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Réservations Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Mes Réservations</h2>
        <div class="row">
            <?php if (!empty($reservations)): ?>
                <?php foreach ($trajets as $trajet): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Trajet ID: <?php echo htmlspecialchars($trajet->getId()); ?></h5>
                                <p class="card-text"><strong>Départ:</strong> <?php echo htmlspecialchars($trajet->getPointDepart()); ?></p>
                                <p class="card-text"><strong>Arrivée:</strong> <?php echo htmlspecialchars($trajet->getPointArrivee()); ?></p>
                                <p class="card-text"><strong>Date & Heure:</strong> <?php echo htmlspecialchars($trajet->getDateHeureDepart()); ?></p>
                                <p class="card-text"><strong>Nombre de Places Disponibles:</strong> <?php echo htmlspecialchars($trajet->getNombrePlacesDisponibles()); ?></p>
                                <p class="card-text"><strong>Prix:</strong> <?php echo htmlspecialchars($trajet->getPrix()); ?></p>
                                <a href="reservationpass.php?id=<?php echo urlencode($passager_id); ?>&cancel_id=<?php echo urlencode($reservation->getId()); ?>" class="btn-reservation btn-cancel">Annuler</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Vous n'avez pas encore effectué de réservation.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
