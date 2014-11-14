<?
session_start();
session_name('ChallengesPlanet');


    /////////////////////////////////////////////////////////////////////////////////
    require_once('../app/conf/conf_define.php');
    header('Content-type: text/html; charset=UTF-8');
    include(ROOT . "conf/mysql.php");
    include(ROOT . "conf/conf_url.php");
    
    
    error_reporting(E_ALL);
    //include("lib/lib.php");


    /////////////////////////////////////////////////////////////////////////////////
    //******************************************************//
    // --------------- PAGE POLYMORPHE ---------------------//

	if(isset($_SESSION["login_compte"]))
	{
		// dispatching des modules
		if (isset($_GET['a']))
		{
			$a = $_GET['a'];
		}
		else
		{
			// module par défaut
			$a = "connexion";
		}

		// dispatching des actions
		if (isset($_GET['b']))
		{
			$b = $_GET['b'];
		}
		else
		{
			// action par défaut
			$b = "login";
		}

		// construction de l'url
		$url = "controller/" . $a . "/" . $b . ".php";

		// dispatching vers les controlers/action ou bien redirection 404
		if (file_exists($url))
		{
			include_once($url);
		}
		else
		{
			include_once(ROOT . 'vue/404.php');
		}
	}

	else
	{
		include_once(ROOT . 'controller/connexion/login.php');
	}

