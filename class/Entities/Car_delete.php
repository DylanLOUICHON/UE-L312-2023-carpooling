<?php
require_once '/CarsController.php';
// Utilisation de la classe 
$carController = new CarsController();
echo $carController->deleteCar();
?>
<p> Suppression d'une voiture </p>
<form method="post" action="Car_delete.php" name="CarDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une voiture">
</form>