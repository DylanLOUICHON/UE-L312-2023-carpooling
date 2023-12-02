<?php

    use App\Controllers\CarsController;

    require __DIR__ . '/vendor/autoload.php';
    
    $carController = new CarsController();
    echo $carController->createCar();


?>

<p> Création d'une voiture </p>
<form method="post" action="cars_create.php" name="carCreateForm">

    <!-- Des inputs avec des labels pour remplir les caractéristiques de chaque voiture -->

    <label for="brand"> Marque : </label>
    <input type="text" name="brand">
    <br />

    <label for="model"> Modèle : </label>
    <input type="text" name="model">
    <br />

    <label for="year"> Année : </label>
    <input type="number" name="year">
    <br />

    <label for="color"> Couleur : </label>
    <input type="text" name="color">
    <br />

    <label for="motorization"> Motorisation : </label>
    <input type="text" name="motorization">
    <br />

    <label for="placesNumber"> Nombre de places : <label>
    <input type="number" name="placesNumber">
    <br />

    <label for="numberPlate"> Immatriculation : </label>
    <input type="text" name="numberPlate">
    <br />

    <input type="submit" value="Créer une voiture">
</form>