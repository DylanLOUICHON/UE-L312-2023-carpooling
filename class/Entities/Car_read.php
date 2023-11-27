<?php

//Cette classe sert à réaliser la lecture des voitrues. 
require_once '/CarsController.php';

// Utilisation de la classe CarsController
$carController = new CarsController();
echo $carController->getCars();
