<?php

    use App\Controllers\AnnoncesController;
    use App\Services\CarsService;

    require __DIR__ . '/vendor/autoload.php';

    
    $annonceController = new AnnoncesController();
    echo $annonceController->createAnnonce();

    $carsService = new CarsService();
    $cars = $carsService->getCars();
?>

<p> Création d'une annonce </p>
<form method="post" action="annonces_create.php" name="annonceCreateForm">
    
    <!-- Des inputs avec des labels pour remplir les caractéristiques de chaque annonce -->

    <label for="price"> Id utilisateur : </label> 
    <input type="number" name="idUser">
    <br/>

    <label for="price"> Prix du trajet : </label> 
    <input type="number" name="price">
    <br/>
        
    <label for="startplace"> Lieu de départ : </label> 
    <input type="text" name="startPlace">
    <br/>
        
    <label for="endPlace"> Lieu d'arrivé : </label> 
    <input type="text" name="endPlace">
    <br/>
        
    <label for="dateBegining"> Date du départ : </label> 
    <input type="datetime-local" name="dateBegining">
    <br/>
        
    <label for="smoking"> Fumeur : </label>
    <input type="checkbox" id="smoking" name="smoking"><br/>
    <br/>

    <label for="cars"> Voiture utilisée : </label><br/>
    <?php foreach ($cars as $car): ?>
        <?php $carName = $car->getBrand() . ' ' . $car->getModel() . ' ' . $car->getColor(); ?>
        <input type="radio" name="cars[]" value="<?php echo $car->getId(); ?>"><?php echo $carName; ?>
        <br />
    <?php endforeach; ?>
    <br />
        
    <input type="submit" value="Créer une annonce">
    <br/>
</form>
