<?php

namespace App\Controllers;

use App\Services\UsersService;

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
            isset($_POST['birthday']) &&
            isset($_POST['cars']) &&
            isset($_POST['annonces']) &&
            isset($_POST['reservations'])) {
            // Create the user :
            $usersService = new UsersService();
            $userId = $usersService->setUser(
                null,
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['birthday']
            );

            // Create the user cars relations :
            $isOk = true;
            if (!empty($_POST['cars'])) {
                foreach ($_POST['cars'] as $carId) {
                    $isOk = $usersService->setUserCar($userId, $carId);
                }
            }

            // Create the user annonces relations :
            if (!empty($_POST['annonces'])) {
                foreach ($_POST['annonces'] as $annonceId) {
                    $isOk = $usersService->setUserAnnonce($userId, $annonceId);
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
                    $carsHtml .= $car->getBrand() . ' ' . $car->getModel() . ' ' . $car->getYear() . ' ' . $car->getColor() . ' ' . $car->getMotorization() . ' ' . $car->getPlacesNumber() . ' ' . $car->getNumberplate();
                }
            }

            $annoncesHtml = '';
            if (!empty($user->getAnnonces())) {
                foreach ($user->getAnnonces() as $annonce) {
                    $annoncesHtml .= $annonce->getPrice() . ' ' . $annonce->getStartPlace() . ' ' . $annonce->getEndPlace() . ' ' . $annonce->getDateBegining() . ' ' . $annonce->getSmoking();
                }
            }

            $reservationsHtml = '';
            if (!empty($user->getReservations())) {
                foreach ($user->getReservations() as $reservation) {
                    $reservationsHtml .= $reservation->getDateTimeReservation();
                }
            }

            $html .=
                '#' . $user->getId() . ' ' .
                $user->getFirstname() . ' ' .
                $user->getLastname() . ' ' .
                $user->getEmail() . ' ' .
                $user->getBirthday()->format('d-m-Y') . ' ' .
                $carsHtml . ' ' .
                $annoncesHtml . ' ' .
                $reservationsHtml . '<br />';
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
