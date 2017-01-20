<?php
include ('testSession.php');
include_once ('../inc/_config.php');

$requete = "SELECT * FROM categorie "
        . " ORDER BY categorie.intitule";
$cats = $bdd->query($requete)->fetchAll();

$requete = "SELECT * FROM auteur "
        . "ORDER BY nom, prenom";
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
            <h2>Ajout d'un produit</h2>
            <form name='form1' method='post' action='produits.php' enctype="multipart/form-data">
                <label for="intitule">Intitule</label><input type="text" name="intitule" required><br>
                <label for="description">Description</label><textarea name='description' placeholder="saisissez ici" cols="50" rows="15"></textarea><br>
                <!--affichage de toutes les categories-->
                <label for="categorie" >Catégorie</label>
                <select name="categorie" >
                    <?php
                    foreach ($cats as $cat)
                    {
                        ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['intitule']; ?></option>

                        <?php
                    }
                    ?>
                </select><br/>
                <label for='prix'>Prix unitaire</label><input type='text' name='prix'><br/>
                <!--affichage de tous les auteurs-->
                <label for="auteur" >Auteur</label>
                <select name="auteur" >
                    <?php
                    foreach ($auteurs as $auteur)
                    {
                        ?>
                        <option value="<?php echo $auteur['id']; ?>"><?php echo $auteur['nom'] . " " . $auteur['prenom']; ?></option>

                        <?php
                    }
                    ?>
                </select><br/>
                <input type="hidden" name="MAX_FILE_SIZE" value="12345" />
                <label for="image">Image associée</label><input type="file" name="image"><br/>

                <input type="submit" value="valider">
            </form>
        </article>

        <!-- inclure le pied de page -->
        <?php
        include ("footer.php");
        ?>
    </body>
</html>
