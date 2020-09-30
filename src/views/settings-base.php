<?php
require '../config/config.php';
require '../models/connect.php';

//  insertion de l'utilisateur et de son pass hashé

if (isset($_POST['newPassword'])){
    $newPassword=htmlspecialchars(trim($_POST['newPassword']));
} else {
    $newPassword = '';
}

if (isset($_POST['confirmPassword'])){
    $confirmPassword=htmlspecialchars(trim($_POST['confirmPassword']));
} else {
    $confirmPassword = '';
}

//$pass_hash = password_hash($pass, PASSWORD_BCRYPT);
$password_hash = hash('sha512', $newPassword);


$db = connection();

if ($newPassword == $confirmPassword)
{
    $sqlUpdateUser= "UPDATE user SET password = :newPassword";
    $reqUpdateUser= $db->prepare($sqlUpdateUser);
    $reqUpdateUser->bindParam(':newPassword', $password_hash);
    $reqUpdateUser->execute();

} 
else 
{
    echo 'doesnt match';
}

if ($reqUpdateUser->rowCount() == 1){
    header('Location: admin.php');
} else {
    echo 'requete KO';
}
