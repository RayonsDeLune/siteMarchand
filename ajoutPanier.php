<?php

include ("inc/_config.php" );

if ($_GET)
{
    $idProduit = $_GET["id"];
    $idClient = isset($_SESSION["idClient"]) ? $_SESSION["idClient"] : 0;
    $idCmde = isset($_SESSION["idCmde"]) ? $_SESSION["idCmde"] : 0;
    
    $requete = "INSERT INTO ligne_commande (id_commande, id_produit, quantite, prix)"
            . " SELECT $idCmde, $idProduit, 1, produit.prix "
            . " FROM produit"
            . " WHERE produit.id=$idProduit";
    $result=$bdd->query($requete);
}

header("location: index.php");
