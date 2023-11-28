<?php

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    const HOST = '127.0.0.1';
    const PORT = '3306';
    const DATABASE_NAME = 'carpooling';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = '';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
            $this->connection->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Create an user.
     */
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $sql = 'SELECT * FROM users';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update an user.
     */
    public function updateUser(string $id, string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM users WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }



    /**
     * Create an annonce.
     */
    public function createAnnonce(string $price, string $startPlace, string $endPlace, DateTime $dateBegining, bool $smoking): bool
    {
        $isOk = false;

        $data = [
            'price' => $price,
            'startPlace' => $startPlace,
            'endPlace' => $endPlace,
            'dateBegining' => $dateBegining->format(DateTime::RFC3339),
            'smoking' => $smoking
        ];
        $sql = 'INSERT INTO annonces (price, startPlace, endPlace, dateBegining, smoking) VALUES (:price, :startPlace, :endPlace, :dateBegining, :smoking)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Update an annonce.
     */
    public function updateAnnonce(string $price, string $startPlace, string $endPlace, DateTime $dateBegining, bool $smoking): bool
    {
        $isOk = false;

        $data = [
            'price' => $price,
            'startPlace' => $startPlace,
            'endPlace' => $endPlace,
            'dateBegining' => $dateBegining->format(DateTime::RFC3339),
            'smoking' => $smoking
        ];
        $sql = 'UPDATE annonces SET price = :price, startPlace = :startPlace, endPlace = :endPlace, dateBegining = :dateBegining, smoking = :smoking WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an annonce.
     */
    public function deleteAnnonce(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM annonces WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }



    /**
     * Create a car.
     */
    public function createCar(string $brand, string $model, string $year, string $color, string $motorization, int $placesNumber, string $numberplate): bool
    {
        $isOk = false;

        $data = [
            'brand' => $brand,
            'model' => $model,
            'yearCar' => $year,
            'color' => $color,
            'motorization' => $motorization,
            'placesNumber' => $placesNumber,
            'numberplate' => $numberplate
        ];
        $sql = 'INSERT INTO cars (brand, model, yearCar, color, motorization, placesNumber, numberplate) VALUES (:brand, :model, :yearCar, :color, :motorization, :placesNumber, :numberplate)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Update a car.
     */
    public function updateCar(string $brand, string $model, string $year, string $color, string $motorization, int $placesNumber, string $numberplate): bool
    {
        $isOk = false;

        $data = [
            'brand' => $brand,
            'model' => $model,
            'yearCar' => $year,
            'color' => $color,
            'motorization' => $motorization,
            'placesNumber' => $placesNumber,
            'numberplate' => $numberplate
        ];
        $sql = 'UPDATE cars SET brand = :brand, model = :model, year = :yearCar, color = :color, motorization = :motorization, placesNumber = :placesNumber, numberplate = :numberplate WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete a car.
     */
    public function deleteCar(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM cars WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }



    /**
     * Create a reservation.
     */
    public function createReservation(DateTime $dateTimeReservation): bool
    {
        $isOk = false;

        $data = [
            'dateTimeReservation' => $dateTimeReservation
        ];
        $sql = 'INSERT INTO reservations (dateTimeReservation) VALUES (:dateTimeReservation)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Update a reservation.
     */
    public function updateReservation(DateTime $dateTimeReservation): bool
    {
        $isOk = false;

        $data = [
            'dateTimeReservation' => $dateTimeReservation
        ];
        $sql = 'UPDATE reservations SET dateTimeReservation = :dateTimeReservation WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete a car.
     */
    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM reservations WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }
}

