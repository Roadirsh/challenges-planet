<? 




class LoginController extends CoreController{
	
	function __construct(){
		parent::__construct();
		
		//Charger le modèle si nécessaire 
		$this->model = new LoginModel();
		define ("PAGE_TITLE", "Login");
		define('PAGE_DESCR', "Se connecter pour acceder au back office.");
		define("PAGE_KEYWORDS", "login, etc");
		define("PAGE_ID", "page_login");
		
		$this->load->view('connexion', 'login');
	}
	
	
	
	
	
	
	
	
}


/*
if(isset($_POST['login']))
	{
	    include(MODEL . '/Connexion.php');
	    if(isconnect(($_POST["login"]), (md5($_POST["pwd"]))))
	    {
    	    header('Location:'. INDEX . 'module=home&action=home&m=ok');
	    }
	    else{
    	    header('Location: '. INDEX . 'module=connexion&action=connexion&m=nok');
	    }
    }



include_once(ROOT . 'view/connexion/login.php');
*/