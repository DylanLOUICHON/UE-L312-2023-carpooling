<?php

use App\Controllers\AnnoncesController;

require __DIR__ . '/vendor/autoload.php';

$annonceController = new AnnoncesController();

echo $annonceController->getAnnonces();
