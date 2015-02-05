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
			
            if(method_exists($this, $action)){
                $this->$action();
            } else{
                $this->coreRedirect('notfound', 'notfound');
                
            }
            

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
	public function Addevent(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "addEvent");
        
        $event = $this->model = new EventModel();
        $SeeEvent = $event->SeeTopEvent();
        
        if(isset($_POST['form_create']) and !empty($_POST['form_create'])){
			$event->insertNewEvent($_POST);
			unset($_POST);
			$this->coreRedirect('page', 'home');
		} elseif(isset($_POST['search']) and !empty($_POST['search'])){
            $SeeEvent = $event->Search($_POST['search']);
            unset($_POST);
            if(empty($SeeEvent)){
                unset($_POST);
                $SeeEvent = $event->SeeTopEvent();
            }
        }
		
		$array = array();
		$array['topevent'] = $SeeEvent;
		
		// Appel de la vue 
		$this->load->view('event', 'addEvent', $array); // TODO
	
	}
	
	/**
	 * Page static INDEX
	 */
	public function Seeevent(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "SeeEvent");
        
		$events = $this->model = new EventModel();
		
		$array = array();
		
		//var_dump($_POST); 		
		
		// AVEC FILTRE
		if(isset($_POST) && !empty($_POST)){
		    // PAR TYPE DE COURSE
    		if(isset($_POST['type']) && !empty($_POST['type'])){
    		    $SeeEvent = $events->SeeFiltreEventType($_POST['type']);
    		    $array['type'] = $_POST['type'];
                $_POST = '';

            // PAR DEBUT DE COURSE    
    		} elseif(isset($_POST['begin']) && !empty($_POST['begin'])){
    		    $SeeEvent = $events->SeeFiltreEventBeginning($_POST['begin']);
    		    $array['begin'] = $_POST['begin'];
                $_POST = '';

            // PAR NOMBRE D'EQUIPE   
    		} elseif(isset($_POST['nb_team']) && !empty($_POST['nb_team'])){
    		    $SeeEvent = $events->SeeFiltreEventNbTeam($_POST['nb_team']);
    		    $array['nb_team'] = $_POST['nb_team'];
                $_POST = '';
            
            // SEARCH GLOBAL  
            } elseif(isset($_POST['search']) && !empty($_POST['search'])){
                //var_dump($_POST['search']); exit();
                $SeeEvent = $events->Search($_POST['search']);
                $array['search'] = $_POST['search'];
                $_POST = '';
            }

        // SANS FILTRE
		} else{
    		$SeeEvent = $events->SeeEvent();

		}
		
		$array['events'] = $SeeEvent;
		// Appel de la vue 
		$this->load->view('event', 'seeEvent', $array); // TODO
	
	}
	

    public function seeOneEvent(){
        // Définition des constante
        define("PAGE_TITLE", SITE_NAME);
        define("PAGE_DESCR", SITE_NAME . " "); // TODO
        define("PAGE_KW", SITE_NAME); // TODO
        define("PAGE_ID", "404");

        $eID = $_GET['id'];
        
        $event = $this->model = new EventModel();
        $SeeEvent = $event->SeeTopEvent();


        // Appel de la vue
        $this->load->view('event', 'seeOneEvent');

    }
}

?>