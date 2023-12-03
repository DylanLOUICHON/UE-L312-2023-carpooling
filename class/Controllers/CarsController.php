<?php

namespace App\Controllers;

use App\Services\CarsService;
use App\Services\UsersService;
use App\Services\AnnoncesService;


class CarsController
{
    /**
     * Return the html for the create action.
     */
    public function createCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['brand']) &&
            isset($_POST['model']) &&
            isset($_POST['year']) &&
            isset($_POST['color']) &&
            isset($_POST['motorization']) &&
            isset($_POST['placesNumber']) &&
            isset($_POST['numberPlate'])) {
            // Create the car :
            $carsService = new CarsService();
            $isOk = $carsService->setCar(
                null,
                $_POST['brand'],
                $_POST['model'],
                $_POST['year'],
                $_POST['color'],
                $_POST['motorization'],
                $_POST['placesNumber'],
                $_POST['numberPlate']
            );
            if ($isOk) {
                $html = 'Voiture créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de la voiture.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getCars(): string
    {
        $html = '';

        // Get all cars :
        $carsService = new CarsService();
        $cars = $carsService->getCars();

        // Get html :
        foreach ($cars as $car) {
            
            $html .=
                '<h3>Voiture #' . $car->getId() . '</h3>' .
                'Marque : ' . $car->getBrand() . '<br/>' .
                'Modèle : ' . $car->getModel() . '<br/>' .
                'Année : ' . $car->getYear() . '<br/>' .
                'Couleur : ' . $car->getColor() . '<br/>' .
                'Motorisation : ' . $car->getMotorization() . '<br/>' .
                'Nombre de places : ' . $car->getPlacesNumber() . '<br/>' .
                'Immatriculation : ' . $car->getNumberplate() . '<br/>';
        }

        return $html;
    }

    /**
     * Update the car.
     */
    public function updateCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['brand']) &&
            isset($_POST['model']) &&
            isset($_POST['year']) &&
            isset($_POST['color']) &&
            isset($_POST['motorization']) &&
            isset($_POST['placesNumber']) &&
            isset($_POST['numberPlate'])) {
            // Update the car :
            $carsService = new CarsService();
            $isOk = $carsService->setCar(
                $_POST['id'],
                $_POST['brand'],
                $_POST['model'],
                $_POST['year'],
                $_POST['color'],
                $_POST['motorization'],
                $_POST['placesNumber'],
                $_POST['numberPlate']
            );
            if ($isOk) {
                $html = 'Voiture mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la voiture.';
            }
        }

        return $html;
    }

    /**
     * Delete a car.
     */
    public function deleteCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the car :
            $carsService = new CarsService();
            $isOk = $carsService->deleteCar($_POST['id']);

            // Delete the car-user relation :
            $isOk = true;
            if (!empty($_POST['id'])) {
                $annonceIdentifiant = $_POST['id'];
                $usersService = new UsersService();
                $isOk = $usersService->deleteUserCar(null, $annonceIdentifiant);

                // Delete the car-annonces relation :
                $carId = $_POST['id'];
                $annoncesService = new AnnoncesService();
                $isOk = $annoncesService->deleteAnnonceCar(null, $carId);

            }

            if ($isOk) {
                $html = 'Voiture supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la voiture.';
            }
        }

        return $html;
    }
}