<?php

session_start();
if (!isset($_COOKIE['session'])){
    header("Location: admin-connexion.php");
}

?>

<?php
require '../config/config.php';
require '../models/connect.php';

$db=connection();
var_dump($db);
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
                    <h2 class="title-banner"><span class="Letter"> S</span>ettings</h2>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <form action="settings-base.php" method="post">
                <div class="form-group">
                    <label class=" mt-2" for="exampleFormControlInput1">New Password</label>
                    <input type="password" name="newPassword"  class="form-control" id="exampleFormControlInput1" placeholder="Enter New password">
                    <label class=" mt-2" for="exampleFormControlInput1">Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control" id="exampleFormControlInput1" placeholder="Enter New password">
                </div>
                <button type="submit" class="btn btn-success mb-2">Confirm</button>
            </form>

            <a href="admin.php"><button type="submit" class="btn btn-secondary mb-2">back to panel</button></a>
        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>