<?php

namespace App\Services;

use App\Entities\Reservation;

use DateTime;


class ReservationsService
{

    /**
     * Create or update a reservation.
     */
    public function setReservation(?string $idUser, string $dateTimeReservation): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $reservationDateTime = new DateTime($dateTimeReservation);
        if (empty($id)) {
            $isOk = $dataBaseService->createReservation($reservationDateTime);
        } else {
            $isOk = $dataBaseService->updateReservation($idUser, $reservationDateTime);
        }

        return $isOk;
    }


    /**
     * Return all reservations.
     */
    public function getReservations(): array
    {
        $reservations = [];

        $dataBaseService = new DataBaseService();
        $reservationsDTO = $dataBaseService->getReservations();
        if (!empty($reservationsDTO)) {
            foreach ($reservationsDTO as $reservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($reservationDTO['id']);
                $date = new DateTime($reservationDTO['dateTimeReservation']);
                if ($date !== false) {
                    $reservation->setDateTimeReservation($date);
                }
                $reservations[] = $reservation;
            }
        }

        return $reservations;
    }

    
    /**
     * Delete a reservation.
     */
    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteReservation($id);

        return $isOk;
    }
}

?>
