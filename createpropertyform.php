<?php

//session_start();
$tokenUpdate = null;

include_once('./include/fonctions.php');
if (isset($_POST['name']) && isset($_POST['street']) && !isset($_GET['id'])) {

    $filePathBdd = "default-image";

    if ($_FILES['image']['error'] == 0){
        if ($_FILES['image']['size'] <= 1000000){
            $fileInfo = pathinfo($_FILES['image']['name']);
            $extension = $fileInfo['extension'];
            $mimetype = mime_content_type($_FILES['image']['tmp_name']);
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
            if (in_array($extension, $allowedExtensions) && in_array($mimetype, array('image/jpeg', 'image/gif', 'image/png'))){
                $filePathBdd = basename($_FILES['image']['name']);
                $filePath = 'images/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $filePath);
            }else {
                echo '<script>alert("Le fichier doit être une image")</script>';
            }
        }else {
            echo '<script>alert(" l \'image ne doit pas dépasser 1mo")</script>';
        }
    }else {
        echo '<script>alert("Une erreur est survenue lors de l\'import de l\'image")</script>';
    }

    if(createProperty(
            $_POST['name'],
            $_POST['street'],
            $_POST['city'],
            $_POST['postalCode'],
            $_POST['state'],
            $_POST['country'],
            $_POST['price'],
            $_POST['status'],
            $_POST['createdAt'],
            $filePathBdd,
            $_POST['propertyTypeId'],
            $_POST['sellerId']
        ) === true) {
        header('Location: index.php');
    } else {
        $messageErreur = 'Une erreur est survenue lors de la création de la recette';
    }
}

if (isset($_POST['name']) && isset($_POST['street']) && isset($_GET['id'])) {

    if($_POST['myCheck']==="on"){
        if ($_FILES['image']['error'] == 0){
            if ($_FILES['image']['size'] <= 1000000){
                $fileInfo = pathinfo($_FILES['image']['name']);
                $extension = $fileInfo['extension'];
                $mimetype = mime_content_type($_FILES['image']['tmp_name']);
                $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                if (in_array($extension, $allowedExtensions) && in_array($mimetype, array('image/jpeg', 'image/gif', 'image/png'))){
                    $filePathBdd = basename($_FILES['image']['name']);
                    $filePath = 'images/' . basename($_FILES['image']['name']);
                    move_uploaded_file($_FILES['image']['tmp_name'], $filePath);
                }else {
                    echo '<script>alert("Le fichier doit être une image")</script>';
                }
            }else {
                echo '<script>alert(" l \'image ne doit pas dépasser 1mo")</script>';
            }
        }else {
            echo '<script>alert("Une erreur est survenue lors de l\'import de l\'image")</script>';
        }
    }else{
        $propertyDB = getPropertyById($_GET['id']);
        $filePathBdd = $propertyDB['image'];
    }



    if(updatePropertyById(
            $_GET['id'],
            $_POST['name'],
            $_POST['street'],
            $_POST['city'],
            $_POST['postalCode'],
            $_POST['state'],
            $_POST['country'],
            $_POST['price'],
            $_POST['status'],
            $_POST['createdAt'],
            $filePathBdd,
            $_POST['propertyTypeId'],
            $_POST['sellerId']
        ) === true) {
        header('Location: index.php');
    } else {
        $messageErreur = 'Une erreur est survenue lors de la création de la recette';
    }
}

if (isset($_GET['id'])){
    $tokenUpdate = $_GET['id'];
    $propertyDB = getPropertyById($_GET['id']);
}


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

<main>
    <section class="section">
        <div class="container">

            <h1><?php echo $tokenUpdate!==null ? "Modifier une nouvelle propriétée" : "Ajout d'une nouvelle propriétée" ; ?> :</h1>


            <form class="form-group" action="createpropertyform.php<?php if($tokenUpdate !== null){echo '?id='.$_GET['id'];} ?>" method="post"
                  enctype="multipart/form-data">

                <label for="name">Nom :</label>
                <input type="text" class="form-control" name="name" id="name" required value="<?php if($tokenUpdate !== null){echo $propertyDB['name'];} ?>">

                <label for="street">Rue :</label>
                <input type="text" class="form-control" name="street" id="street" required value="<?php if($tokenUpdate !== null){echo $propertyDB['street'];} ?>">
                <br>

                <label for="city">Ville :</label>
                <input type="text" class="form-control" name="city" id="city" required value="<?php if($tokenUpdate !== null){echo $propertyDB['city'];} ?>">

                <label for="postalCode">Code postal :</label>
                <input type="text" class="form-control" name="postalCode" id="postalCode" required value="<?php if($tokenUpdate !== null){echo $propertyDB['postal_code'];} ?>">
                <br>

                <label for="state">State :</label>
                <input type="text" class="form-control" name="state" id="state" required value="<?php if($tokenUpdate !== null){echo $propertyDB['state'];} ?>">

                <label for="country">Pays :</label>
                <input type="text" class="form-control" name="country" id="country" required value="<?php if($tokenUpdate !== null){echo $propertyDB['country'];} ?>">
                <br>

                <label for="price">Prix :</label>
                <input type="number" class="form-control" name="price" id="price" placeholder="€" required value="<?php if($tokenUpdate !== null){echo $propertyDB['price'];} ?>">
                <br>

                <div>
                    Statut du bien :
                    <input type="radio" id="status" name="status" value="For Rent" <?php if($tokenUpdate !== null  && $propertyDB['status'] === "For Rent" ){echo 'checked';} ?> >
                    <label for="forRent">For Rent</label>
                    <input type="radio" id="status" name="status" value="For Sale" <?php if($tokenUpdate !== null  && $propertyDB['status'] === "For Sale" ){echo 'checked';} ?> >
                    <label for="forSale">For Sale</label>
                    <input type="radio" id="status" name="status" value="Sold" <?php if($tokenUpdate !== null  && $propertyDB['status'] === "Sold" ){echo 'checked';} ?> >
                    <label for="forSale">Sold</label>
                </div>

                <label for="createdAt">Crée le :</label>
                <input type="date" class="form-control" name="createdAt" id="createdAt" required value="<?php if($tokenUpdate !== null){echo $propertyDB['created_at'];} ?>">
                <br>

                <label for="image">Choisissez une image pour la propriétée :</label>
                <?php if ($tokenUpdate !== null): ?>
                    <div>'Image original : '<?= $propertyDB['image'] ?></div>
                    <label for="myCheck">Modifier l'image :</label>
                    <input type="checkbox" name="myCheck" id="myCheck" onclick="myFunction()">
                <?php endif; ?>
                <div id="text" style="<?php if($tokenUpdate !== null){echo 'display:none';} ?>">
                    <input type="file"
                           class="form-control-file"
                           name="image"
                           id="image"
                           accept="image/*"
                        <?php if($tokenUpdate === null){echo 'required';} ?>
                    >
                </div>
                <br>

                <label for="propertyTypeId">Type de la propriétée :</label>
                <select id="propertyTypeId" class="form-control" name="propertyTypeId">
                    <option value="">-- Veuillez choisir un type --</option>
                    <?php foreach (getPropertyTypes() as $propertyType) : ?>
                        <option value="<?= $propertyType['id'] ?>" <?php if($tokenUpdate !== null  && $propertyDB['property_type_id'] === $propertyType['id'] ){echo 'selected';} ?> >
                            <?= $propertyType['nametype'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="sellerId">Choisir le vendeur :</label>
                <select id="sellerId" class="form-control" name="sellerId">
                    <option value="">-- Veuillez choisir un vendeur --</option>
                    <?php foreach (getSellers() as $seller) : ?>
                        <option value="<?= $seller['id'] ?>" <?php if($tokenUpdate !== null  && $propertyDB['seller_id'] === $seller['id'] ){echo 'selected';} ?> >
                            <?= $seller['firstname'] ?> <?= $seller['lastname'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <input type="submit" class="btn btn-primary" value="Valider">
            </form>
        </div>
    </section>
</main>

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
<script src="dist/app.js">
</script>
<script>
    function myFunction() {
        var checkBox = document.getElementById("myCheck");
        var text = document.getElementById("text");
        if (checkBox.checked == true){
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }
</script>
</body>

</html>