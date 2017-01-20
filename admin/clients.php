<?php
include ('testSession.php');
include_once ('../inc/_config.php');

if ($_POST)
{
    $nom = addslashes($_POST["nom"]);
    $prenom = addslashes($_POST["prenom"]);
    $email = addslashes($_POST["email"]);
    $telephone = addslashes($_POST["telephone"]);
    $login = addslashes($_POST["login"]);
    $password = addslashes($_POST["password"]);
    $adr_ligne1 = addslashes($_POST["adr_ligne1"]);
    $adr_ligne2 = addslashes($_POST["adr_ligne2"]);
    $adr_codepostal = addslashes($_POST["adr_codepostal"]);
    $adr_ville = addslashes($_POST["adr_ville"]);
    $adr_pays = addslashes($_POST["adr_pays"]);

    $requete = "INSERT INTO client(nom, prenom, email, telephone, login, password, "
            . "adr_ligne1, adr_ligne2, adr_codepostal, adr_ville, adr_pays)"
            . " VALUES ('$nom', '$prenom', '$email', '$telephone', '$login', '$password',"
            . " '$adr_ligne1', '$adr_ligne2', '$adr_codepostal', '$adr_ville', '$adr_pays')";
    $result = $bdd->query($requete);
}

$requete = "SELECT * FROM client "
        . " ORDER BY nom, prenom";
$clients = $bdd->query($requete)->fetchAll();
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
            <a href="ajoutClient.php">Ajouter un client</a>
            <!--affichage de tous les produits-->
            <table>
                <tr>
                    <th>nom</th>
                    <th>prénom</th>
                    <th>login</th>
                    <th>email</th>
                    <th>telephone</th>
                    <th>pays</th>
                    <th>ville</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                foreach ($clients as $client)
                {
                    ?>
                    <tr>
                        <td><?php echo $client['nom']; ?></td>
                        <td><?php echo $client['prenom']; ?></td>
                        <td><?php echo $client['login']; ?></td>
                        <td><?php echo $client['email']; ?></td>
                        <td><?php echo $client['telephone']; ?></td>
                        <td><?php echo $client['adr_pays']; ?></td>
                        <td><?php echo $client['adr_ville']; ?></td>
                        <td><a href="modifClient.php?id=<?php echo $client['id']; ?>">modifier</a></td>
                        <td><a href="supprClient.php?id=<?php echo $client['id']; ?>">supprimer</a></td>
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
