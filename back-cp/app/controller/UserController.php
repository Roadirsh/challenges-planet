<?php 

/**
 * UserController
 *
 * Affichage des pages sans traitement spécifique // static
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */
 
//$logger->log('test', 'loadapp', "Chargement du controller page", Logger::GRAN_MONTH);
class UserController extends CoreController {

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
			if(isset($_SESSION['user']) != ''){
				$this->Seeuser();
			} else {
				$this->coreRedirect('user', 'login');
			}
		}
	}


	/**
	 * Page static INDEX
	 */
	public function Seeuser(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeUser");
		
		var_dump($_SESSION);
		
		// Appel de la vue 
		$this->load->view('user', 'seeUser'); // TODO
	
	}
	
	/**
	 * Page static INDEX
	 */
	public function Adduser(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "addUser");
		if(isset($_POST) and !empty($_POST)){
			$userAdd = $this->model = new UserModel($_POST);
			var_dump($_POST);
			$userAdd->insertNewUser();
		}

		// Appel de la vue 
		$this->load->view('user', 'addUser'); // TODO
	
	}
	
}

?>