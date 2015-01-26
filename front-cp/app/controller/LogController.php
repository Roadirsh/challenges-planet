<?php 

/**
 * LogController
 *
 * Traitements relatifs au login / logout
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */
$logger->log('Include', 'loadapp', "Chargement du controller LogController.php", Logger::GRAN_MONTH);
class LogController extends CoreController{
	/**
	 * Constructor
	*/
	function __construct(){
		parent::__construct();
		if(isset($_GET['action'])){
			//ucfirt = Met le premier caractère en majuscule
			$action = ucfirst($_GET['action']);
			
			$this->$action();

		} else {
			// on test voir s'il y a une sesison ou non
			if(isset($_SESSION['']) != ''){
				$this->coreRedirect('', 'login');
			} else {
				$this->Login();

			}
		}

	}
	
	/**
	 * Login
	 */
	public function Login(){
		
		if(isset($_POST['email']) && !empty($_POST['email'])){
		
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
				$this->coreRedirect('page', 'home');
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
			$this->coreRedirect('page', 'home');
		}
	}


	/**
	 * Logout
	 */
	public function Logout(){

		
		session_unset();
		session_destroy();
		$this->coreRedirect('page', 'home');
		// $this->model = new LogoutModel();
		// redirection dans le fichier Model

	}
	
	/**
	 * Logout
	 */
	public function Signup(){

        // Dispatcher des actions du controller
		define("PAGE_TITLE", "Sign Up! - " . SITE_NAME); // TODO
		define('PAGE_DESCR', ""); // TODO
		define("PAGE_KW", "login, etc"); // TODO
		define("PAGE_ID", "page_signup"); // TODO
		
		$user = $this->model = new LogModel();
		
		if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['pwd']) && !empty($_POST['pwd'])){
		    //echo 'controller'; var_dump($_POST); 
			$addUser = $user->Signup($_POST);
			if($addUser){
    			$this->coreRedirect('page', 'home');
			}
		}
		
		$this->load->view('connexion', 'signup'); // TODO
		// $this->model = new LogoutModel();
		// redirection dans le fichier Model

	}

		
}