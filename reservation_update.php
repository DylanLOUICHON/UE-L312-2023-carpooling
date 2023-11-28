<?php

  use App\Controllers\ReservationsController;

  require __DIR__ . '/vendor/autoload.php';

  $reservationControler = new ReservationsController();
  echo $reservationControler->updateReservation();
?>

<p>Création d'une reservation</p>
<form method="post" action="reservation_update.php" name="reservationUpdateForm">
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