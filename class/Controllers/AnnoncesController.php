<?php

namespace App\Controllers;

use App\Services\AnnoncesService;
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
        if (isset($_POST['price']) &&
            isset($_POST['startPlace']) &&
            isset($_POST['endPlace']) &&
            isset($_POST['dateBegining']) &&
            isset($_POST['smoking'])) {
            // Create the annonce :
            $annoncesService = new AnnoncesService();
            $dateAnnonceBegining = new DateTime($_POST['dateBegining']);
            $isOk = $annoncesService->setAnnonce(
                null,
                $_POST['price'],
                $_POST['startPlace'],
                $_POST['endPlace'],
                $dateAnnonceBegining->format('Y-m-d h:i:s'),
                $_POST['smoking']
            );
            if ($isOk) {
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

        // Get html :
        foreach ($annonces as $annonce) {
            $html .=
                '#' . $annonce->getId() . ' ' .
                $annonce->getPrice() . ' ' .
                $annonce->getStartPlace() . ' ' .
                $annonce->getEndPlace() . ' ' .
                $annonce->getSmoking() . ' ' .
                $annonce->getDateBegining()->format('d-m-Y') . '<br />';
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
        if (isset($_POST['price']) &&
            isset($_POST['startPlace']) &&
            isset($_POST['endPlace']) &&
            isset($_POST['dateBegining']) &&
            isset($_POST['smoking'])) {
            // Update the annonce :
            $annoncesService = new AnnoncesService();
            $isOk = $annoncesService->setAnnonce(
                $_POST['id'],
                $_POST['price'],
                $_POST['startPlace'],
                $_POST['endPlace'],
                $_POST['dateBegining'],
                $_POST['smoking']
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
            $isOk = $annoncesService->deleteAnnonce($_POST['id']);
            if ($isOk) {
                $html = 'Annonce supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'annonce.';
            }
        }

        return $html;
    }
}