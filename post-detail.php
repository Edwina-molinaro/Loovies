<?php
require 'src/config/config.php';
require 'src/models/connect.php';


$db=connection();


if (isset($_POST['idpost'])){
    $idpost=htmlspecialchars(trim($_POST['idpost']));
} else {
    $idpost = '';
}

$sqlSelectPost="SELECT * FROM post WHERE idpost = :idpost";
$reqSelectPost=$db->prepare($sqlSelectPost);
$reqSelectPost->bindParam(':idpost', $idpost);
$reqSelectPost->execute();
$post = $reqSelectPost->fetchObject();


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

        <header>
            <nav class="navbar navbar-expand-lg  d-flex justify-content-around">
                <a class="navbar-brand" href="#"><img src="public/img/loovies.png" alt=""></a>
                <ul class="navbar-nav">
                    <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="build.php">Builds</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="animations.php">Animations</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="help.php">Need Help ?</a>
                    </li>
                </ul>
            </nav>
        </header>

        <hr>

        <section class="container spacer-top">
            <div class="row">
                <div class="col-12 text-center selection_img">
                    <img src=<?php echo $post->img ?> alt="">
                </div>
            </div>

            <div class="text-center mt-5">
                <h1><?php echo $post->titre ?></h1>
            </div>

            <div class="text-center spacer-top">
                <p><?php echo $post->text ?></p>
            </div>

            <div class="text-center mt-5">
                <a href="<?php echo $post->linkYoutube ?>"><button>See video <i class="icon-button fas fa-video"></i></button></a>
            </div>

            <div class="text-center mt-5">
                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet.</li>
                    <li>Lorem ipsum dolor sit.</li>
                </ul>
            </div>

            <div class="text-center mt-5 spacer-bottom">
            <a href="<?php echo $post->linkDownload ?>"><button>Download <i class="icon-button fas fa-download"></i></button></a>
            </div>  
        </section>

        <section class="footer-background d-flex justify-content-center align-items-center flex-column">
            <div class="row">
                <div class="col-12 ">
                    <h2>Connect With Me</h2>   
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex align-items-center">
                    <i class="icons-reseaux_header fab fa-youtube"></i>
                    <i class="icons-reseaux_header fas fa-hashtag"></i>
                </div>
            </div>
        </section>
        
        <footer>
            <div class="container-fluid bg-dark">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center align-items-center flex-column navbar-brand">
                        <img src="public/img/loovies.png" alt="">
                        <i class="icons-reseaux_header fab fa-youtube"></i>
                        <i class="icons-reseaux_header fas fa-hashtag"></i>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">

                    </div>
                </div>
            </div>
        </footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>