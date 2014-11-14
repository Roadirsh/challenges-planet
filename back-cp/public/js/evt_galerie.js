/***************************************************************
Animation du zoom lors du survol des miniatures
Affichage de l'image grand format dans la zone de zoom
***************************************************************/
document.getElementById("mini1").onmouseover = function () { document.getElementById('zoom').src='images/img01_big.jpg'; }
document.getElementById("mini2").onmouseover = function () { document.getElementById('zoom').src='images/img02_big.jpg'; }
document.getElementById("mini3").onmouseover = function () { document.getElementById('zoom').src='images/img03_big.jpg'; }
document.getElementById("mini4").onmouseover = function () { document.getElementById('zoom').src='images/img04_big.jpg'; }
document.getElementById("mini5").onmouseover = function () { document.getElementById('zoom').src='images/img02_big.jpg'; }
document.getElementById("mini6").onmouseover = function () { document.getElementById('zoom').src='images/img01_big.jpg'; }
document.getElementById("mini7").onmouseover = function () { document.getElementById('zoom').src='images/img04_big.jpg'; }
document.getElementById("mini8").onmouseover = function () { document.getElementById('zoom').src='images/img03_big.jpg'; }

/***************************************************************
Gestion du diaporama
Changer la grande photo à l'interval saisi dans le champs
***************************************************************/
var diapo_en_cours = false;
document.getElementById("startdiapo").onclick = function () 
{
	if (diapo_en_cours == false)
	{
		diapo = setInterval('diaporama();',document.getElementById('delai').value*1000); 
		diapo_en_cours = true;
	}
	else
		alert("Le diaporama est déjà lancé !");
	return false;
}
document.getElementById("stopdiapo").onclick = function () 
{
	if (diapo_en_cours == true)
	{
		clearInterval(diapo);
		diapo_en_cours = false;
	}
	else
		alert("Le diaporama n'est pas lancé !");
	return false;
}
//********* Changement de la photo aléatoirement **************
function diaporama()
{
	var tab_photos = new Array("images/img01_big.jpg","images/img02_big.jpg","images/img03_big.jpg","images/img04_big.jpg");
	num_photo = Math.floor(4*Math.random());
	document.getElementById('zoom').src = tab_photos[num_photo];
}

