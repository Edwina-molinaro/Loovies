<?php
session_start();
require 'src/config/config.php';
require 'src/models/connect.php';

$db=connection();

// RECUPERATION CATEGORIE ?
if (isset($_POST['filter'])){
    $filter=htmlspecialchars(trim($_POST['filter']));
} else {
    $filter = '';
}

// FILTRER LES BUILDS SELON LES CATEGORIES
if ($filter == "All") {
    $sqlSelectPost="SELECT * FROM post WHERE type = 'Build'";
    $reqSelectPost=$db->prepare($sqlSelectPost);
    $reqSelectPost->execute();   
}
else
{
    $sqlSelectPost="SELECT * FROM post WHERE type = 'Build' AND categorie = :filter";
    $reqSelectPost=$db->prepare($sqlSelectPost);
    $reqSelectPost->bindParam(':filter', $filter);
    $reqSelectPost->execute();

}


// RECUPERATION DE LA TABLE CATEGORIE
$sqlSelectcategorie="SELECT distinct categorie FROM post";
$reqSelectcategorie=$db->prepare($sqlSelectcategorie);
$reqSelectcategorie->execute();

// RECUPERATION DE LA TABLE CUSTOMIZE
$sqlSelectLink="SELECT linkInstagram, linkYoutube, copyright FROM customize";
$reqSelectLink=$db->prepare($sqlSelectLink);
$reqSelectLink->execute();
$customize = $reqSelectLink->fetchObject();


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
  <link rel="stylesheet" href="public/css/main.css">
</head>
    <body>

        <header class="background">
            <nav class="navbar navbar-expand-lg  d-flex justify-content-around">
                <a class="navbar-brand" href="#"><img src="public/img/loovies.png" alt="website logo"></a>
                <ul class="navbar-nav">
                    <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="build.php">Builds <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="animations.php">Animations</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="help.php">Need Help ?</a>
                    </li>
                </ul>
            </nav>

            <div class="container-fluid d-flex justify-content-center align-items-center">
                <div class="row ">
                    <div class="col-lg-4 col-md-4 text-center">
                        <h1>Loovies</h1>
                    </div>
                    <div class="col-lg-8 col-md-8 text-center"> 
                        <p> Here you can download builds and animations. Join us on Youtube to support my work.
                        I mainly do relaxing stop motion videos and show you my new creations. I hope you will like it. :)</p>
                        <a href="<?php echo $customize->linkYoutube?>" target="_blank"><button>Join us <i class="icon-button fas fa-location-arrow"></i></button></a>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <a href="<?php echo $customize->linkYoutube?>">
                    <i class="icons-padding icons-reseaux_header fab fa-youtube"></i> 
                    </a> 
                    <a href="<?php echo $customize->linkInstagram?>">
                    <i class="icons-padding icons-reseaux_header fas fa-hashtag"></i>
                    </a>
                </div>
            </div>

        </header>

        <form action="build.php" method="POST">
            <select name="filter" class="mdb-select md-form colorful-select dropdown-primary category-build" id="select">
                <option>All</option>
                <?php while($categorie = $reqSelectcategorie->fetchObject()){ ?>
                <option><?php echo $categorie->categorie ?></option>
                <?php } ?>
            </select>
            <button type="submit">Submit</button>
        </form>

        <?php while($post = $reqSelectPost->fetchObject()){ ?>
        <form action="post-detail.php" method="POST">
        <input class="invisible" name="idpost" value=<?php echo $post->idpost ?>>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 selection_img">
                        <img name="img" src=<?php echo $post->img ?> alt="post picture">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 build-selection_img">
                        <h2  name="titre"> <?php echo $post->titre ?></h2>
                        <p  name="text"><?php echo $post->text ?></p>
                        <button type="submit">Download</button>
                    </div>
                </div>
            </div>
        </form>
        <?php } ?>
        

        <section class="mt-5 footer-background d-flex justify-content-center align-items-center flex-column">
            <div class="row">
                <div class="col-12 ">
                    <h2>Connect With Me</h2>   
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex align-items-center">
                    <a href="<?php echo $customize->linkYoutube?>"><i class="icons-reseaux_header fab fa-youtube"></i></a>
                    <a href="<?php echo $customize->linkInstagram?>"><i class="icons-reseaux_header fas fa-hashtag"></i></a>
                </div>
            </div>
        </section>
        
        <footer>
            <div class="container-fluid bg-dark">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center align-items-center flex-column navbar-brand">
                        <img src="public/img/loovies.png" alt="website logo">
                        <a href="<?php echo $customize->linkYoutube?>"><i class="icons-reseaux_header fab fa-youtube"></i></a>
                        <a href="<?php echo $customize->linkInstagram?>"><i class="icons-reseaux_header fas fa-hashtag"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center bg-dark text-secondary">
                <!-- //// AFFICHAGE DE LA TABLE CUSTOMIZE POUR LE COPYRIGHT //// -->
                <h4><?php echo $customize->copyright?></h4>
            </div>
        </footer>
        

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
    </html>