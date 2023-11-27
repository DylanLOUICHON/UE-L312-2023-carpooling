<?php
require_once '/ReservationsController.php';
$reservationControler = new ReservationsController();
echo $reservationControler->createReservation();
?>
<p>Création d'une reservation</p>
<form method="post" action="Car_create.php" name="Reservation_create_form">

  <!-- Des inputs avec des labels pour remplir les caractéristiques de chaque annonce -->

  <label for="idAnnonce">id Annonce :</label>
  <input type="number" name="idAnnonce">
  <br />

  <label for="idUser">id User :</label>
  <input type="number" name="id User">
  <br />

  <label for="dateTimeReservation ">Date de reservation au format dd-mm-yyyy :</label>
  <input type="text" name="dateTimeReservation">
  <br />
</form>