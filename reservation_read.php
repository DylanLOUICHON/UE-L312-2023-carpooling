<?php
    use App\Controllers\ReservationsController;

    require __DIR__ . '/vendor/autoload.php';

    $reservationControler = new ReservationsController();
    echo $reservationControler->getReservations();
