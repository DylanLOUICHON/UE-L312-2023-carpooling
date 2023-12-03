<?php

namespace App\Services;

use App\Entities\Annonce;
use App\Entities\Car;
use App\Entities\Reservation;
use DateTime;

class AnnoncesService
{

    /**
     * Create or update an annonce.
     */
    public function setAnnonce(?string $id, int $price, string $startPlace, string $endPlace, string $dateBegining, string $smoking): string
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $isOk = $dataBaseService->createAnnonce($price, $startPlace, $endPlace, $dateBegining, $smoking);
        } else {
            $isOk = $dataBaseService->updateAnnonce($id, $price, $startPlace, $endPlace, $dateBegining, $smoking);
        }

        return $isOk;
    }


    /**
     * Return all annonces.
     */
    public function getAnnonces(): array
    {
        $annonces = [];

        $dataBaseService = new DataBaseService(); 
        $annoncesDTO = $dataBaseService->getAnnonces();
        if (!empty($annoncesDTO )) {
            foreach ($annoncesDTO  as $annonceDTO) {
                $annonce = new Annonce();
                $annonce->setId($annonceDTO['id']);
                $annonce->setPrice($annonceDTO['price']);
                $annonce->setStartPlace($annonceDTO['startPlace']);
                $annonce->setEndPlace($annonceDTO['endPlace']);
                $date = new DateTime($annonceDTO['dateBegining']);
                if ($date !== false) {
                    $annonce->setDateBegining($date);
                }
                $annonce->setSmoking($annonceDTO['smoking']);

                // Get cars of this annonce :
                $cars = $this->getAnnonceCars($annonceDTO['id']);
                $annonce->setCars($cars);

                // Get reservations of this annonce :
                $reservations = $this->getAnnonceReservations($annonceDTO['id']);
                $annonce->setReservations($reservations);

                $annonces[] = $annonce;
                
            }
        }  

        return $annonces;
    }


    /**
     * Delete an annonce.
     */
    public function deleteAnnonce(string $id): string
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteAnnonce($id); 
        
        return $isOk;   
    } 



    /**
     * Create relation bewteen an annonce and his car.
     */
    public function setAnnonceCar(string $annonceId, string $carId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setAnnonceCar($annonceId, $carId);

        return $isOk;
    }


    /**
     * Get cars of given annonce id.
     */
    public function getAnnonceCars(string $annonceId): array
    {
        $annonceCars = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $annonceCarsDTO = $dataBaseService->getAnnonceCars($annonceId);
        if (!empty($annonceCarsDTO)) {
            foreach ($annonceCarsDTO as $annonceCarDTO) {
                $car = new Car();
                $car->setId($annonceCarDTO['id']);
                $car->setBrand($annonceCarDTO['brand']);
                $car->setModel($annonceCarDTO['model']);
                $car->setYear($annonceCarDTO['year']);
                $car->setColor($annonceCarDTO['color']);
                $car->setMotorization($annonceCarDTO['motorization']);
                $car->setPlacesNumber($annonceCarDTO['placesNumber']);
                $car->setNumberplate($annonceCarDTO['numberplate']);

                $annonceCars[] = $car;
            }
        }

        return $annonceCars;
    }


    public function deleteAnnonceCar(?string $annonceId, ?string $carId): bool
    {
        $isOk = false;

        if (!empty($annonceId)){
            $dataBaseService = new DataBaseService();
            $isOk = $dataBaseService->deleteAnnonceCar($annonceId, null);
    
        } 
        elseif (!empty($carId)) {
            $dataBaseService = new DataBaseService();
            $isOk = $dataBaseService->deleteAnnonceCar(null, $carId);
        }

        return $isOk;
    }



    /**
     * Create relation bewteen an annonce and his car.
     */
    public function setAnnonceReservation(string $annonceId, string $reservationId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setAnnonceReservation($annonceId, $reservationId);

        return $isOk;
    }


    public function getAnnonceReservations(string $annonceId): array
    {
        $annonceReservations = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $annonceReservationsDTO = $dataBaseService->getAnnonceReservations($annonceId);
        if (!empty($annonceReservationsDTO)) {
            foreach ($annonceReservationsDTO as $annonceReservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($annonceReservationDTO['id']);
                $date = new DateTime($annonceReservationDTO['dateTimeReservation']);
                $reservation->setDateTimeReservation($date);
                $annonceReservations[] = $reservation;
            }
        }

        return $annonceReservations;
    }


    public function deleteAnnonceReservations(string $annonceId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteAnnonceReservations($annonceId);

        return $isOk;
    }

}
?>