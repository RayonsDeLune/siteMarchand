<?php

include ("inc/_config.php" );

$idClient = isset($_SESSION["idClient"]) ? $_SESSION["idClient"] : 0;
$idCmde = isset($_SESSION["idCmde"]) ? $_SESSION["idCmde"] : 0;

$requete = "SELECT sum(prix) as mttCmde "
            . "FROM ligne_commande "
            . " GROUP BY id_commande "
            . " HAVING id_commande=$idCmde";
    $result=$bdd->query($requete)->fetch();
    $prixTotal=$result['mttCmde'];

$requete = "UPDATE commande SET etat='2', date=NOW(), prix_total=$prixTotal WHERE id=$idCmde";
$result = $bdd->query($requete);
// il faut lui créer une nouvelle commande à l'état 1
$requete = "INSERT INTO commande (id_client, etat) VALUES ($idClient, 1)";
$result = $bdd->query($requete);
$requete = "SELECT id FROM commande WHERE etat=1 AND id_client=$idClient";
$result = $bdd->query($requete)->fetch();
$_SESSION["idCmde"] = $result["id"];

header("location: index.php");
