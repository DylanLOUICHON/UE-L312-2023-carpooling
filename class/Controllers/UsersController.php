<?php

namespace App\Controllers;

use App\Services\UsersService;
use DateTime;

class UsersController
{
    /**
     * Return the html for the create action.
     */
    public function createUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['firstname']) &&
            isset($_POST['lastname']) &&
            isset($_POST['email']) &&
            isset($_POST['birthday'])) {
            // Create the user :
            $usersService = new UsersService();
            $dateBirthday = new DateTime($_POST['birthday']);
            $userId = $usersService->setUser(
                null,
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $dateBirthday->format('Y-m-d') . ' 00:00:00'
            );
            
            // Create the user cars relations :
            $isOk = true;
            if (!empty($_POST['cars'])) {
                foreach ($_POST['cars'] as $carId) {
                    $isOk = $usersService->setUserCar($userId, $carId);
                }
            }

            // Create the user reservations relations :
            if (!empty($_POST['reservations'])) {
                foreach ($_POST['reservations'] as $reservationId) {
                    $isOk = $usersService->setUserReservation($userId, $reservationId);
                }
            }


            if ($userId && $isOk) {
                $html = 'Utilisateur créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de l\'utilisateur.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getUsers(): string
    {
        $html = '';

        // Get all users :
        $usersService = new UsersService();
        $users = $usersService->getUsers();

        // Get html :
        foreach ($users as $user) {
            $carsHtml = '';
            if (!empty($user->getCars())) {
                foreach ($user->getCars() as $car) {
                    $carsHtml .= 'Marque : '. $car->getBrand() . '<br/> Modèle : ' . $car->getModel() . '<br/> Année : ' . $car->getYear() . '<br/> Couleur : ' . $car->getColor() . '<br/> Motorisation : ' . $car->getMotorization() . '<br/> Nombre de places : ' . $car->getPlacesNumber() . '<br/> Immatriculation : ' . $car->getNumberplate() . '<br/><br/>';
                }
            }


            $annoncesHtml = '';
            if (!empty($user->getAnnonces())) {
                foreach ($user->getAnnonces() as $annonce) {
                    $smoking = 'Non';
                    if ($annonce->getSmoking() == 1){
                        $smoking = 'Oui';
                    }


                    $annoncesHtml .= 'Prix : ' . $annonce->getPrice() . '€ <br/> Lieu de départ : ' . $annonce->getStartPlace() . '<br/> Lieu d\'arrivé : ' . $annonce->getEndPlace() . '<br/> Date de départ : ' . $annonce->getDateBegining()->format('d m Y') . '<br/> Heure de départ : ' . $annonce->getDateBegining()->format('H:i:s') . '<br/> Cigarettes autorisées : ' . $smoking . '<br/>';
                }
            }


            $reservationsHtml = '';
            if (!empty($user->getReservations())) {
                foreach ($user->getReservations() as $reservation) {
                    $reservationsHtml .= $reservation->getDateTimeReservation()->format('Y-m-d H:i:s');
                }
            }


            $html .=
                '<h1>Utilisateur #' . $user->getId() . '</h1>' .
                '<h3>Informations personnelles :</h3>' .
                $user->getFirstname() . ' ' .
                $user->getLastname() . '<br/>' .
                'Adresse email : ' . $user->getEmail() . '<br/>' .
                'Date de naissance : ' . $user->getBirthday()->format('d m Y') . '<br/>' .
                '<h3>Voiture(s) personnelle(s) :</h3>' .
                $carsHtml . '<br/>' .
                '<h3>Annonce(s) personnelle(s) :</h3>' .
                $annoncesHtml . '<br/>' .
                '<h3>Réservation(s) personnelle(s) :</h3>' .
                $reservationsHtml . '<br />' .
                '<br/><hr>';
        }

        return $html;
    }

    /**
     * Update the user.
     */
    public function updateUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['firstname']) &&
            isset($_POST['lastname']) &&
            isset($_POST['email']) &&
            isset($_POST['birthday'])) {
            // Update the user :
            $usersService = new UsersService();
            $isOk = $usersService->setUser(
                $_POST['id'],
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['birthday']
            );
            if ($isOk) {
                $html = 'Utilisateur mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'utilisateur.';
            }
        }

        return $html;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the user :
            $usersService = new UsersService();
            $isOk = $usersService->deleteUser($_POST['id']);
            if ($isOk) {
                $html = 'Utilisateur supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'utilisateur.';
            }
        }

        return $html;
    }
}
