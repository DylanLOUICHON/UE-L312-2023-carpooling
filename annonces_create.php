<?php

    use App\Controllers\AnnoncesController;

    require __DIR__ . '/vendor/autoload.php';

    
    $annonceController = new AnnoncesController();
    echo $annonceController->createAnnonce();
?>

<p> Création d'une annonce </p>
<form method="post" action="annonces_create.php" name="annonceCreateForm">
    
    <!-- Des inputs avec des labels pour remplir les caractéristiques de chaque annonce -->

    <label for="price"> price : </label> 
    <input type="number" name="price">
    <br/>
        
    <label for="startplace"> start place : </label> 
    <input type="text" name="startPlace">
    <br/>
        
    <label for="endPlace"> end place : </label> 
    <input type="text" name="endPlace">
    <br/>
        
    <label for="dateBegining">date Begining : </label> 
    <input type="datetime-local" name="dateBegining">
    <br/>
        
    <label for="smoking">smoking :</label>
    <input type="checkbox" id="smoking" name="smoking">
    <br/>
        
    <input type="submit" value="Créer une réservation">
    <br/>
</form>
