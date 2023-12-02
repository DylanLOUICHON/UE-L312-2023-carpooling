<?php

  use App\Controllers\ReservationsController;

  require __DIR__ . '/vendor/autoload.php';

  $reservationControler = new ReservationsController();
  echo $reservationControler->updateReservation();
?>

<p> Mettre à jour une réservation </p>
<form method="post" action="reservations_update.php" name="reservationUpdateForm">
  <!-- Des inputs avec des labels pour remplir les caractéristiques de chaque annonce -->

  <label for="idAnnonce"> Identifiant annonce : </label>
  <input type="number" name="idAnnonce">
  <br />

  <label for="idUser"> Identifiant utilisateur : </label>
  <input type="number" name="idUser">
  <br />

  <label for="dateTimeReservation "> Date de réservation : </label>
  <input type="text" name="dateTimeReservation">
  <br />
</form>