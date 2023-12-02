<?php

  use App\Controllers\ReservationsController;

  require __DIR__ . '/vendor/autoload.php';

  $reservationControler = new ReservationsController();
  echo $reservationControler->createReservation();
?>

<p> Création d'une réservation </p>
<form method="post" action="reservations_create.php" name="reservationCreateForm">

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

  <input type="submit" value="Créer une reservation">
</form>