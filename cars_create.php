<?php

    use App\Controllers\CarsController;

    require __DIR__ . '/vendor/autoload.php';
    
    $carController = new CarsController();
    echo $carController->createCar();


?>

<p> Création d'une voiture </p>
<form method="post" action="cars_create.php" name="carCreateForm">

    <!-- Des inputs avec des labels pour remplir les caractéristiques de chaque voiture -->

    <label for="brand">brand:</label>
    <input type="text" name="brand">
    <br />

    <label for="model">model:</label>
    <input type="text" name="model">
    <br />

    <label for="year">year:</label>
    <input type="number" name="year">
    <br />

    <label for="color">color:</label>
    <input type="text" name="color">
    <br />

    <label for="motorization">motorization:</label>
    <input type="text" name="motorization">
    <br />

    <label for="placesNumber">places number:</label>
    <input type="number" name="placesNumber">
    <br />

    <label for="numberPlate">Number plate:</label>
    <input type="text" name="numberPlate">
    <br />

    <input type="submit" value="Submit">
</form>