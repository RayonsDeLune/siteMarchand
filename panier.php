<?php
include_once ('inc/_config.php');

$idClient = isset($_SESSION["idClient"]) ? $_SESSION["idClient"] : 0;
$idCmde = isset($_SESSION["idCmde"]) ? $_SESSION["idCmde"] : 0;

if ($_GET)
{
    $idLigne=$_GET["id"];
    $requete = "DELETE FROM ligne_commande WHERE id=$idLigne";
    echo $requete;
    $result=$bdd->query($requete);
}

$requete = "SELECT lc.id, lc.prix, produit.intitule, auteur.nom, auteur.prenom"
        . " FROM ligne_commande lc "
        . " JOIN produit ON produit.id=lc.id_produit "
        . " JOIN auteur ON auteur.id=produit.id_auteur "
        . " WHERE id_commande = $idCmde";
//echo $requete;
$lignes=$bdd->query($requete)->fetchAll();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="inc/css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <!-- inclure le menu -->
        <?php
        include ("menu.php" );
        ?>
        <article>
            <br>
            <table >
                <tr>
                    <th>Auteur</th>
                    <th>Titre</th>
                    <th>Prix</th>
                    <th></th>
                </tr>
                <?php
                foreach ($lignes as $ligne)
                    
                {
                    ?>
                    <tr>
                        <td><?php echo $ligne['prenom'].' '.$ligne['nom']; ?></td>
                        <td><?php echo $ligne['intitule']; ?></td>
                        <td><?php echo number_format($ligne['prix'],2); ?> €</td>
                        <td><a href="panier.php?id=<?php echo $ligne['id']; ?>">supprimer</a></td>
                    </tr>
                    <?php
                }
                ?>
                    <tr class="total">
                        <td colspan="2">Montant total</td>
                        <td><?php echo number_format($mttCmde, 2) ?> €</td>
                        <td></td>
                    </tr>
            </table>
            <input type="button" value="Payer la commande" onclick='document.location.href="payer.php"'>
        </article>

        <!-- inclure le pied de page -->
        <?php
        include ("footer.php");
        ?>
    </body>
</html>
