<?php 

/**
 * EventController
 *
 * Everything who is relative to an EVENT
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * ADD EVENT
 * SEE EVENTS
 * FILTER EVENTS
 * SEE ONE EVENT
 */
class EventController extends CoreController {

	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
		
		if(isset($_GET['action'])){
			//ucfirt = put the first letter in Uppercase
			$action = ucfirst($_GET['action']);
			
            if(method_exists($this, $action)){
                $this->$action();
            } else{
                $this->corePage404();  
            }
            

		} else {
			// is their a session or not?
			if(isset($_SESSION['user']) != ''){
				$this->Seeevent();
			} else {
				$this->coreRedirect('user', 'login');
			}
		}
	}

	
	/**
     * addEvent.php
     *
     * @param Array $_POST
     */
	private function Addevent(){

		/* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
		define("PAGE_TITLE", SITE_NAME . " - JOIN and CREATE");
		define("PAGE_DESCR", SITE_NAME . " JOIN THE BEST CARITIVES STUDENT CHALLENGES");
		define("PAGE_ID", "addEvent");
        
        $event = $this->model = new EventModel();

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * Get 4 events, randomly, to join as a user
        */
        $SeeEvent = $event->getTopEvent();
        
        /* * * * * * * * * * * * * * * * * * * * * * * * 
        * FORM CREATE && SEARCH 
        */
        if(isset($_POST['name']) and !empty($_POST['name'])){
			$event->insertNewEvent($_POST);
			$_POST = null;
			$this->coreRedirect('page', 'home'); // TODO

		} elseif(isset($_POST['search']) and !empty($_POST['search'])){
            $SeeEvent = $event->SearchByEvent($_POST['search']);
            $_POST = null;
            if(empty($SeeEvent)){
                $_POST = null;
                $SeeEvent = $event->getTopEvent();
            }
        }
		
        /* Construct the array to pass */
		$array = array();
		$array['topevent'] = $SeeEvent;

        /* Load the view */
		$this->load->view('event', 'addEvent', $array); // TODO
	
	}
	
	/**
     * seeEvent.php
     *
     * @param Array $_POST
     */
	private function Seeevent(){

		/* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
		define("PAGE_TITLE", SITE_NAME . " - EVENTS");
		define("PAGE_DESCR", SITE_NAME . "'s all events");
		define("PAGE_ID", "SeeEvent");
        
		$events = $this->model = new EventModel();
		
		$array = array();

		/* * * * * * * * * * * * * * * * * * * * * * * * *
        * WHITH FILTER
        */
		if(isset($_POST) && !empty($_POST)){
		    /* KIND OF RACE */
    		if(isset($_POST['type']) && !empty($_POST['type'])){
    		    $SeeEvent = $events->SeeFiltreEventType($_POST['type']);
                if(!empty($SeeEvent)){
                    $SeeEvent = $events->EventTeamNB($SeeEvent);
                }
    		    $array['search'][1] = $_POST['type'];
                $array['search'][2] = 'Type ';
                $_POST = null;

            /* BEGIN OF RACE */ 
    		} elseif(isset($_POST['begin']) && !empty($_POST['begin'])){
    		    $SeeEvent = $events->SeeFiltreEventBeginning($_POST['begin']);
                if(!empty($SeeEvent)){
                    $SeeEvent = $events->EventTeamNB($SeeEvent);
                }
    		    $array['search'][1] = $_POST['begin'];
                $array['search'][2] = 'Begin date ';
                $_POST = null;

            /* NUMBER OF TEAMS */
    		} elseif(isset($_POST['nb_team']) && !empty($_POST['nb_team'])){
    		    $SeeEvent = $events->SeeFiltreEventNbTeam($_POST['nb_team']);
    		    $array['search'][1] = $_POST['nb_team'];
                $array['search'][2] = 'Ending date ';
                $_POST = null;
            
            /* GLOBAL SEARCH */
            } elseif(isset($_POST['search']) && !empty($_POST['search'])){
                $SeeEvent = $events->SearchByEvent($_POST['search']);
                if(!empty($SeeEvent)){
                    $SeeEvent = $events->EventTeamNB($SeeEvent);
                }
                $array['search'][1] = $_POST['search'];
                $array['search'][2] = '';
                $_POST = null;
            }

        /* * * * * * * * * * * * * * * * * * * * * * * * *
        * WHITHOUT FILTER
        */
		} else{
    		$SeeEvent = $events->SeeEvent();
            $SeeEvent = $events->EventTeamNB($SeeEvent);
            $array['search'] = '';
		}
		
        /* Construct the array to pass */
		$array['events'] = $SeeEvent;
		/* Load the view */
		$this->load->view('event', 'seeEvent', $array); // TODO
	
	}
	
    /**
     * seeOneEvent.php
     *
     * @param Array $_POST
     */
    private function seeOneEvent(){

        /* * * * * * * * * * * * * * * * * * * * * * * * *
        * Event ID GET_URL
        */
        $eID = $_GET['id'];
        
        $event = $this->model = new EventModel();

        /* * * * * * * * * * * * * * * * * * * * * * * * *
        * WHITHOUT FILTER
        */
        $SeeEvent = $event->SeeOneEvent($eID);

        /* Construct the array to pass */
        $array['event'] = $SeeEvent['event'];;
        
        /* * * * * * * * * * * * * * * * * * * * * * * * *
        * WHITH FILTER
        */
        /* DEGRE OF HELP NEEDED */ 
        if(isset($_POST['help']) && !empty($_POST['help'])){
            $SeeEvent = $event->SeeFiltreGroupHelp($_POST['begin']);
            $SeeEvent = $event->EventTeamNB($SeeEvent);
            $array['help'] = $_POST['help'];
            $_POST = null;

        /* GOAL FOR MONEY */
        } elseif(isset($_POST['budget']) && !empty($_POST['budget'])){
            $SeeEvent = $event->SeeFiltreGroupMoney($_POST['budget'], $eID);
            $array['budget'] = $_POST['budget'];
            $_POST = null;
        
        /* GLOBAL SEARCH */
        } elseif(isset($_POST['search']) && !empty($_POST['search'])){
            $SeeEvent = $event->SearchByProject($_POST['search'], $eID);
            $array['search'] = $_POST['search'];
            $_POST = '';

        }

        if(empty($SeeEvent)){
            $SeeEvent = $event->SeeOneEvent($eID);
            
        }

        /* Construct the array to pass */

        if(!empty($SeeEvent['groups'])){
            $array['groups'] = $SeeEvent['groups'];
        } elseif(!empty($SeeEvent['done'])){
            $array['done'] = $SeeEvent['done'];
        }

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
        define("PAGE_TITLE", SITE_NAME . " - " . $array['event'][0]['event_name']);
        define("PAGE_DESCR", SITE_NAME . " - " . substr($array['event'][0]['event_decr'], 0, 100));
        define("PAGE_ID", $array['event'][0]['event_name']);

        /* Load the view */
        $this->load->view('event', 'seeOneEvent', $array);

    }
    
    
	// Pour l'aplication mobile
	public function Eventjson()
	{
		header('Content-Type: application/json');
		$event = $this->model = new EventModel();
		$json = $event->getEventJSON();
		echo $json;
	}

}

?>