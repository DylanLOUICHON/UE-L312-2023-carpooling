<?php
// Cette classe sert à supprimer des annonces.
require_once '/AnnoncesController.php';

//Utilisation de la classe 
$annonceController = new AnnoncesController();
echo $annonceController->deleteAnnonce();
?>
<p> Suppression d'une annonce </p>
<form method="post" action="Annonces_delete.php" name="AnnonceDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une annonce">
</form>