<?php
require 'src/config/config.php';
require 'src/models/connect.php';

$db=connection();   

// Problème traduction " en &quot; à cause du xml. Utilisation regexp_replace pour réécriture. Utilisation \ caractère d'échapement avant " pour annuler l'effet de " sur la ligne de code
$sqlSelectPost="SELECT regexp_replace(link, '\&quot;','\"') as link, titre FROM post WHERE idpost = (SELECT MAX(idpost) FROM post)";
$reqSelectPost=$db->prepare($sqlSelectPost);
$reqSelectPost->execute();
$post = $reqSelectPost->fetchObject();

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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
  integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"> 
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&family=Dancing+Script&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="public/css/main.css">
</head>
    <body>

        <!-- HEADER -->
        <header class="background">
        <!-- NAV -->
            <nav class="navbar navbar-expand-lg  d-flex justify-content-around"> 
                <a class="navbar-brand" href="#"><img src="public/img/loovies.png" alt="Website logo"></a>
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
            <!-- NAV END -->

            <div class="container-fluid d-flex justify-content-center align-items-center">
                <div class="row ">
                    <div class="col-lg-4 col-md-4 text-center">
                        <h1 id="effect"></h1>
                    </div>
                    <div class="col-lg-8 col-md-8 text-center"> 
                        <p> Here you can download builds and animations. Join us on Youtube to support my work.
                        I mainly do relaxing stop motion videos and show you my new creations. I hope you will like it. :)</p>
                        <!-- //// AFFICHAGE DE LA TABLE CUSTOMIZE POUR LE LIEN YOUTUBE //// -->
                        <a href="<?php echo $customize->linkYoutube?>" target="_blank"><button>Join us <i class="icon-button fas fa-location-arrow"></i></button></a>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <!-- //// AFFICHAGE DE LA TABLE CUSTOMIZE POUR LE LIEN YOUTUBE //// -->
                    <a href="<?php echo $customize->linkYoutube?>">
                    <i class="icons-padding icons-reseaux_header fab fa-youtube"></i> 
                    </a> 
                    <!-- //// AFFICHAGE DE LA TABLE CUSTOMIZE POUR LE LIEN INSTAGRAM //// -->
                    <a href="<?php echo $customize->linkInstagram?>">
                    <i class="icons-padding icons-reseaux_header fas fa-hashtag"></i>
                    </a>
                </div>
            </div>

        </header>
        <!-- HEADER END -->

        <main class="section-background">
            <div class="row">
                <div class="col-12 text-center title-cards">
                    <h2>Animations</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center text-title">
                    <p>Some animations that you can browse.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center button-cards">
                <a href="animations.php"><button>All Animations <i class="icon-button fas fa-caret-right"></i></button></a>
                </div>
            </div>

            <div class="container">
                <div class="row section-cards text-center">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <img src="public/img/anim1.jpg" alt="image couple animation sims 4">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <img src="public/img/anim2.jpg" alt="image pack animation sims 4">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <img src="public/img/anim3.jpg" alt="image protest animation sims 4">
                    </div>
                </div>
            </div>
        </main>

        <section class="section">
            <div class="row">
                <div class="col-12 title-section">
                    <h2>Builds</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center flex-column">
                    <h3>Some Builds That You Can Download</h3>
                    <a href="build.php"><button>See More <i class="icon-button fas fa-caret-right"></i></button></a>
                </div>
                <div class="mt-5 col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center section-img">
                    <img src="public/img/japan.jpg" alt="image build sims 4 - japan coffee shop">
                </div>
            </div>
        </section>

        <!-- //// AFFICHAGE DE LA TABLE POST //// -->
        <section class=" mt-5 section">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Last video</h2>
                </div>
                <div class="col-12 text-center">
                    <h3><?php echo $post->titre ?></h3>
                </div>
                <div class="mt-5 col-lg-12 col-md-12 text-center">
                <iframe <?php echo $post->link ?>></iframe>
                </div>
                <div class=" mt-5 col-12 text-center">
                    <button>see more</button>
                </div>
            </div>
        </section>

        <section class="section section-background">
            <div class="row">
                <div class="col-12 title-section">
                    <h2>Need Help ?</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center flex-column">
                    <h3>How To Install My Content</h3>
                    <a href="help.php"><button>See More</button></a>
                </div>
                <div class="mt-5 col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center section-img">
                    <img src="public/img/help.png" alt="image sims 4">
                </div>
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
                    <!-- //// AFFICHAGE DE LA TABLE CUSTOMIZE POUR LES LIENS //// -->
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
                        <!-- //// AFFICHAGE DE LA TABLE CUSTOMIZE POUR LES LIENS //// -->
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
        
        <script src="public/js/typed.min.js"></script>
        <script src="public/js/typed.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" 
        crossorigin="anonymous"></script>
    </body>
</html>