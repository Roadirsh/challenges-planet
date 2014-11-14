//********* Lancer le chrono **************
var chrono_start = new Date();

/**********************************************************
Fonction    : date_fr()
Description : Retourne la date en français
Paramètres  : vide
Retour      : Lundi 12 Janvier 2012 (exemple)
**********************************************************/
function date_fr() 
{
	var ladate = new Date();

	var annee = ladate.getFullYear();

	var tab_jours = new Array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
	var tab_mois = new Array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");

	return tab_jours[ladate.getDay()] + " " + ladate.getDate() + " " + tab_mois[ladate.getMonth()] + " " + annee;
}

/**********************************************************
Fonction    : annee()
Description : Retourne l'année AAAA
Paramètres  : vide
Retour      : 2012 (exemple)
**********************************************************/
function annee() 
{
	var ladate = new Date();

	var annee = ladate.getFullYear();

	return annee;
}

/**********************************************************
Fonction    : hh_mm_ss()
Description : Retourne l'heure
Paramètres  : vide
Retour      : 12:45:28 (exemple)
**********************************************************/
function hh_mm_ss() 
{
	var ladate = new Date();
	var heure = ladate.getHours();
	var minute = ladate.getMinutes();
	var seconde = ladate.getSeconds();

	if (heure<10) heure = "0" + heure;
	if (minute<10) minute = "0" + minute;
	if (seconde<10) seconde = "0" + seconde;

	return heure + ":" + minute + ":" + seconde;
}

/**********************************************************
Fonction    : mail()
Description : Retourne une balise de lien mail cachée des spambots
Paramètres  : nom, domaine, extension, texte
Retour      : <a href='mailto:nom@domaine.extension'>texte</a> (exemple)
**********************************************************/
function mail(nom, domaine, extension, texte) 
{
	return "<a href='mailto:" + nom + "@" + domaine + "." + extension + "'>" + texte + "</a>";
}

/**********************************************************
Fonction    : isEmail()
Description : Test si la valeur passée est une adresse mail
Paramètres  : email
Retour      : True si OK, False si NOK
**********************************************************/
function isEmail(email)
{
     if ( ( email.indexOf("@") == -1 ) 
	   || ( email.indexOf("@") == 0 ) 
	   || ( email.indexOf("@") != email.lastIndexOf("@") ) 
	   || ( email.indexOf(".") == email.indexOf("@") - 1 ) 
	   || ( email.indexOf(".") == email.indexOf("@") + 1 ) 
	   || ( email.indexOf("@") == email.length -1 ) 
	   || ( email.indexOf (".") == - 1 ) 
	   || ( email.lastIndexOf (".") == email.length - 1 ) )
         return false;
      else
         return true;
}