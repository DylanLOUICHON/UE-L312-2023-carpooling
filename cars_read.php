<?php

    use App\Controllers\CarsController;

    require __DIR__ . '/vendor/autoload.php';

    $carController = new CarsController();
    echo $carController->getCars();
