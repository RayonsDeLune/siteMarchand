<?php
include ('testSession.php');
include_once ('../inc/_config.php');

if ($_GET)
{
    $idCmde = $_GET["id"];

    $requete = "UPDATE commande SET etat=4, date_expedition=NOW() WHERE id=$idCmde";
    $result = $bdd->query($requete);
}

$requete = "SELECT commande.*, client.nom, client.prenom , count(ligne_commande.id) as nbArticles, SUM(ligne_commande.prix) as prixTotal "
        . " FROM commande "
        . " JOIN client ON client.id=commande.id_client "
        . " JOIN ligne_commande ON ligne_commande.id_commande = commande.id "
        . " GROUP BY ligne_commande.id_commande "
        . " HAVING etat > 1 "
        . " ORDER BY etat, date, nom, prenom";
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
        <link href="../inc/css/styles.css" rel="stylesheet" type="text/css"/>
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
                    <th>nom</th>
                    <th>prénom</th>
                    <th>état</th>
                    <th>nb articles</th>
                    <th>prix total</th>
                    <th></th>
                </tr>
                <?php
                foreach ($cmdes as $cmd)
                {
                    ?>
                    <tr>
                        <td><?php echo $cmd['id']; ?></td>
                        <td><?php echo $cmd['date']; ?></td>
                        <td><?php echo $cmd['nom']; ?></td>
                        <td><?php echo $cmd['prenom']; ?></td>
                        <?php
                        switch ($cmd['etat'])
                        {
                            case 2 : 
                                echo '<td>payée</td>';
                                break;
                            case 4 :
                                echo '<td>expédiée le '.$cmd['date_expedition'].'</td>';
                                break;
                            
                        }
                        ?>
                        <td><?php echo $cmd['nbArticles']; ?></td>
                        <td><?php echo number_format($cmd['prixTotal'],2); ?> €</td>
                        <?php
                        if ($cmd['etat'] == 2)
                        {
                            ?>
                            <td><a href="commandes.php?id=<?php echo $cmd['id']; ?>">expedier</a></td>
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


