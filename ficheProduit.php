<?php
include ("inc/_config.php" );

$idProduit = $_GET['id'];

$requete = "SELECT produit.intitule as titre, description, prix, categorie.intitule, auteur.nom, auteur.prenom, image"
        . " FROM produit"
        . " JOIN auteur ON auteur.id=produit.id_auteur "
        . " JOIN categorie ON categorie.id=produit.id_categorie "
        . " WHERE produit.id=$idProduit";

//echo $requete;
$produit = $bdd->query($requete)->fetch();
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
            <h2><?php echo $produit['titre'] ?></h2>
            <?php
            if (isset($_SESSION['idClient']))
            {
                ?>
                <div id="panier"><a href="ajoutPanier.php?id=<?php echo $idProduit; ?>">ajouter au panier</a></div>
                <?php
            }
            ?>
            <div id="image"><img src="<?php echo $produit['image'] ?>"</div>
            <div id="categorie">- <?php echo $produit['intitule'] ?> -</div>
            <div id="auteur"><?php echo $produit['prenom'] . " " . $produit['nom'] ?></div>
            <div id="description"><?php echo $produit['description'] ?></div>
            <div id="prix"><?php echo $produit['prix'] ?> €
                <?php
                if (isset($_SESSION['idClient']))
                {
                    ?>
                    <a href="ajoutPanier.php?id=<?php echo $idProduit; ?>">ajouter au panier</a>
                    <?php
                }
                ?>
            </div>
        </article>

        <!-- inclure le pied de page -->
<?php
include ("footer.php");
?>
    </body>
</html>

