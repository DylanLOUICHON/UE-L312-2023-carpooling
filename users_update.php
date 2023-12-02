<?php

use App\Controllers\UsersController;

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->updateUser();
?>

<p> Mettre à jour un utilisateur </p>
<form method="post" action="users_update.php" name ="userUpdateForm">

    <label for="id"> Identifiant : </label>
    <input type="text" name="id">
    <br />

    <label for="firstname"> Prénom : </label>
    <input type="text" name="firstname">
    <br />

    <label for="lastname"> Nom : </label>
    <input type="text" name="lastname">
    <br />

    <label for="email"> Email : </label>
    <input type="text" name="email">
    <br />

    <label for="birthday"> Date d'anniversaire : </label>
    <input type="text" name="birthday">
    <br />

    <input type="submit" value="Modifier l'utilisateur">
</form>