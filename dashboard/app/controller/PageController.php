<?php 

/**
 * PageController
 *
 * Affichage des pages sans traitement spécifique // static
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */
 
$logger->log('test', 'loadapp', "Chargement du controller page", Logger::GRAN_MONTH);

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
				$this->coreRedirect('user', 'login');
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

		// $allUser = $this->model = new CoreModel();
		// $allu = $allUser->coreTableAll('user');
		
		$countUser = $this->model = new PageModel();
		$NbUser = $countUser->NbUsers();
		
		echo 'nombre de user = ' . $NbUser;
		
		// Appel de la vue 
		$this->load->view('page', 'home'); // TODO
	
	}
	
	/**
	 * Page static INDEX
	 */
	public function Team(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "team");
		
		// Appel de la vue 
		$this->load->view('page', 'team'); // TODO
	
	}
	
}

?>