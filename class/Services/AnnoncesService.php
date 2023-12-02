<?php

namespace App\Services;

use App\Entities\Annonce;
use DateTime;

class AnnoncesService
{

    /**
     * Create or update an annonce.
     */
    public function setAnnonce(?string $id, int $price, string $startPlace, string $endPlace, string $dateBegining, bool $smoking): string
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $dateBegining = new DateTime($dateBegining);
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

                $annonces[] = $annonce;
            }
        }  

        return $annonces;
    }


    /**
     * Delete an annonce.
     */
    public function deleteAnnonce(string $id): bool
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
     * Create relation bewteen an annonce and his car.
     */
    public function setAnnonceReservation(string $annonceId, string $reservationId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setAnnonceReservation($annonceId, $reservationId);

        return $isOk;
    }

}
?>