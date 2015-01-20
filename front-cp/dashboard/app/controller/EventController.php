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
	 *
	 * @param array $_GET
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
	 * Voir l'ensemble des évenements
	 */
	public function Seeevent(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeEvent");
		
		if(isset($_POST) and !empty($_POST)){
		    //var_dump($_POST);
            $search = $this->model = new EventModel($_POST);
            $AllEvent = $search->searchEvent($_POST);
            $_POST = null;
		} else{
    		$AllEvents = $this->model = new EventModel();
            $AllEvent = $AllEvents-> getShowEvents();
            //var_dump($AllEvent);
		}
		
		
        
		// Appel de la vue 
		$this->load->view('event', 'seeEvent', $AllEvent); // TODO
	
	}
	
	/**
	 * Voir l'ensemble des évenements
	 */
	public function Seeoneevent(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeEvent");
		
		$OneEvents = $this->model = new EventModel();
        $OneEvent = $OneEvents-> Seeoneevent();
        //var_dump($OneEvent);
        
		// Appel de la vue 
		$this->load->view('event', 'seeOneEvent', $OneEvent); // TODO

	}
	
	/**
	 * Ajouter un évenement
	 *
	 * @param array $_POST
	 */
	public function Addevent(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "addEvent");
		
		if(isset($_POST) and !empty($_POST)){
			$eventAdd = $this->model = new EventModel($_POST);
			$eventAdd->insertNewEvent();
		}
		
		// Appel de la vue 
		$this->load->view('event', 'addEvent'); // TODO
	
	}
	
	/**
	 * Supprimer un évenement
	 */
	public function Delevent(){
	
        $deleteEvent = $this->model = new EventModel();
		$DeleEvent = $deleteEvent->Delevent();
		$_SESSION['message'] = "The event has been well deleted";
		
		$this->coreRedirect('event', 'seeEvent', $message);
	
	}
	
}

?>