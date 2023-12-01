<?php

namespace App\Services;

use App\Entities\Annonce;
use App\Entities\Car;
use App\Entities\User;
use App\Entities\Reservation;

use DateTime;

class UsersService
{
    /**
     * Create or update an user.
     */
    public function setUser(?string $id, string $firstname, string $lastname, string $email, string $birthday): string
    {
        $userId = '';

        $dataBaseService = new DataBaseService();
        $birthdayString = $birthday;
        $format = "Y-m-d 00:00:00";
        $birthdayDateTime = DateTime::createFromFormat($format, $birthdayString);

        if (empty($id)) {
            $userId = $dataBaseService->createUser($firstname, $lastname, $email, $birthdayDateTime);
        } else {
            $dataBaseService->updateUser($id, $firstname, $lastname, $email, $birthdayDateTime);
            $userId = $id;
        }

        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $dataBaseService = new DataBaseService();
        $usersDTO = $dataBaseService->getUsers();
        if (!empty($usersDTO)) {
            foreach ($usersDTO as $userDTO) {
                $user = new User();
                $user->setId($userDTO['id']);
                $user->setFirstname($userDTO['firstname']);
                $user->setLastname($userDTO['lastname']);
                $user->setEmail($userDTO['email']);
                $date = new DateTime($userDTO['birthday']);
                if ($date !== false) {
                    $user->setbirthday($date);
                }

                // Get cars of this user :
                $cars = $this->getUserCars($userDTO['id']);
                $user->setCars($cars);

                // Get annonces of this user :
                $annonces = $this->getUserAnnonces($userDTO['id']);
                $user->setAnnonces($annonces);

                // Get reservations of this user :
                $reservations = $this->getUserReservations($userDTO['id']);
                $user->setReservations($reservations);

                $users[] = $user;
            }
        }

        return $users;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteUser($id);

        return $isOk;
    }



    /**
     * Create relation bewteen an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserCar($userId, $carId);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $usersCarsDTO = $dataBaseService->getUserCars($userId);
        if (!empty($usersCarsDTO)) {
            foreach ($usersCarsDTO as $userCarDTO) {
                $car = new Car();
                $car->setId($userCarDTO['id']);
                $car->setBrand($userCarDTO['brand']);
                $car->setModel($userCarDTO['model']);
                $car->setYear($userCarDTO['year']);
                $car->setColor($userCarDTO['color']);
                $car->setMotorization($userCarDTO['motorization']);
                $car->setPlacesNumber($userCarDTO['placesNumber']);
                $car->setNumberplate($userCarDTO['numberplate']);
                $userCars[] = $car;
            }
        }

        return $userCars;
    }



    /**
     * Create relation bewteen an user and his annonces.
     */
    public function setUserAnnonce(string $userId, string $annonceId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserAnnonce($userId, $annonceId);

        return $isOk;
    }

    /**
     * Get annonces of given user id.
     */
    public function getUserAnnonces(string $userId): array
    {
        $userAnnonces = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and annonces :
        $usersAnnoncesDTO = $dataBaseService->getUserAnnonces($userId);
        if (!empty($usersAnnoncesDTO)) {
            foreach ($usersAnnoncesDTO as $userAnnoncesDTO) {
                $annonce = new Annonce();
                $annonce->setId($userAnnoncesDTO['id']);
                $annonce->setPrice($userAnnoncesDTO['price']);
                $annonce->setStartPlace($userAnnoncesDTO['startPlace']);
                $annonce->setEndPlace($userAnnoncesDTO['endPlace']);
                $date = new DateTime($userAnnoncesDTO['dateBegining']);
                if ($date !== false) {
                    $annonce->setDateBegining($date);
                }
                $annonce->setSmoking($userAnnoncesDTO['smoking']);

                $userAnnonces[] = $annonce;
            }
        }

        return $userAnnonces;
    }



    /**
     * Create relation bewteen an user and his reservations.
     */
    public function setUserReservation(string $userId, string $reservationId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserReservation($userId, $reservationId);

        return $isOk;
    }

    /**
     * Get reservations of given user id.
     */
    public function getUserReservations(string $userId): array
    {
        $userReservations = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and reservations :
        $usersReservationsDTO = $dataBaseService->getUserReservations($userId);
        if (!empty($usersReservationsDTO)) {
            foreach ($usersReservationsDTO as $userReservationsDTO) {
                $reservation = new Reservation();
                
                $reservation->setId($userReservationsDTO['id']);
                $date = new DateTime($userReservationsDTO['dateTimeReservation']);
                if ($date !== false) {
                    $reservation->setDateTimeReservation($date);
                }

                $userReservations[] = $reservation;
            }
        }

        return $userReservations;
    }
}
