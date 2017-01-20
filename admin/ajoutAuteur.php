<?php
include ('testSession.php');
include_once ('../inc/_config.php');


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
            <h2>Ajout d'un auteur</h2>
            <form name='form1' method='post' action='auteurs.php' >
                <label for="nom">nom</label><input type="text" name="nom" required><br>
                <label for="prenom">prenom</label><input type="text" name="prenom" required><br>
                <input type="submit" value="valider">
            </form>
        </article>

        <!-- inclure le pied de page -->
        <?php
        include ("footer.php");
        ?>
    </body>
</html>
