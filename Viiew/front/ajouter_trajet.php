<?php
include_once 'C:/xampp/htdocs/projetcovoiturage/config.php';
include_once 'C:/xampp/htdocs/projetcovoiturage/model/Trajet.php';
include_once 'C:/xampp/htdocs/projetcovoiturage/controller/TrajetU.php';

$conducteur_id = null;
if (isset($_GET['id'])) {
    $conducteur_id = $_GET['id'];
} else {
    echo "Aucun ID de conducteur spécifié.";
    exit();
}

// Traitez le formulaire si une soumission a eu lieu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $point_depart = $_POST['point_depart'];
    $point_arrivee = $_POST['point_arrivee'];
    $date_heure_depart = $_POST['date_heure_depart'];
    $nombre_places_disponibles = $_POST['nombre_places_disponibles'];
    $prix = $_POST['prix'];

    $trajetU = new TrajetU();
    $trajetU->ajouterTrajet($conducteur_id, $point_depart, $point_arrivee, $date_heure_depart, $nombre_places_disponibles, $prix);

    // Rediriger ou afficher un message de succès
    header('Location: trajet.php?id=' . urlencode($conducteur_id));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Ajouter un Trajet - CarServ</title>
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
        <a href="indexcondu.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-car me-3"></i>CarServ</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="indexcondu.php?id=<?php echo htmlspecialchars($conducteur_id); ?>" class="nav-item nav-link active">Accueil</a>
            <a href="trajet.php?id=<?php echo htmlspecialchars($conducteur_id); ?>" class="nav-item nav-link">Trajet</a>
                <a href="service.html" class="nav-item nav-link">Services</a>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Add Trajet Form Start -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Ajouter un Trajet</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
            <form action="ajouter_trajet.php?id=<?php echo htmlspecialchars($conducteur_id); ?>" method="POST">
    <input type="hidden" name="conducteur_id" value="<?php echo htmlspecialchars($conducteur_id); ?>">
    <div class="mb-3">
        <label for="point_depart" class="form-label">Point de Départ</label>
        <input type="text" class="form-control" id="point_depart" name="point_depart" required>
    </div>
    <div class="mb-3">
        <label for="point_arrivee" class="form-label">Point d'Arrivée</label>
        <input type="text" class="form-control" id="point_arrivee" name="point_arrivee" required>
    </div>
    <div class="mb-3">
        <label for="date_heure_depart" class="form-label">Date et Heure de Départ</label>
        <input type="datetime-local" class="form-control" id="date_heure_depart" name="date_heure_depart" required>
    </div>
    <div class="mb-3">
        <label for="nombre_places_disponibles" class="form-label">Nombre de Places Disponibles</label>
        <input type="number" class="form-control" id="nombre_places_disponibles" name="nombre_places_disponibles" required>
    </div>
    <div class="mb-3">
        <label for="prix" class="form-label">Prix</label>
        <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter le Trajet</button>
</form>

            </div>
        </div>
    </div>
    <!-- Add Trajet Form End -->

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
