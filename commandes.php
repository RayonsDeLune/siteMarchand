<?php
include_once ('inc/_config.php');

$idClient = isset($_SESSION["idClient"]) ? $_SESSION["idClient"] : 0;

$requete = "SELECT commande.*, count(ligne_commande.id) as nbArticles, SUM(ligne_commande.prix) as prixTotal "
        . " FROM commande "
        . " JOIN ligne_commande ON ligne_commande.id_commande = commande.id "
        . " GROUP BY ligne_commande.id_commande "
        . " HAVING etat > 1 AND commande.id_client=$idClient "
        . " ORDER BY etat, date";
//echo $requete;
$cmdes = $bdd->query($requete)->fetchAll();
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
            <!--affichage de tous les produits-->
            <table>
                <tr>
                    <th>n° commande</th>
                    <th>date</th>
                    <th>nb articles</th>
                    <th>prix total</th>
                    <th>état</th>
                </tr>
                <?php
                foreach ($cmdes as $cmd)
                {
                    ?>
                    <tr>
                        <td><a href="detailCommande.php?id=<?php echo $cmd['id']; ?>" alt="detail de la commande"><?php echo $cmd['id']; ?></a></td>
                        <td><a href="detailCommande.php?id=<?php echo $cmd['id']; ?>" alt="detail de la commande"><?php echo $cmd['date']; ?></a></td>
                        <td><?php echo $cmd['nbArticles']; ?></td>
                        <td><?php echo number_format($cmd['prixTotal'],2); ?> €</td>
                        <?php
                        if ($cmd['etat'] == 2)
                        {
                            ?>
                            <td> payée</td>
                            <?php
                        }
                        elseif ($cmd['etat'] == 4)
                        {
                            ?>
                            <td> expédiée le <?php echo $cmd['date_expedition']; ?></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </article>

        <!-- inclure le pied de page -->
        <?php
        include ("footer.php");
        ?>
    </body>
</html>


