<?php

namespace App\Entities;

use DateTime;

class User
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $birthday;
    private $cars;
    private $annonces;
    private $reservations;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getCars(): ?array
    {
        return $this->cars;
    }

    public function setCars(array $cars)
    {
        $this->cars = $cars;

        return $this;
    }

    public function getAnnonces(): ?array
    {
        return $this->annonces;
    }

    public function setAnnonces(array $annonces)
    {
        $this->annonces = $annonces;

        return $this;
    }

    public function getReservations(): ?array
    {
        return $this->reservations;
    }

    public function setReservations(array $reservations)
    {
        $this->reservations = $reservations;

        return $this;
    }
}
