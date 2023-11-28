<?php

    use App\Controllers\AnnoncesController;

    require __DIR__ . '/vendor/autoload.php';

    $annonceController = new AnnoncesController();
    echo $annonceController->updateAnnonce();
?>

<p> Mettre à jour une annonce </p>
<form method="post" action="annonces_update.php" name="annoncesUpdateForm">

    <!-- Des inputs avec des labels pour remplir les caractéristiques de chaque annonce -->

    <label for="price"> price : </label>
    <input type="number" name="price">
    <br />

    <label for="startplace"> start place : </label>
    <input type="text" name="startPlace">
    <br />

    <label for="endPlace"> end place : </label>
    <input type="text" name="endPlace">
    <br />

    <label for="dateBegining">date Begining : </label>
    <input type="date" name="dateBegining">
    <br />

    <label for="smoking">smoking :</label>
    <input type="checkbox" id="smoking" name="smoking">
    <br />

    <input type="submit" value="Créer une réservation">
    <br />
</form>