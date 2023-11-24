<?php

namespace App\Entities;

use DateTime;

class Annonce
{
    // Attributes
    private $id;
    private $price;
    private $startPlace;
    private $endPlace;
    private $dateBegining;
    private $smoking;



    // Identifier
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }


    // Price
    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }


    // StartPlace
    public function getStartPlace(): string
    {
        return $this->startPlace;
    }

    public function setStartPlace(string $startPlace): void
    {
        $this->startPlace = $startPlace;
    }


    // EndPlace
    public function getEndPlace(): string
    {
        return $this->endPlace;
    }

    public function setEndPlace(string $endPlace): void
    {
        $this->endPlace = $endPlace;
    }


    // DateBegining
    public function getDateBegining(): DateTime
    {
        return $this->dateBegining;
    }

    public function setDateBegining(DateTime $dateBegining): void
    {
        $this->dateBegining = $dateBegining;
    }


    // Smoking
    public function getSmoking(): bool
    {
        return $this->smoking;
    }

    public function setSmoking(bool $smoking): void
    {
        $this->smoking = $smoking;
    }
}