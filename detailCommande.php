<?php
include_once ('inc/_config.php');

$idClient = isset($_SESSION["idClient"]) ? $_SESSION["idClient"] : 0;


$idCmde = $_GET["id"];

$requete = "SELECT lc.id, lc.prix, produit.intitule, auteur.nom, auteur.prenom, commande.etat, commande.prixTotal "
        . " FROM ligne_commande lc "
        . " JOIN produit ON produit.id=lc.id_produit "
        . " JOIN auteur ON auteur.id=produit.id_auteur "
        . " JOIN commande ON commande.id=lc.id_commande "
        . " WHERE id_commande = $idCmde";
//echo $requete;
$lignes = $bdd->query($requete)->fetchAll();
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
                </tr>
                <?php
                foreach ($lignes as $ligne)
                {
                    ?>
                    <tr>
                        <td><?php echo $ligne['prenom'] . ' ' . $ligne['nom']; ?></td>
                        <td><?php echo $ligne['intitule']; ?></td>
                        <td><?php echo number_format($ligne['prix'], 2); ?> €</td>

                    </tr>
                    <?php
                }
                ?>
                <tr class="total">
                    <td colspan="2">Montant total</td>
                    <td><?php echo number_format($ligne['prixTotal'], 2) ?> €</td>
                </tr>
                <tr class="total">
                    <td colspan="2">Etat de la commande</td>
                    <td>
                        <?php
                        if ($ligne['etat'] == 2)
                        {
                            echo 'payée';
                        }
                        elseif ($ligne['etat'] == 4)
                        {
                            echo ' expédiée le ' . $cmd['date_expedition'];
                        }
                        ?>
                    </td>
                </tr>
            </table>

        </article>

        <!-- inclure le pied de page -->
<?php
include ("footer.php");
?>
    </body>
</html>
