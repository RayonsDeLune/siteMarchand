/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var cptTelephones = 0;

function ajouterTel()
{
    var Conteneur = document.getElementById('conteneur');

    if (Conteneur)
    {
        var nbTels = Conteneur.childNodes.length;
        if (nbTels<8)
        {
            cptTelephones++;
            var code = "<section id='filleTel" + cptTelephones + "'>";
            code += "<label for='telephone[]'>Téléphone </label><input type='tel' name='telephone[]' required > ";
            code += "<a href='javascript:supprimerTel(" + cptTelephones + ");' onmouseover=\"document.photo"
                    +cptTelephones+".src='inc/img/pictoSuppr2.jpg'\" onmouseout=\"document.photo"
                    +cptTelephones+".src='inc/img/pictoSuppr1.jpg'\">";
//            onmouseover="document.photo.src='imagequandlasourisestdessus.gif'"
//            onmouseout="document.photo.src='imagedebase.gif'"
            code += "<img src='inc/img/pictoSuppr1.jpg' alt='supprimer' name='photo"+cptTelephones+"'></a>";
            code += "</section>";
            Conteneur.innerHTML += code;
        } else
        {
            document.getElementById('erreur').innerHTML = "Vous ne pouvez pas ajouter plus de téléphones.";
        }

    } else
    {
        console.log("pas de conteneur");
    }
}

function supprimerTel(num)
{
    var child = document.getElementById('filleTel' + num);
    child.parentNode.removeChild(child);
    // si on supprime un tel il faut aussi effacer la phrase "vous ne pouvez pas ajouter de telephone"
    document.getElementById('erreur').innerHTML = "";
}


