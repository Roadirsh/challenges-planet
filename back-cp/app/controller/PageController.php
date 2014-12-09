<?php 

/**
 * PageController
 *
 * Affichage des pages sans traitement spécifique // static
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

<<<<<<< HEAD
=======

$index = new PageController();



>>>>>>> lala
class PageController extends CoreController {

	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();
		if(isset($_GET['action'])){
<<<<<<< HEAD
			//ucfirt = Met le premier caractère en majuscule
			$action = ucfirst($_GET['action']);
			$this->$action();

		} else {
			$this->Home();
		}

=======
	//ucfirt = Met le premier caractère en majuscule
	$this-> ucfirst($_GET['action']) . '()';
} else {
	$this->Home();
}
>>>>>>> lala
	}

	/**
	 * Page static INDEX
	 */
	public function Home() {

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "home");

		// $allUser = $this->model = new CoreModel();
		// $allu = $allUser->coreTableAll('user');

		// Appel de la vue 
		$this->load->view('page', 'home'); // TODO
	
	}
}