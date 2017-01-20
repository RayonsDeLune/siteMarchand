<?php
include ("inc/_config.php" );

$categorie = 0;
$auteur = 0;
$titreLivre = '';
$description = '';


$where = "";
if ($_GET)
{
    $categorie = $_GET['idCat'];
    $where = "WHERE categorie.id=$categorie";
}
if ($_POST)
{
    $categorie = $_POST['categorie'];
    $auteur = $_POST['auteur'];
    $titreLivre = addslashes($_POST['titre']);
    $description = addslashes($_POST['description']);

    $where = " WHERE produit.intitule LIKE '%$titreLivre%' "
            . " AND description LIKE '%$description%' ";
    if ($auteur != 0)
    {
        $where .= " AND id_auteur=$auteur";
    }
    if ($categorie != 0)
    {
        $where .= " AND id_categorie=$categorie";
    }
}
$requete = "SELECT categorie.intitule as c_intitule, auteur.nom, auteur.prenom, produit.* FROM produit "
        . " JOIN categorie ON categorie.id=produit.id_categorie"
        . " JOIN auteur ON auteur.id=produit.id_auteur ";
$requete .= $where;
$requete .= " ORDER BY categorie.intitule, nom, prenom, produit.intitule";

//echo "requete : ".$requete;

$produits = $bdd->query($requete)->fetchAll();

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
        <link href="inc/css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <!-- inclure le menu -->
        <?php
        include ("menu.php" );
        ?>
        <article>
            <form name="form1" method="post" action="">
                <select name="categorie" >
                    <option value="0" selected>Toutes les catégories</option>
                    <?php
                    foreach ($cats as $cat)
                    {
                        ?>
                        <option value="<?php echo $cat['id']; ?>" <?php
                        if ($categorie == $cat['id'])
                        {
                            echo "selected";
                        }
                        ?>><?php echo $cat['intitule']; ?></option>

                        <?php
                    }
                    ?>
                </select>
                <select name="auteur" >
                    <option value="0" selected>Tous les auteurs</option>
                    <?php
                    foreach ($auteurs as $auteur)
                    {
                        ?>
                        <option value="<?php echo $auteur['id']; ?>" <?php
                                if ($auteur == $auteur['id'])
                                {
                                    echo "selected";
                                }
                                ?>><?php echo $auteur['nom'] . " " . $auteur['prenom']; ?></option>

    <?php
}
?>
                </select>
                <input type="text"  placeholder="Recherche dans le titre" name="titre" size="30" value="<?php echo $titreLivre; ?>">
                <input type="text" placeholder="Rechercher dans le synopsis" name="description" size="50" value="<?php echo $description; ?>">
                <input type="submit" name="Rechercher" value="Rechercher">
            </form>
        </article>
        <article>
            <!--affichage de tous les produits-->
            <table width="100%">
                <tr>
                    <th>categorie</th>
                    <th>auteur</th>
                    <th>produit</th>
                    <th>prix</th>
                    <th></th>
                </tr>
<?php
foreach ($produits as $produit)
{
    ?>
                    <tr>
                        <td><?php echo $produit['c_intitule']; ?></td>
                        <td><?php echo $produit['prenom'] . ' ' . $produit['nom']; ?></td>
                        <td><a href='ficheProduit.php?id=<?php echo $produit['id']; ?>' alt='voir la fiche produit'><?php echo $produit['intitule']; ?></a></td>
                        <td><?php echo number_format($produit['prix'],2); ?> €</td>
                        <?php
                        if ($idClient!=0)
                        {
                            ?>
                            <td><a href="ajoutPanier.php?id=<?php echo $produit['id']; ?>">ajouter au panier</a></td>
                        <?php
                    }
                    ?>
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


