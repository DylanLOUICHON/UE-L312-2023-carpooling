<?php

    use App\Controllers\UsersController;

    require __DIR__ . '/vendor/autoload.php';

    $controller = new UsersController();
    echo $controller->deleteUser();
?>

<p> Supression d'un utilisateur </p>
<form method="post" action="users_delete.php" name ="userDeleteForm">

    <label for="id"> Identifiant : </label>
    <input type="number" name="id">
    <br />

    <input type="submit" value="Supprimer un utilisateur">
</form>