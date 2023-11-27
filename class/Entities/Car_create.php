<?php
// Cette classe sert à créer des voitures.
require_once '/CarsController.php';


//L'utilisation de cette classe 
$carController = new CarsController();
echo $carController->createCar();

echo '<p>Création d\'une voiture</p>';
?>

<form method="post" action="Car_create.php" name="Car_create_form">

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