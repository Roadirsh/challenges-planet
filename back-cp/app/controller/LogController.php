<?php 

/**
 * Controller
 *
 * Page de connexion et déconnexion
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

class LogController extends CoreController{
	/**
	 * Constructor
	*/
	function __construct(){
		parent::__construct();
		if(isset($_GET['action'])){
			//ucfirt = Met le premier caractère en majuscule
			$action = ucfirst($_GET['action']);
			if(function_exists($action)){
    			$this->$action();
			} else{
    			$this->Login();
			}
			

		} else {
			// on test voir s'il y a une sesison ou non
			if(isset($_SESSION['user']) != ''){
				$this->coreRedirect('user', 'login');
			} else {
				$this->Login();
			}
		}

	}
	
	/**
	 * Login
	 *
	 * @param array $_POST
	 */
	public function Login(){
		
		if(isset($_POST['login'])){
			//echo 'post';
			// on rétabli les paramètres à zéro pour établir une nouvelle connexion
			session_unset();

			// Charger le modèle pour vérifier le login et mot de passe
			$isUser = $this->model = new LogModel($_POST);

			$User = $isUser->Login($_POST);
			
			// var_dump($_SESSION);
			// Appel de la vue
			if($User != 0){
				//echo 'oui';
				$_POST = array();

				$this->coreRedirect('page', 'home');
				// header('location:index.php');

			} else{
				// Dispatcher des actions du controller
				define("PAGE_TITLE", "Login"); // TODO
				define('PAGE_DESCR', "Se connecter pour accéder au Dashboard."); // TODO
				define("PAGE_KW", "login, etc"); // TODO
				define("PAGE_ID", "page_login"); // TODO

				// on recharge la page de la connexion + message
				$this->load->view('connexion', 'login'); // TODO
				//$mess = $_SESSION["coreMessage"] = $messageErreur["_LOGIN_NOK"]; // TODO
				//$this->coreEcrireMessage($mess);
			}
		} else {
			// Dispatcher des actions du controller
			define("PAGE_TITLE", "Login"); // TODO
			define('PAGE_DESCR', "Se connecter pour accéder au Dashboard."); // TODO
			define("PAGE_KW", "login, etc"); // TODO
			define("PAGE_ID", "page_login"); // TODO

			// si il n'y a pas de formulaire 
			$this->load->view('connexion', 'login');
		}
	}


	/**
	 * Logout
	 */
	public function Logout(){

		
		session_unset();
		session_destroy();
		$this->coreRedirect('user', 'login');
		// $this->model = new LogoutModel();
		// redirection dans le fichier Model

	}

		
}