<?php
require '../config/config.php';
require '../models/connect.php';

//  DELETE POST
if (isset($_POST['post'])){
    $post=htmlspecialchars(trim($_POST['post']));
} else {
    $post = '';
}


$db = connection();

var_dump($post);

//  RECUPERATION DES POST
$sqlSelectPostDelete= "DELETE FROM post WHERE titre = :titre";
$reqSelectPostDelete= $db->prepare($sqlSelectPostDelete);
//  PREPARATION DES REQUETES
$reqSelectPostDelete->bindParam(':titre', $post);
$reqSelectPostDelete->execute();


    header('Location: admin.php');
