<?php
require_once '/ReservationsController.php';

$reservationControler = new ReservationsController();
echo $reservationControler->deleteReservation();
?>
<p> Suppression d'une annonce </p>
<form method="post" action="Reservation_delete.php" name="Reservation_Delete_Form">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une reservation ">
</form>
?>