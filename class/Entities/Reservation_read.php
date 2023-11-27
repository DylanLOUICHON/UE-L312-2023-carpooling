<?php
require_once '/ReservationsController.php';
$reservationControler = new ReservationsController();
echo $reservationControler->getReservations();
