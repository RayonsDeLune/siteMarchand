<?php
if (isset($_GET['titre']) && $_GET['titre'] != "")
    $titre = $_GET['titre'];
else
    $titre = "Le coin de la libraire";


include_once ("inc/_config.php");

$requete = "SELECT categorie.id, categorie.intitule, count(produit.id) as nbProduits FROM categorie "
        . " JOIN produit ON produit.id_categorie = categorie.id"
        . " GROUP BY categorie.id"
        . " ORDER BY intitule ";
$cats = $bdd->query($requete)->fetchAll();


$idClient = isset($_SESSION["idClient"]) ? $_SESSION["idClient"] : 0;
$idCmde = isset($_SESSION["idCmde"]) ? $_SESSION["idCmde"] : 0;

$nbArticles = 0;
$mttCmde = 0;
if ($idCmde!=0)
{
    $requete = "SELECT count(id) as nbArticles, sum(prix) as mttCmde "
            . "FROM ligne_commande "
            . " GROUP BY id_commande "
            . " HAVING id_commande=$idCmde";
    $result=$bdd->query($requete)->fetch();
    if ($result)
    {
        $nbArticles=$result["nbArticles"];
        $mttCmde = number_format($result["mttCmde"],2);
    }
}

?>

<header>
    <h1><?php echo $titre; ?></h1>
    <nav>
        <ul class="menu">
            <li ><a href="index.php"> Home</a></li>
            <?php
            if ($idClient == 0)
            {
                ?>
                <li >
                    <a href="#">Login</a>
                    <ul class="sous-menu">
                        <li>
                            <form name="login" method="post" action="login.php">
                                <input type="text" name="login" placeholder="login" width="10" required><br/>
                                <input type="password" name="password" placeholder="password" width="10" required><br/>
                                <input type="submit" value="valider">
                            </form>
                        </li>
                        <li>
                            <a href="inscription.php">inscription</a>
                        </li>
                    </ul>
                </li>

                <?php
            }
            else
            {
                ?>
                <li><a href="#"> Bienvenue <?php echo $_SESSION["pseudo"] ?> </a></li>
                <li ><a href="#"> Mon compte</a>
                    <ul class="sous-menu">
                        <li ><a href="commandes.php">mes commandes</a></li>
                        <li ><a href="#">mes infos</a></li>
                        <li ><a href="deconnexion.php">deconnexion</a></li>
                    </ul>
                </li>
                <?php
            }
            ?>
            <li ><a href="#"> Catégories</a>
                <ul  class="sous-menu">
                    <?php
                    foreach ($cats as $cat)
                    {
                        ?>
                        <li ><a href="rechercheProduit.php?idCat=<?php echo $cat['id']; ?>"><?php echo $cat['intitule'] . " (" . $cat['nbProduits'] . ")"; ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <?php
            if ($idClient != 0)
            {
                ?>
                <li><a href='panier.php'>panier<?php
                    if ($nbArticles>0)
                    {
                        $txt = ($nbArticles==1)? " livre" : " livres";
                        echo " ( ".$nbArticles.$txt." - ".$mttCmde."€ )";
                    }
                ?></a></li>
                <?php
            }
            else
            {
                ?>
                <li></li>
                <?php
            }
            ?>
        </ul>
    </nav>
</header>

