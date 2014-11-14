/***************************************************************
Envoi du formulaire
Vérifier les 3 champs
***************************************************************/
document.getElementById("formu").onsubmit = function () 
{
	if (document.formu.nom.value == "") 
	{
		alert("You must give your name !");
		return false;
	}
	else if(isEmail(document.formu.mail.value) == false) 
	{
		alert("Enter your email !");
		return false;
	}
	else if(document.formu.comment.value == "") 
	{
		alert("You  came to writte a comment ... right ?!");
		return false;
	}
	else return true;
}
