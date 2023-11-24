<?php

namespace App\Entities;

use DateTime;

class Reservation
{
    // Attributes
    private $id;
    private $dateTimeReservation;


    // Identifier
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }


    // DateTimeReservation
    public function getDateTimeReservation(): DateTime
    {
        return $this->dateTimeReservation;
    }

    public function setDateTimeReservation(DateTime $dateTimeReservation): void
    {
        $this->dateTimeReservation = $dateTimeReservation;
    }
    
}