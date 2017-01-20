
<?php
include ("inc/_config.php" );

if ($_POST)
{
    $login = $_POST["login"];
    $password = $_POST["password"];

// recherche dans la base
    $requete = "SELECT client.id FROM client "
            . " WHERE login='$login' AND password='$password'";
    $result = $bdd->query($requete)->fetch();


//echo "result";
//var_dump($result);

    $message = "";
    if ($result)
    {
//        $result = $result->fetch();
        $_SESSION["idClient"] = $result["id"];
        $_SESSION["pseudo"] = $login;
        $idClient = $_SESSION["idClient"];
        // on va chercher aussi l'id commande
        
        $requete = "SELECT id FROM commande WHERE etat=1 AND id_client=$idClient";
        $result = $bdd->query($requete)->fetch();
        
        if ($result)
        {
            // alors on a une commande non payée càd un panier
            $_SESSION["idCmde"]=$result["id"];
        }
        else
        {
            // ici on n'a pas de commande non payée il faut en créer une
            $requete="INSERT INTO commande (id_client, etat) VALUES ($idClient, 1)";
            $result=$bdd->query($requete);
            $requete = "SELECT id FROM commande WHERE etat=1 AND id_client=$idClient";
            $result = $bdd->query($requete)->fetch();
            $_SESSION["idCmde"]=$result["id"];
        }

        header("location: rechercheProduit.php");
    }
    else
    {
        $message = "Login / password non trouvé";
    }
}

if ($_GET)
{
    $msg=$_GET["msg"];
    if ($msg==1)
    {
        $message="Vous etes bien enregistré. Veuillez maintenant vous identifier.";
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
        <link href="inc/css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <!-- inclure le menu -->
<?php
include ("menu.php" );
?>
        <article>
            <h2>Identification</h2>
            <div class="erreur"><?php echo $message; ?></div>
            <form name="login" method="post">
                <label for="login">Login</label>
                <input type="text" name="login" required>
                <br/>
                <label for="password" required>Password</label>
                <input type="password" name="password">
                <br />
                <input type="submit" value="Valider">

            </form>
            <a href="inscription.php">s'inscrire</a>
        </article>

        <!-- inclure le pied de page -->
<?php
include ("footer.php");
?>
    </body>
</html>


