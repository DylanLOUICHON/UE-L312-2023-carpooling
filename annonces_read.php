<?php
// Cette classe permet de réaliser la lecture des annonces.
require_once '/AnnoncesController.php';

// Utilisation incorrecte du nom de classe (AnnoncesController au lieu de AnnonceController)
$annonceController = new AnnoncesController();

echo $annonceController->getAnnonces();
