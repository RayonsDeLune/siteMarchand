<?php

include ('testSession.php');

if ($_POST)
{
    $categorie = $_POST["categorie"];
    $auteur = $_POST["auteur"];
    $intitule = addslashes($_POST["intitule"]);
    $description = addslashes($_POST["description"]);
    $prix = $_POST["prix"];

    $requete = "INSERT INTO produit(intitule, description, prix, id_categorie, id_auteur)"
            . " VALUES ('$intitule','$description','$prix', $categorie, $auteur)";
    $id_produit = $bdd->query($requete)->fetch(PDO::FETCH_ASSOC);

    /*
     * tout ce qui est insertion d'images ...  ne fonctionne pas
     */
    $dossier = 'img/produits/';
    $fichier = basename($_FILES['image']['name']);
    $taille_maxi = 100000;
    $taille = filesize($_FILES['image']['tmp_name']);
    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    $extension = strrchr($_FILES['image']['name'], '.');
//Début des vérifications de sécurité...
    if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
        $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
    }
    if ($taille > $taille_maxi)
    {
        $erreur = 'Le fichier est trop gros...';
    }
    if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
        //On formate le nom du fichier ici...
        $fichier = "img_".$id_produit.".".$extension;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
            echo 'Upload effectué avec succès !';
        }
        else //Sinon (la fonction renvoie FALSE).
        {
            echo 'Echec de l\'upload !';
        }
    }
    else
    {
        echo $erreur;
    }
    /*
     * fin de l'insertion d'images
     */
}

$requete = "SELECT categorie.intitule as c_intitule, auteur.nom, auteur.prenom, produit.* FROM produit "
        . " JOIN categorie ON categorie.id=produit.id_categorie"
        . " JOIN auteur ON auteur.id=produit.id_auteur "
        . " ORDER BY categorie.intitule, nom, prenom, produit.intitule";
$produits = $bdd->query($requete)->fetchAll();
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
            <a href="ajoutProduit.php">Ajouter un produit</a>
            <!--affichage de tous les produits-->
            <table>
                <tr>
                    <th>categorie</th>
                    <th>auteur</th>
                    <th>produit</th>
                    <th>prix</th>
                    <th></th>
                    <th></th>
                </tr>
<?php
foreach ($produits as $produit)
{
    ?>
                    <tr>
                        <td><?php echo $produit['c_intitule']; ?></td>
                        <td><?php echo $produit['prenom'] . ' ' . $produit['nom']; ?></td>
                        <td><?php echo $produit['intitule']; ?></td>
                        <td><?php echo $produit['prix']; ?> €</td>

                        <td><a href="modifProduit.php?id=<?php echo $produit['id']; ?>">modifier</a></td>
                        <td><a href="supprProduit.php?id=<?php echo $produit['id']; ?>">supprimer</a></td>
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