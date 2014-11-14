/***************************************************************
Chargement initial de la page
***************************************************************/
window.onload = function () 
{
	//********* Affiche la date en bas de page **************
	document.getElementById('date').innerHTML=date_fr();
	//********* Affiche l'année dans le copyright **************
	document.getElementById('copyright').innerHTML=annee();
	//********* Affiche l'heure toutes les secondes **************
	setInterval("document.getElementById('heure').innerHTML=hh_mm_ss();",1000);
	//********* Affiche le temps de chargement de la page **************
	var chrono_stop = new Date();
	var duree = chrono_stop - chrono_start;
	document.getElementById('duree').innerHTML=duree;
}

/***************************************************************
Animation de l'aide contextuelle sur le menu
Survol des options de menu et écriture des messages en dessous
***************************************************************/
document.getElementById("lien1").onmouseover = function () { document.getElementById('aide').innerHTML='Go back home !'; }
document.getElementById("lien1").onmouseout = function () {	document.getElementById('aide').innerHTML=''; }

document.getElementById("lien3").onmouseover = function () { document.getElementById('aide').innerHTML='See our photos gallery'; }
document.getElementById("lien3").onmouseout = function () {	document.getElementById('aide').innerHTML=''; }

document.getElementById("lien5").onmouseover = function () { document.getElementById('aide').innerHTML='Leave us a comment!'; }
document.getElementById("lien5").onmouseout = function () {	document.getElementById('aide').innerHTML=''; }

/***************************************************************
Gestion des 2 feuilles de styles
Remplacer la feuille de style en cours
***************************************************************/
document.getElementById("css1").onclick = function () 
{
	document.getElementById('css').href='style1.css';
	return false;
}
document.getElementById("css2").onclick = function () 
{
	document.getElementById('css').href='style2.css';
	return false;
}
