
var images = [];
var nbL = 4;
var nbC = 4;

var imagesDepart = [];



function chargerImages()
{
    for (var cpt1 = 0; cpt1 < nbL; cpt1++)
    {
        images.push([]);
        imagesDepart.push([]);
        for (var cpt2 = 0; cpt2 < nbC; cpt2++)
        {
            imagesDepart[cpt1][cpt2] = new Image;
            imagesDepart[cpt1][cpt2].src = "inc/img/frog/frog-" + cpt1 + "-" + cpt2 + ".jpeg";
            images[cpt1][cpt2] = new Image;
            images[cpt1][cpt2].src = imagesDepart[cpt1][cpt2].src;
        }
    }
}

function afficherImage()
{
    //document.getElementById("result").innerHTML = "";
    var table = document.getElementById("puzzle");
    for (var cpt1 = 0; cpt1 < nbL; cpt1++)
    {
        var row = table.insertRow(cpt1);
        for (var cpt2 = 0; cpt2 < nbC; cpt2++)
        {
            var cell = row.insertCell(cpt2);
            //document.getElementById("result").innerHTML += "<img id='img-" + cpt1 + "-" + cpt2 + "' src='" + images[cpt1][cpt2].src + "' draggable='true'>  ondragstart='"+drag(event)+"'";
            cell.innerHTML = "<img id='img-" + cpt1 + "-" + cpt2 + "' src='" + images[cpt1][cpt2].src + "'>";
            var eltImg = document.getElementById("img-" + cpt1 + "-" + cpt2);
            eltImg.setAttribute('ligne', cpt1);
            eltImg.setAttribute('colonne', cpt2);
            initialiserEvenementImg(eltImg);
        }
    }
}

function afficherPetiteImage() // pour afficher l'image de base
{
    var table = document.getElementById("petit");
    for (var cpt1 = 0; cpt1 < nbL; cpt1++)
    {
        var row = table.insertRow(cpt1);
        for (var cpt2 = 0; cpt2 < nbC; cpt2++)
        {
            var cell = row.insertCell(cpt2);
            //document.getElementById("result").innerHTML += "<img id='img-" + cpt1 + "-" + cpt2 + "' src='" + images[cpt1][cpt2].src + "' draggable='true'>  ondragstart='"+drag(event)+"'";
            cell.innerHTML = "<img src='" + imagesDepart[cpt1][cpt2].src + "' width='50'>";
        }
    }
}

function melanger() // permet de mélanger l'image de base
{
    // on parcourt toute la matrice
    for (var cpt1 = 0; cpt1 < nbL; cpt1++)
    {
        for (var cpt2 = 0; cpt2 < nbC; cpt2++)
        {
            echanger(cpt1, cpt2);
        }
    }
}

function initialiserEvenementImg(img) // permet de mettre les évènements dragg and dropp sur le morceau d'image
{
    img.ondragover = function (ev) {
        ev.preventDefault();
    };

    img.ondragstart = function (ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    };

    img.ondrop = function (ev)
    {
        ev.preventDefault();
        var idSource = ev.dataTransfer.getData("text");
        var sourceSrc = document.getElementById(idSource).src;
        var targetSrc = ev.target.src;
        document.getElementById(idSource).src = targetSrc;
        ev.target.src = sourceSrc;


        var iSource = document.getElementById(idSource).getAttribute("ligne");
        var jSource = document.getElementById(idSource).getAttribute("colonne");

        var iTarget = ev.target.getAttribute("ligne");
        var jTarget = ev.target.getAttribute("colonne");

        images[iSource][jSource].src = (targetSrc);
        images[iTarget][jTarget].src = (sourceSrc);

        if (verifierPuzzle()) {
            alert('Puzzle Resolu !!!');
        } else {
            console.log('Vas y tu peux y arriver !!!');
        }
    };
}

//Vérifier le puzzle
//
function verifierPuzzle()
{

    for (var i = 0; i < nbL; i++)
    {
        for (var j = 0; j < nbC; j++)
        {
            if (images[i][j].src != imagesDepart[i][j].src)
            {
                // si les 2 src des 2 morceaux d'images sont différents alors c'est pas bon
                return false;
            }
        }
    }
    // si on est là c'est que tous les morceaux sont à leur place
    return true;
}

function echanger(cpt1, cpt2) // permet d'échanger 2 morceaux d'images - utilisé au départ pour mélanger 
{
    var rLigne = getRandomInt(0, nbL);
    var rCol = getRandomInt(0, nbC);
    var cellule = images[cpt1][cpt2];
    images[cpt1][cpt2] = images[rCol][rLigne];
    images[rCol][rLigne] = cellule;
}



function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min;
}



window.onload = function () {
    // se produit lorsque la page HTML est chargée

    chargerImages();
    melanger();
    afficherImage();

    afficherPetiteImage();

};



