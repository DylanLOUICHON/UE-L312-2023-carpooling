<?php

    use App\Controllers\AnnoncesController;

    require __DIR__ . '/vendor/autoload.php';

    $annonceController = new AnnoncesController();
    echo $annonceController->updateAnnonce();
?>

<p> Mettre à jour une annonce </p>
<form method="post" action="annonces_update.php" name="annoncesUpdateForm">

    <!-- Des inputs avec des labels pour remplir les caractéristiques de chaque annonce -->

    <label for="price"> Identifiant : </label>
    <input type="number" name="price">
    <br />

    <label for="price"> Prix du trajet : </label>
    <input type="number" name="price">
    <br />

    <label for="startplace"> Lieu de départ : </label>
    <input type="text" name="startPlace">
    <br />

    <label for="endPlace"> Lieu d'arrivé : </label>
    <input type="text" name="endPlace">
    <br />

    <label for="dateBegining"> Date du départ : </label>
    <input type="date" name="dateBegining">
    <br />

    <label for="smoking"> Fumeur : </label>
    <input type="checkbox" id="smoking" name="smoking">
    <br />

    <input type="submit" value="Mettre à jour l'annonce">
    <br />
</form>