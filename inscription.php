<?php
include_once ('inc/_config.php');

$nom = "";
$prenom = "";
$email = "";
$telephone = "";
$login = "";
$password = "";

$adr_ligne1 = "";
$adr_ligne2 = "";
$adr_codepostal = "";
$adr_ville = "";
$adr_pays = "";

if ($_POST)
{
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $login = $_POST['login'];
    $password = $_POST['password'];

    $adr_ligne1 = $_POST['adr_ligne1'];
    $adr_ligne2 = $_POST['adr_ligne2'];
    $adr_codepostal = $_POST['adr_codepostal'];
    $adr_ville = $_POST['adr_ville'];
    $adr_pays = $_POST['adr_pays'];

    // on verifie que le couple pseudo / email n'existe pas déjà
    $requete = "SELECT * FROM client "
            . " WHERE login=\'$login\' AND email=\'$email\' ";
    $result = $bdd->query($requete);

    if ($result)
    {
        $message = " Ce login existe déjà pour cette adresse mail.";
    }
    else
    {
        // le client n'existe pas déjà en base, on l'ajoute
        $nom = addslashes($nom);
        $prenom = addslashes($prenom);
        $email = addslashes($email);
        $telephone = addslashes($telephone);
        $login = addslashes($login);
        $password = addslashes($password);
        $adr_ligne1 = addslashes($adr_ligne1);
        $adr_ligne2 = addslashes($adr_ligne2);
        $adr_codepostal = addslashes($adr_codepostal);
        $adr_ville = addslashes($adr_ville);
        $adr_pays = addslashes($adr_pays);

        $requete = "INSERT INTO client(nom, prenom, email, telephone, login, password, "
                . "adr_ligne1, adr_ligne2, adr_codepostal, adr_ville, adr_pays)"
                . " VALUES ('$nom', '$prenom', '$email', '$telephone', '$login', '$password',"
                . " '$adr_ligne1', '$adr_ligne2', '$adr_codepostal', '$adr_ville', '$adr_pays')";
        $result = $bdd->query($requete);
        
        // on redirige vers la page de login
        header("location: login.php?msg=1");
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
            <h2>Inscription</h2>
            <form name='form1' method='post' action='' >
                <table width="80%">
                    <tr>
                        <td>
                            <label for="nom">Nom</label><input type="text" name="nom" required size="30" value="<?php echo $nom ?>"><br>
                            <label for="prenom">Prénom</label><input type="text" name="prenom" required size="30" value="<?php echo $prenom ?>"><br>
                            <label for="email">Email</label><input type="email" name="email" required size="30" value="<?php echo $email ?>"><br>
                            <label for="telephone">Telephone</label><input type="text" name="telephone"  value="<?php echo $telephone ?>"><br>
                            <label for="login">Login</label><input type="text" name="login" required  value="<?php echo $login ?>"><br>
                            <label for="password">Password</label><input type="password" name="password" required><br>
                        </td>
                        <td>
                            <fieldset>
                                <legend>Adresse</legend>
                                <label for="adr_ligne1">Rue 1 </label><input type="text" name="adr_ligne1" size="30"  value="<?php echo $adr_ligne1 ?>"><br>
                                <label for="adr_ligne2">Rue 2</label><input type="text" name="adr_ligne2" size="30" value="<?php echo $adr_ligne2 ?>"><br>
                                <label for="adr_codepostal">Code postal</label><input type="text" name="adr_codepostal"  value="<?php echo $adr_codepostal ?>"><br>
                                <label for="adr_ville">Ville</label><input type="text" name="adr_ville" size="30"  value="<?php echo $adr_ville ?>"><br>
                                <label for="adr_pays">Pays</label><input type="text" name="adr_pays" size="30"  value="<?php echo $adr_pays ?>"><br>
                            </fieldset>
                        </td>
                    </tr>
                </table>
                <input type="submit" value="valider">
            </form>
        </article>

        <!-- inclure le pied de page -->
<?php
include ("footer.php");
?>
    </body>
</html>



