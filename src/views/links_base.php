<?php

require '../config/config.php';
require '../models/connect.php';

if (isset($_POST['linkYoutube'])){
    $linkYoutube=htmlspecialchars(trim($_POST['linkYoutube']));
} else {
    $linkYoutube = '';
}

if (isset($_POST['linkInstagram'])){
    $linkInstagram=htmlspecialchars(trim($_POST['linkInstagram']));
} else {
    $linkInstagram = '';
}

if (isset($_POST['copyright'])){
    $copyright=htmlspecialchars(trim($_POST['copyright']));
} else {
    $copyright = '';
}


$db = connection();

$sqlInsertPost= "UPDATE customize SET linkYoutube = :linkYoutube, linkInstagram = :linkInstagram, copyright = :copyright";
$reqInsertPost= $db->prepare($sqlInsertPost);
$reqInsertPost->bindParam(':linkYoutube', $linkYoutube);
$reqInsertPost->bindParam(':linkInstagram', $linkInstagram);
$reqInsertPost->bindParam(':copyright', $copyright);
$reqInsertPost->execute();


if ($reqInsertPost->rowCount() == 1){
    header('Location: admin.php');
} else {
    echo 'error';
}