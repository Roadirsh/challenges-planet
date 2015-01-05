<?php 

/**
 * ProjetController
 *
 * Affichage des pages sans traitement spécifique // static
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

class EventController extends CoreController {

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
				$this->Seeevent();
			} else {
				$this->coreRedirect('user', 'login');
			}
		}
	}


	/**
	 * Page static INDEX
	 */
	public function Seeevent(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeEvent");
		
		$AllEvents = $this->model = new EventModel();
        $AllEvent = $AllEvents-> getShowEvents();
        //var_dump($AllEvent);
        
        echo '<h1>VAR_DUMP: l\'ensemble des évènements valide</h1>';
		var_dump($AllEvent);
		// Appel de la vue 
		$this->load->view('event', 'seeEvent', $AllEvent); // TODO
	
	}
	
	/**
	 * Page static INDEX
	 */
	public function Addevent(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "addEvent");
		
		
		
		
		// Appel de la vue 
		$this->load->view('event', 'addEvent'); // TODO
	
	}
	
}

?>