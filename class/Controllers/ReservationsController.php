<?php

namespace App\Controllers;

use App\Services\ReservationsService;

class ReservationsController
{
    /**
     * Return the html for the create action.
     */
    public function createReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['idAnnonce']) &&
            isset($_POST['idUser']) &&
            isset($_POST['dateTimeReservation'])) {
            // Create the reservation :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->setReservation(
                null,
                $_POST['idAnnonce'],
                $_POST['idUser'],
                $_POST['dateTimeReservation']
            );
            if ($isOk) {
                $html = 'Reservation créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de la réservation.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getReservations(): string
    {
        $html = '';

        // Get all reservations :
        $reservationsService = new ReservationsService();
        $reservations = $reservationsService->getReservations();

        // Get html :
        foreach ($reservations as $reservation) {
            $html .=
                '<h3>Réservation #' . $reservation->getId() . '</h3>' .
                'Date : ' . $reservation->getDateTimeReservation()->format('Y-m-d') . '</br>' .
                'Heure : ' . $reservation->getDateTimeReservation()->format('H:i:s') . '</br>' .
                '<br/>';
        }

        return $html;
    }

    /**
     * Update the reservation.
     */
    public function updateReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['idAnnonce']) &&
            isset($_POST['idUser']) &&
            isset($_POST['dateTimeReservation'])) {
            // Update the reservation :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->setReservation(
                $_POST['id'],
                $_POST['idAnnonce'],
                $_POST['idUser'],
                $_POST['dateTimeReservation']
            );
            if ($isOk) {
                $html = 'Reservation mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la réservation.';
            }
        }

        return $html;
    }

    /**
     * Delete a reservation.
     */
    public function deleteReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the reservation :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->deleteReservation($_POST['id']);
            if ($isOk) {
                $html = 'Réservation supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la réservation.';
            }
        }

        return $html;
    }
}