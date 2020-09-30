<?php

require '../config/config.php';
require '../models/connect.php';

$idpost=$_COOKIE["update"];

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

$db = connection();

$sqlInsertPost= "UPDATE post SET titre = :titre, categorie = :categorie, type = :type, text = :text, link = :link, img = :img WHERE idpost = :idpost";
$reqInsertPost= $db->prepare($sqlInsertPost);
$reqInsertPost->bindParam(':titre', $titre);
$reqInsertPost->bindParam(':categorie', $categorie);
$reqInsertPost->bindParam(':type', $type);
$reqInsertPost->bindParam(':text', $text);
$reqInsertPost->bindParam(':link', $link);
$reqInsertPost->bindParam(':img', $img);
$reqInsertPost->bindValue(':idpost', $idpost);
$reqInsertPost->execute();


if ($reqInsertPost->rowCount() == 1){
    header('Location: admin.php');
} else {
    echo 'error';
}