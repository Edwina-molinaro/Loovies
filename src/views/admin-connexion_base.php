<?php
session_start(); 
require '../config/config.php';
require '../models/connect.php';


//  récuperation de l'utilisateur et de son pass hashé
if (isset($_POST['login'])){
    $login=htmlspecialchars(trim($_POST['login']));
} else {
    $login = '';
}

// CREATION DU COOKIE
setcookie('session', $login, time() + 3600,  '/'); 

if (isset($_POST['password'])){
    $password=htmlspecialchars(trim($_POST['password']));
} else {
    $password = '';
}

$db = connection();

//$pass_hash = password_hash($password, PASSWORD_BCRYPT);
$password_hash = hash('sha512', $password);

$sqlSelectUser='SELECT login, password FROM user WHERE login = :login';
$reqSelectUser=$db->prepare($sqlSelectUser);
//  PREPARATION DES REQUETES
$reqSelectUser->bindParam(':login', $login, PDO::PARAM_STR, 45);
$reqSelectUser->execute();
$resultat=$reqSelectUser->fetchObject();

//  COMPARAISON DES MOTS DE PASSE HASHE/CHIFFRE
$isPasswordCorrect=hash_equals($password_hash, $resultat->password);

  if (!$resultat)
  {
      echo 'Mauvais identifiant ou mot de passe !';
  }
  else
  {
      if ($isPasswordCorrect) {
        session_start();
          header('location:admin.php');
      }
      else {
          echo 'Mauvais identifiant ou mot de passe !';
      }
  }
