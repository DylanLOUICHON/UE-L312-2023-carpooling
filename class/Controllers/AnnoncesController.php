<?php

namespace App\Controllers;

use App\Services\AnnoncesService;
use App\Services\UsersService;
use DateTime;

class AnnoncesController
{
    /**
     * Return the html for the create action.
     */
    public function createAnnonce(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['idUser']) &&
            isset($_POST['price']) &&
            isset($_POST['startPlace']) &&
            isset($_POST['endPlace']) &&
            isset($_POST['dateBegining']) &&
            isset($_POST['smoking'])) {
            // Create the annonce :
            $annoncesService = new AnnoncesService();
            $dateAnnonceBegining = new DateTime($_POST['dateBegining']);
            $annonceId = $annoncesService->setAnnonce(
                null,
                $_POST['price'],
                $_POST['startPlace'],
                $_POST['endPlace'],
                $dateAnnonceBegining->format('Y-m-d h:i:s'),
                $_POST['smoking']
            );

            // Create the user-annonce relation :
            $isOk = true;
            if (!empty($_POST['idUser'])) {
                $usersService = new UsersService();
                $isOk = $usersService->setUserAnnonce($_POST['idUser'], $annonceId);
            }

            // Create the annonce cars relations :
            if (!empty($_POST['cars'])) {
                foreach ($_POST['cars'] as $carId) {
                    $isOk = $annoncesService->setAnnonceCar($annonceId, $carId);
                }
            }

            if ($annonceId && $isOk) {
                $html = 'Annonce créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getAnnonces(): string
    {
        $html = '';

        // Get all annonces :
        $annoncesService = new AnnoncesService();
        $annonces = $annoncesService->getAnnonces();

        foreach ($annonces as $annonce) {
            $carsHtml = '';
            if (!empty($annonce->getCars())) {
                foreach ($annonce->getCars() as $car) {
                    $carsHtml .= 'Marque : '. $car->getBrand() . '<br/> Modèle : ' . $car->getModel() . '<br/> Année : ' . $car->getYear() . '<br/> Couleur : ' . $car->getColor() . '<br/> Motorisation : ' . $car->getMotorization() . '<br/> Nombre de places : ' . $car->getPlacesNumber() . '<br/> Immatriculation : ' . $car->getNumberplate() . '<br/><br/>';
                }
            }

            $reservationsHtml = '';
            if (!empty($annonce->getReservations())) {
                foreach ($annonce->getReservations() as $reservation) {
                    $reservationsHtml .= $reservation->getDateTimeReservation()->format('Y-m-d H:i:s');
                }
            }

            $smoking = 'Non';
                    if ($annonce->getSmoking() == 1){
                        $smoking = 'Oui';
                    }

            $html .=
                '<h3>Réservation #' . $annonce->getId() . '</h3>' .
                'Prix : ' . $annonce->getPrice() . '€ <br />' .
                'Lieu de départ : ' . $annonce->getStartPlace() . '<br />' .
                'Lieu d\'arrivé : ' . $annonce->getEndPlace() . '<br />' .
                'Fumeur : ' . $smoking . '<br />' .
                'Date : ' . $annonce->getDateBegining()->format('d-m-Y') . '<br />' .
                'Heure : ' . $annonce->getDateBegining()->format('H:i:s') . '<br />' .
                '<h3>Voiture utilisée :</h3>' .
                $carsHtml . '<br/>' .
                '<h3>Réservation(s) :</h3>' .
                $reservationsHtml . '<br/>' .
                '<br/><hr>';
        }

        return $html;
    }

    /**
     * Update the annonce.
     */
    public function updateAnnonce(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['price']) &&
            isset($_POST['startPlace']) &&
            isset($_POST['endPlace']) &&
            isset($_POST['dateBegining'])) {

            if (!empty($_POST['smoking'])){
                $smoking = 1;
            }else{
                $smoking = 0;
            }

            // Update the annonce :
            $annoncesService = new AnnoncesService();
            $isOk = $annoncesService->setAnnonce(
                $_POST['id'],
                $_POST['price'],
                $_POST['startPlace'],
                $_POST['endPlace'],
                $_POST['dateBegining'],
                $smoking
            );
            if ($isOk) {
                $html = 'Annonce mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Delete an annonce.
     */
    public function deleteAnnonce(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the annonce :
            $annoncesService = new AnnoncesService();
            $annonceId = $annoncesService->deleteAnnonce($_POST['id']);

            // Delete the user-annonce relation :
            $isOk = true;
            if (!empty($_POST['id'])) {
                $annonceIdentifiant = $_POST['id'];
                $usersService = new UsersService();
                $isOk = $usersService->deleteUserAnnonces(null, $annonceIdentifiant);

                // Delete the annonce-car relation :
                $isOk = $annoncesService->deleteAnnonceCar($annonceIdentifiant);

                // Delete the annonce-reservation relation :
                $isOk = $annoncesService->deleteAnnonceReservations($annonceIdentifiant);
            }

            if ($annonceId && $isOk) {
                $html = 'Annonce supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'annonce.';
            }
        }

        return $html;
    }
}