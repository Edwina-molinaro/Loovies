<?php

require '../config/config.php';
require '../models/connect.php';

if (isset($_POST['titre'])){
    $titre=htmlspecialchars(trim($_POST['titre']));
} else {
    $titre = '';
}

if (isset($_POST['categorie'])){
    $categorie=htmlspecialchars(trim($_POST['categorie']));
} else {
    $categorie = '';
}

if (isset($_POST['type'])){
    $type=htmlspecialchars(trim($_POST['type']));
} else {
    $type = '';
}


if (isset($_POST['text'])){
    $text=htmlspecialchars(trim($_POST['text']));
} else {
    $text = '';
}

if (isset($_POST['link'])){
    $link=htmlspecialchars(trim($_POST['link']));
} else {
    $link = '';
}

if (isset($_POST['img'])){
    $img=htmlspecialchars(trim($_POST['img']));
} else {
    $img = '';
}

if (isset($_POST['linkYoutube'])){
    $linkYoutube=htmlspecialchars(trim($_POST['linkYoutube']));
} else {
    $linkYoutube = '';
}

if (isset($_POST['linkDownload'])){
    $linkDownload=htmlspecialchars(trim($_POST['linkDownload']));
} else {
    $linkDownload = '';
}


if (isset($_POST['User_idUser'])){
    $User_idUser=htmlspecialchars(trim($_POST['User_idUser']));
} else {
    $User_idUser = '';
}


$db = connection();



$login=$_COOKIE["session"];
$sqlSelectId="SELECT idUser FROM user WHERE login=:login";
$reqSelectId=$db->prepare($sqlSelectId);
$reqSelectId->bindParam(':login', $_COOKIE["session"]);
$reqSelectId->execute();
$var=$reqSelectId->fetchObject();



$sqlInsertPost= 'insert INTO post (titre, categorie, type, text, link, img, linkYoutube, linkDownload, User_idUser) VALUES (:titre, :categorie, :type, :text, :link, :img, :linkYoutube, :linkDownload, :User_idUser)';
$reqInsertPost= $db->prepare($sqlInsertPost);
//  PREPARATION DES REQUETES
$reqInsertPost->bindParam(':titre', $titre);
$reqInsertPost->bindParam(':categorie', $categorie);
$reqInsertPost->bindParam(':type', $type);
$reqInsertPost->bindParam(':text', $text);
$reqInsertPost->bindParam(':link', $link);
$reqInsertPost->bindParam(':img', $img);
$reqInsertPost->bindParam(':linkYoutube', $linkYoutube);
$reqInsertPost->bindParam(':linkDownload', $linkDownload);
$reqInsertPost->bindParam(':User_idUser', $var->idUser);
$reqInsertPost->execute();


if ($reqInsertPost->rowCount() == 1){
    header("Location: admin.php");
} else {
    echo 'error';
}