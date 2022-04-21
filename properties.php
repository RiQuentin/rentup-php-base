<?php

//session_start();

include_once('./include/fonctions.php');

?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentUp - Properties</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
<!-- https://themezhub.net/rentup-live/rentup/home-3.html -->
<?php include_once('./include/header.php') ?>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="container">
    <h1>La listes des propriétées</h1>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th>Nom</th>
            <th>Rue</th>
            <th>Ville</th>
            <th>Code Postal</th>
            <th>Etats/Régions</th>
            <th>Pays</th>
            <th>Prix</th>
            <th>Statuts</th>
            <th>Crée le ...</th>
            <th>ID Vendeur</th>
            <th>Modifiée</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (getProperties() as $property) : ?>
            <tr>
                <td><?= $property['name']; ?></td>
                <th><?= $property['street']; ?></th>
                <th><?= $property['city']; ?></th>
                <th><?= $property['postal_code']; ?></th>
                <th><?= $property['state']; ?></th>
                <th><?= $property['country']; ?></th>
                <th><?= $property['price']; ?></th>
                <th><?= $property['status']; ?></th>
                <th><?= $property['created_at']; ?></th>
                <th><?= $property['seller_id']; ?></th>
                <th><a href="#"><i class="fa fa-wrench" aria-hidden="true"></i></a></th>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="createpropertyform.php" class="btn btn-primary">
        <i class="fa fa-plus-square" aria-hidden="true"> </i>
        Ajouter une nouvelle propriétée
    </a>
</div>


<br>
<br>
<br>
<br>
<br>
<br>
<br>


<?php include_once('./include/footer.php') ?>

<nav class="section section-bg-dark-grey footer-bottom">
    <span>© 2022 RentUP. Designd By DWWM - Nicolas M.</span>
</nav>

<aside class="back-to-top">
    <a class="btn back-to-top" href="#">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
    </a>
</aside>

<script src="dist/app.js"></script>
</body>

</html>