<?php
// Cette classe sert à créer des annonces.
require_once '/AnnoncesController.php';

// Utilisation incorrecte du nom de classe (AnnoncesController au lieu de AnnonceController)
$annonceController = new AnnoncesController();
echo $annonceController->createAnnonce();
?>
<p> Création d'une annonce </p>
<form method="post" action="Annonces_create.php" name="Annonces_create_form">
    
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
    <input type="date" name="dateBegining">
    <br/>
        
    <label for="smoking">smoking :</label>
    <input type="checkbox" id="smoking" name="smoking">
    <br/>
        
    <input type="submit" value="Créer une réservation">
    <br/>
</form>
