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
            <h2>Ajout d'un client</h2>
            <form name='form1' method='post' action='clients.php' >
                <label for="nom">Nom</label><input type="text" name="nom" required><br>
                <label for="prenom">Prénom</label><input type="text" name="prenom" required><br>
                <label for="email">Email</label><input type="email" name="email" required><br>
                <label for="telephone">Telephone</label><input type="text" name="telephone"><br>
                <label for="login">Login</label><input type="text" name="login" required><br>
                <label for="password">Password</label><input type="password" name="password" required><br>
                <label for="adr_ligne1">Adresse </label><input type="text" name="adr_ligne1"><br>
                <label for="adr_ligne2">Adresse</label><input type="text" name="adr_ligne2"><br>
                <label for="adr_codepostal">Code postal</label><input type="text" name="adr_codepostal"><br>
                <label for="adr_ville">Ville</label><input type="text" name="adr_ville"><br>
                <label for="adr_pays">Pays</label><input type="text" name="adr_pays"><br>
                <input type="submit" value="valider">
            </form>
        </article>

        <!-- inclure le pied de page -->
        <?php
        include ("footer.php");
        ?>
    </body>
</html>


