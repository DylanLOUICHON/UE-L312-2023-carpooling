<?php

namespace App\Entities;

class Car
{
    // Attributes
    private $id;
    private $brand;
    private $model;
    private $year;
    private $color;
    private $motorization;
    private $placesNumber;
    private $numberplate;


    // Identifier
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }


    // Brand
    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }


    // Model
    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }


    // Year
    public function getYear(): string
    {
        return $this->year;
    }

    public function setYear($year): void
    {
        $this->year = $year;
    }


    // Color
    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor($color): void
    {
        $this->color = $color;
    }


    // Motorization
    public function getMotorization(): string
    {
        return $this->motorization;
    }

    public function setMotorization($motorization): void
    {
        $this->motorization = $motorization;
    }


    // PlacesNumber
    public function getPlacesNumber(): int
    {
        return $this->placesNumber;
    }

    public function setPlacesNumber(int $placesNumber): void
    {
        $this->placesNumber = $placesNumber;
    }


    // Numberplate
    public function getNumberplate(): string
    {
        return $this->numberplate;
    }

    public function setNumberplate($numberplate): void
    {
        $this->numberplate = $numberplate;
    }

}