<?php
require '../config/config.php';
require '../models/connect.php';

// POUR EMPECHER LES UTILISATEURS D'ACCEDER AU TABLEAU DE BORD //
session_start();
if (!isset($_COOKIE['session']))
    header("Location: admin-connexion.php");

$db=connection();

// RECUPERATION DE LA TABLE CATEGORIE
$sqlSelectCategorie="SELECT * FROM categorie";
$reqSelectCategorie=$db->prepare($sqlSelectCategorie);
$reqSelectCategorie->execute();

// RECUPERATION DE LA TABLE POST
$sqlSelectPost="SELECT * FROM post WHERE type = 'Animation'";
$reqSelectPost=$db->prepare($sqlSelectPost);
$reqSelectPost->execute();

// CHANGEMENT DU NOM DE LA REQUETE DE RECUPERATION DE LA TABLE POST POUR LES SUPPRIMER 
$sqlSelectPostDelete="SELECT * FROM post WHERE type = 'Animation'";
$reqSelectPostDelete=$db->prepare($sqlSelectPostDelete);
$reqSelectPostDelete->execute();

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Loovies</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"> 
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&family=Dancing+Script&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../public/css/main.css">
</head>
    <body>

        <div class="container-20 section-background d-flex justify-content-center align-items-center ">
            <div class="row">
                <div class="col-12">
                    <h2 class="title-banner"><span class="Letter"> A</span>nimation Panel</h2>
                </div>
            </div>
        </div>

         <!-- //// REQUETE SLQ INSERT POUR LA PAGE 'ANIMATION.PHP' //// -->
        <div class="container mt-5">
            <form action="animation-panel_base.php" method="POST">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title Animation</label>
                    <input type="title" name="titre" class="form-control" id="exampleFormControlInput1" placeholder="Cute Animation">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Type</label>
                    <select name="type" class="categorie form-control" id="exampleFormControlSelect1">
                    <option>Build</option>
                    <option>Animation</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Img</label>
                    <input type="text" name="img" class="form-control" id="exampleFormControlInput1" placeholder="Path img">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Text Description</label>
                    <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Link Youtube Video </label>
                    <input type="text" name="linkYoutube" class="form-control" id="exampleFormControlInput1" placeholder="Link">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Link Download</label>
                    <input type="text" name="linkDownload" class="form-control" id="exampleFormControlInput1" placeholder="Link">
                </div>

                <button type="submit" class="btn btn-success mb-2">Confirm</button>
            </form>


            <!-- //// REQUETE SLQ UPDATE POUR LA PAGE 'ANIMATION.PHP' //// -->
            <h2 class="text-center mt-5">Modify Animation</h1>       
            <form action="animation-modify.php" method="POST">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Animations</label>
                    <select class="form-control" name="post" id="exampleFormControlSelect1">
                    <?php while($post = $reqSelectPost->fetchObject()){ ?>  
                    <option><?php echo $post->titre ?></option>
                    <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-success mb-2">modify</button>
                </div>   
            </form>

            <!-- //// REQUETE SLQ DELETE POUR LA PAGE 'ANIMATION.PHP' //// -->
            <h2 class="text-center mt-5">Delete Animation</h1>       
            <form action="post-delete_base.php" method="POST">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Animations</label>
                    <select class="form-control" name="post" id="exampleFormControlSelect1">
                    <?php while($post = $reqSelectPostDelete->fetchObject()){ ?>  
                    <option><?php echo $post->titre ?></option>
                    <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-success mb-2">delete</button>
                </div>   

            </form>
           
            <a href="admin.php"><button type="submit" class="btn btn-secondary mb-2">back to panel</button></a>

        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>