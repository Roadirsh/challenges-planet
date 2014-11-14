<? 

if(isset($_POST['login']))
	{
	    include(MODEL . '/Connexion.php');
	    if(isconnect(($_POST["login"]), (md5($_POST["pwd"]))))
	    {
    	    header('Location:'. INDEX . 'a=home&b=home&m=ok');
	    }
	    else{
    	    header('Location: '. INDEX . 'a=connexion&b=connexion&m=nok');
	    }
    }



include_once(ROOT . 'view/connexion/login.php');