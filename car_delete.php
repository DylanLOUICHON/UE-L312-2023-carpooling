<?php

    use App\Controllers\CarsController;

    require __DIR__ . '/vendor/autoload.php';

    $carController = new CarsController();
    echo $carController->deleteCar();
?>
<p> Suppression d'une voiture </p>
<form method="post" action="car_delete.php" name="CarDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une voiture">
</form>