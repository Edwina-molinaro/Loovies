<?php
require '../config/config.php';
require '../models/connect.php';

//  insertion de la video

if (isset($_POST['name'])){
    $name=htmlspecialchars(trim($_POST['name']));
} else {
    $name = '';
}

$db = connection();




$sqlInsertCategory= 'insert INTO categorie (name) VALUES (:name)';
$reqInsertCategorie= $db->prepare($sqlInsertCategory);
$reqInsertCategorie->bindParam(':name', $name);
$reqInsertCategorie->execute();

if ($reqInsertCategorie->rowCount() == 1){
    header('Location: admin.php');
} else {
    echo 'requete KO';
}