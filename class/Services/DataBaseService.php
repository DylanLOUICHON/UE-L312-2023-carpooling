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
    public function createUser(string $firstname, string $lastname, string $email, string $birthday): string
    {
        $userId = '';

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday,
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
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
    public function updateUser(string $id, string $firstname, string $lastname, string $email, string $birthday): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday,
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
    public function createAnnonce(string $price, string $startPlace, string $endPlace, string $dateBegining, bool $smoking): string
    {
        $isOk = false;

        $data = [
            'price' => $price,
            'startPlace' => $startPlace,
            'endPlace' => $endPlace,
            'dateBegining' => $dateBegining,
            'smoking' => $smoking
        ];
        $sql = 'INSERT INTO annonces (price, startPlace, endPlace, dateBegining, smoking) VALUES (:price, :startPlace, :endPlace, :dateBegining, :smoking)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        if ($isOk) {
            $userId = $this->connection->lastInsertId();
        }


        return $userId;
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
    public function updateAnnonce(string $id, string $price, string $startPlace, string $endPlace, string $dateBegining, string $smoking): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'price' => $price,
            'startPlace' => $startPlace,
            'endPlace' => $endPlace,
            'dateBegining' => $dateBegining,
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
    public function createCar(string $brand, string $model, string $year, string $color, string $motorization, int $placesNumber, string $numberplate): string
    {
        $carId = '';

        $data = [
            'brand' => $brand,
            'model' => $model,
            'year' => $year,
            'color' => $color,
            'motorization' => $motorization,
            'placesNumber' => $placesNumber,
            'numberplate' => $numberplate
        ];
        $sql = 'INSERT INTO cars (brand, model, year, color, motorization, placesNumber, numberplate) VALUES (:brand, :model, :year, :color, :motorization, :placesNumber, :numberplate)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        if ($isOk) {
            $carId = $this->connection->lastInsertId();
        }

        return $carId;
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
            'year' => $year,
            'color' => $color,
            'motorization' => $motorization,
            'placesNumber' => $placesNumber,
            'numberplate' => $numberplate
        ];
        $sql = 'UPDATE cars SET brand = :brand, model = :model, year = :year, color = :color, motorization = :motorization, placesNumber = :placesNumber, numberplate = :numberplate WHERE id = :id;';
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
    public function createReservation(string $idAnnonce, string $idUser, string $dateTimeReservation): string
    {
        $reservationId = '';

        $data = [
            'dateTimeReservation' => $dateTimeReservation
        ];
        $sql = 'INSERT INTO reservations (dateTimeReservation) VALUES (:dateTimeReservation)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        if ($isOk) {
            $reservationId = $this->connection->lastInsertId();

            $data = [
                'idAnnonce' => $idAnnonce,
                'reservationId' => $reservationId
            ];

            $sql = 'INSERT INTO annonces_reservations (annonce_id, reservation_id) VALUES (:idAnnonce, :reservationId)';
            $query = $this->connection->prepare($sql);
            $isOk = $query->execute($data);

            $data2 = [
                'idUser' => $idUser,
                'reservationId' => $reservationId
            ];

            $sql2 = 'INSERT INTO users_reservations (user_id, reservation_id) VALUES (:idUser, :reservationId)';
            $query = $this->connection->prepare($sql2);
            $isOk = $query->execute($data2);
        }

        return $reservationId;
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
    public function updateReservation(string $id, string $idAnnonce, string $idUser, string $dateTimeReservation): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'dateTimeReservation' => $dateTimeReservation
        ];
        $sql = 'UPDATE reservations SET dateTimeReservation = :dateTimeReservation WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        $data2 = [
            'id' => $id,
            'annonceId' => $idAnnonce
        ];
        $sql = 'UPDATE annonces_reservations SET annonce_id = :annonceId WHERE reservation_id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data2);

        $data3 = [
            'id' => $id,
            'userId' => $idUser
        ];
        $sql = 'UPDATE users_reservations SET user_id = :userId WHERE reservation_id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data3);


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


    public function deleteUserCar(?string $userId, ?string $carId): bool
    {
        $isOk = false;

        if (!empty($userId)) {
            $data = [
                'userId' => $userId,
            ];

            $sql = 'DELETE FROM users_cars WHERE user_id = :userId;';
            $query = $this->connection->prepare($sql);
            $isOk = $query->execute($data);
        }
        elseif (!empty($carId)){
            $data = [
                'carId' => $carId,
            ];
            $sql = 'DELETE FROM users_cars WHERE car_id = :carId;';
            $query = $this->connection->prepare($sql);
            $isOk = $query->execute($data);
        }

        return $isOk;
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

    public function deleteUserAnnonces(?string $userId, ?string $annonceId): bool
    {
        $isOk = false;

        if (!empty($userId)) {
            $data = [
                'userId' => $userId,
            ];

            $sql = 'DELETE FROM users_annonces WHERE user_id = :userId;';
            $query = $this->connection->prepare($sql);
            $isOk = $query->execute($data);
        }
        elseif (!empty($annonceId)){
            $data = [
                'annonceId' => $annonceId,
            ];
            $sql = 'DELETE FROM users_annonces WHERE annonce_id = :annonceId;';
            $query = $this->connection->prepare($sql);
            $isOk = $query->execute($data);
        }

        return $isOk;
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


    public function deleteUserReservations(string $userId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
        ];
        $sql = 'DELETE FROM users_reservations WHERE user_id = :userId;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }



    /**
     * Create relation bewteen an annonce and his car.
     */
    public function setAnnonceCar(string $annonceId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'annonceId' => $annonceId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO annonces_cars (annonce_id, car_id) VALUES (:annonceId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get annonce of given car id.
     */
    public function getAnnonceCars(string $annonceId): array
    {
        $annonceCar = [];

        $data = [
            'annonceId' => $annonceId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN annonces_cars as ac ON ac.car_id = c.id
            WHERE ac.annonce_id = :annonceId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $annonceCar = $results;
        }

        return $annonceCar;
    }


    public function deleteAnnonceCar(?string $annonceId, ?string $carId): bool
    {
        $isOk = false;

        if (!empty($annonceId)) {
            $data = [
                'annonceId' => $annonceId,
            ];

            $sql = 'DELETE FROM annonces_cars WHERE annonce_id = :annonceId;';
            $query = $this->connection->prepare($sql);
            $isOk = $query->execute($data);
        }
        elseif (!empty($carId)){
            $data = [
                'carId' => $carId,
            ];
            $sql = 'DELETE FROM annonces_cars WHERE car_id = :carId;';
            $query = $this->connection->prepare($sql);
            $isOk = $query->execute($data);
        }

        return $isOk;
    }



    /**
     * Create relation bewteen an annonce and reservation.
     */
    public function setAnnonceReservation(string $annonceId, string $reservationId): bool
    {
        $isOk = false;

        $data = [
            'annonceId' => $annonceId,
            'reservationId' => $reservationId,
        ];
        $sql = 'INSERT INTO annonces_reservations (annonce_id, reservation_id) VALUES (:annonceId, :reservationId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get annonce of given car id.
     */
    public function getAnnonceReservations(string $annonceId): array
    {
        $annonceReservations = [];

        $data = [
            'annonceId' => $annonceId,
        ];
        $sql = '
            SELECT r.*
            FROM reservations as r
            LEFT JOIN annonces_reservations as ar ON ar.reservation_id = r.id
            WHERE ar.annonce_id = :annonceId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $annonceReservations = $results;
        }

        return $annonceReservations;
    }


    public function deleteAnnonceReservations(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM annonces_reservations WHERE annonce_id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

}

