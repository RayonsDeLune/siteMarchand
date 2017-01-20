<?php
include_once ('../inc/_config.php');

if (!(isset($_SESSION['admin']) && $_SESSION['admin'] == 'OK'))
{
    header('Location: index.php?err=1');
    echo "<a href='index.php?err=1'>retour à la page de login</a>";
//    exit();
}
?>

