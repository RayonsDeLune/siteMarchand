<?php

/*
 * page de traitement du login
 */
$login = $_POST['login'];
$password = $_POST['password'];

session_start();

if (!(strcasecmp($login, 'Admin') == 0 && strcasecmp($password, 'Admin') == 0 ))
{
    // l'utilisateur ne devrait pas être là
    $_SESSION['admin'] = 'NON';
    header('Location: index.php?err=1');
    echo "<a href='index.php?err=1'>retour à la page de login</a>";
}
else
{
    // l'utilisateur est bien admin
    $_SESSION['admin'] = 'OK';
    header('Location: produits.php');
//    echo "<script> document.location.href='produits.php'; </script>";
    echo "<a href='produits.php'>voir la page des produits</a>";
}
?>
