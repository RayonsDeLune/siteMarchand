<?php

include("inc/_config.php");

$_SESSION["idClient"] = 0;
$_SESSION["pseudo"] = '';
$_SESSION["idCommande"] = 0;

header('location: index.php');
?>

