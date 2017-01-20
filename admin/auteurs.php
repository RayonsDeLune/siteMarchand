<?php
include ('testSession.php');
include_once ('../inc/_config.php');

if ($_POST)
{
    $nom = addslashes($_POST["nom"]);
    $prenom = addslashes($_POST["prenom"]);

    $requete = "INSERT INTO auteur(nom, prenom)"
            . " VALUES ('$nom','$prenom')";
    $result = $bdd->query($requete);
}

$requete = "SELECT auteur.* FROM auteur "
        . " ORDER BY auteur.nom, auteur.prenom";
$auteurs = $bdd->query($requete)->fetchAll();
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
            <a href="ajoutAuteur.php">Ajouter un auteur</a>
            <!--affichage de toutes les catégories-->
            <table>
                <tr>
                    <th >Auteurs</th>

                </tr>
                <?php
                foreach ($auteurs as $auteur)
                {
                    ?>
                    <tr>
                        <td><?php echo $auteur['prenom']; ?></td>
                        <td><?php echo $auteur['nom']; ?></td>
                        <td><a href="modifAuteur.php?id=<?php echo $auteur['id']; ?>">modifier</a></td>
                        <td><a href="supprAuteur.php?id=<?php echo $auteur['id']; ?>">supprimer</a></td>
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

