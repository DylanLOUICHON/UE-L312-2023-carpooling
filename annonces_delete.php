<?php

    use App\Controllers\AnnoncesController;

    require __DIR__ . '/vendor/autoload.php';
     
    $annonceController = new AnnoncesController();
    echo $annonceController->deleteAnnonce();
?>

<p> Suppression d'une annonce </p>
<form method="post" action="Annonces_delete.php" name="annonceDeleteForm">
    
    <label for="id">Identifiant :</label>
    <input type="text" name="id">
    <br />

    <input type="submit" value="Supprimer une annonce">
</form>