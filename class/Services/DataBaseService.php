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
        $userId = '';

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        $isOk = $query->execute($data);
        if ($isOk) {
            $userId = $this->connection->lastInsertId();
        }

        return $userId;
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
     * Return all annonces.
     */
    public function getAnnonces(): array
    {
        $annonces = [];

        $sql = 'SELECT * FROM annonces';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $annonces = $results;
        }

        return $annonces;
    }


    /**
     * Update an annonce.
     */
    public function updateAnnonce(string $id, string $price, string $startPlace, string $endPlace, DateTime $dateBegining, bool $smoking): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
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
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $sql = 'SELECT * FROM cars';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $cars = $results;
        }

        return $cars;
    }



    /**
     * Update a car.
     */
    public function updateCar(string $id, string $brand, string $model, string $year, string $color, string $motorization, int $placesNumber, string $numberplate): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
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
     * Return all reservations.
     */
    public function getReservations(): array
    {
        $reservations = [];

        $sql = 'SELECT * FROM reservations';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $reservations = $results;
        }

        return $reservations;
    }


    /**
     * Update a reservation.
     */
    public function updateReservation(string $id, DateTime $dateTimeReservation): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
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



    /**
     * Create relation bewteen an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO users_cars (user_id, car_id) VALUES (:userId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN users_cars as uc ON uc.car_id = c.id
            WHERE uc.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userCars = $results;
        }

        return $userCars;
    }



    /**
     * Create relation bewteen an user and his annonce.
     */
    public function setUserAnnonce(string $userId, string $annonceId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'annonceId' => $annonceId,
        ];
        $sql = 'INSERT INTO users_annonces (user_id, annonce_id) VALUES (:userId, :annonceId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get annonces of given user id.
     */
    public function getUserAnnonces(string $userId): array
    {
        $userAnnonces = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT a.*
            FROM annonces as a
            LEFT JOIN users_annonces as ua ON ua.annonce_id = a.id
            WHERE ua.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userAnnonces = $results;
        }

        return $userAnnonces;
    }



    /**
     * Create relation bewteen an user and his reservations.
     */
    public function setUserReservation(string $userId, string $reservationId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'reservationId' => $reservationId,
        ];
        $sql = 'INSERT INTO users_reservations (user_id, reservations_id) VALUES (:userId, :reservationsId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get reservations of given user id.
     */
    public function getUserReservations(string $userId): array
    {
        $userReservations = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT r.*
            FROM reservations as r
            LEFT JOIN users_reservations as ur ON ur.reservation_id = r.id
            WHERE ur.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userReservations = $results;
        }

        return $userReservations;
    }
}

