<?php 

/**
 * PageController
 *
 * Affichage des pages sans traitement spécifique // static
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */
 

class PageController extends CoreController {

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
				$this->Home();
			} else {
				//$this->coreRedirect('user', 'login');
				// temporaire
				$this->Home();
			}
		}
	}


	/**
	 * Page static INDEX
	 */
	public function Home(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "home");
		
		$LastGroup = $this->model = new PageModel();
		$AllLastGroups = $LastGroup->SeeLastGroups();
		
		echo '<h1>VAR_DUMP: les derniers groupes de projets ajoutés</h1>';
		var_dump($AllLastGroups);
		// Appel de la vue 
		$this->load->view('page', 'home', $AllLastGroups); // TODO
	
	}
	
	
}

?>