<?php 
$message="";
if (isset($_GET['err']))
{
    if ($_GET['err']==1)
    {
        $message="Veuillez vous identifier !";
    }
}
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
            <?php echo $message; ?>
            <form name="form1" method="post" action="login.php">
                <label for="login">Login</label><input type="text" name="login" required><br>
                <label for="password">Mot de passe</label><input type="password" name="password" required><br>
                <input type="submit" value="acceder">
            </form>
        </article>

        <!-- inclure le pied de page -->
        <?php
        include ("footer.php");
        ?>
    </body>
</html>

