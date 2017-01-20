<?php
include ('testSession.php');
include_once ('../inc/_config.php');

if ($_POST)
{
    $intitule = addslashes($_POST["intitule"]);

    $requete = "INSERT INTO categorie(intitule)"
            . " VALUES ('$intitule')";
    $result = $bdd->query($requete);
}

$requete = "SELECT categorie.* FROM categorie "
        . " ORDER BY categorie.intitule";
$cats = $bdd->query($requete)->fetchAll();
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
            <a href="ajoutCategorie.php">Ajouter une catégorie</a>
            <!--affichage de toutes les catégories-->
            <table>
                <tr>
                    <th>categorie</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                foreach ($cats as $cat)
                {
                    ?>
                    <tr>
                        <td><?php echo $cat['intitule']; ?></td>
                        <td><a href="modifCategorie.php?id=<?php echo $cat['id']; ?>">modifier</a></td>
                        <td><a href="supprCategorie.php?id=<?php echo $cat['id']; ?>">supprimer</a></td>
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
