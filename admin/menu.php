<?php 
if (isset($_GET['titre']) && $_GET['titre']!="")
    $titre=$_GET['titre'];
else
    $titre="-- Administration du site -- ";

?>
<header>
    <h1><?php echo $titre;?></h1>
    <nav>
        <ul class="menu">
            <li ><a href="index.php"> Login</a></li>
            <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'OK')
            {
            ?>
            <li ><a href="#"> Produits</a>
                <ul  class="sous-menu">
                    <li ><a href="produits.php">liste des produits</a></li>
                    <li ><a href="ajoutProduit.php">ajouter 1 produit</a></li>
                </ul>
            </li>
            <li ><a href="#"> Categorie</a>
                <ul class="sous-menu">
                    <li ><a href="categories.php">liste des categories</a></li>
                    <li ><a href="ajoutCategorie.php">ajouter 1 categorie</a></li>
                </ul>
            </li>
            <li ><a href="#"> Auteurs</a>
                <ul class="sous-menu">
                    <li ><a href="auteurs.php">liste des auteurs</a></li>
                    <li ><a href="ajoutAuteur.php">ajouter 1 auteur</a></li>
                </ul>
            </li>
            <li ><a href="#"> Clients</a>
                <ul class="sous-menu">
                    <li ><a href="clients.php">liste des clients</a></li>
                    <li ><a href="ajoutClient.php">ajouter 1 client</a></li>
                </ul>
            </li>
            <li ><a href="#"> Commandes</a>
                <ul class="sous-menu">
                    <li ><a href="commandes.php">liste des commandes</a></li>
                </ul>
            </li>
            <?php
            }
            ?>
            <li><a href='../index.php'>Site marchand</a></li>
        </ul>
    </nav>
</header>

