<?php

    use App\Controllers\ReservationsController;

    require __DIR__ . '/vendor/autoload.php';

    $reservationControler = new ReservationsController();
    echo $reservationControler->deleteReservation();
?>

<p> Suppression d'une réservation </p>
<form method="post" action="reservations_delete.php" name="reservationDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une reservation ">
</form>