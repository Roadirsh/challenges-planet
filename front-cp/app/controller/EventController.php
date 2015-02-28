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
/* Global Library */
include("../lib/pagination.php");

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
        $SeeEvent = $event->SeeTopEvent();
        //var_dump($SeeEvent);
        
        /* * * * * * * * * * * * * * * * * * * * * * * * 
        * FORM CREATE && SEARCH 
        */
        include(ROOT . "conf/messages.php");

        if(isset($_POST['name']) and !empty($_POST['name'])){

            if($event->insertNewEvent($_POST)){   
                $_POST = null;
                // initialization of the messages
                $_SESSION['message'] = $messageInfo['EVENT_ADD_OK'];
                $_SESSION['messtype'] = 'default';

                $addOk = 'ok';
                $this->coreRedirect('connexion', 'signup');
            } else{
                $_POST = null;
                // initialization of the messages
                $_SESSION['message'] = $messageErreur['EVENT_ADD_NOK'];
                $_SESSION['messtype'] = 'danger';

                $addOk = 'nok';
            }

		} elseif(isset($_POST['search']) and !empty($_POST['search'])){
            $SeeEvent = $event->SearchByEvent($_POST['search']);
            if(empty($SeeEvent)){
                // initialization of the messages
                $_SESSION['message'] = 'their are no event for " ' . $_POST['search'] . ' "';
                $_SESSION['messtype'] = 'danger';
                $_POST = null;
                $SeeEvent = $event->SeeTopEvent();
            }
            $_POST = null;
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
        if(!isset($_GET['page'])){
            $_GET['page'] = 1;
        }

		/* * * * * * * * * * * * * * * * * * * * * * * * *
        * WHITH FILTER
        */
		if(isset($_POST) && !empty($_POST)){
		    /* KIND OF RACE */
    		if(isset($_POST['type']) && !empty($_POST['type'])){
    		    $SeeEvent = $events->SeeFiltreEventType($_POST['type'], $_GET['page']);
                if(!empty($SeeEvent)){
                    $SeeEvent = $events->SeeEventTeamNB($SeeEvent, $_GET['page']);
                }
                $count = count($SeeEvent);
    		    $array['search'][1] = $_POST['type'];
                $array['search'][2] = 'Type ';
                $_POST = null;

            /* BEGIN OF RACE */ 
    		} elseif(isset($_POST['begin']) && !empty($_POST['begin'])){
    		    $SeeEvent = $events->SeeFiltreEventBeginning($_POST['begin'], $_GET['page']);
                if(!empty($SeeEvent)){
                    $SeeEvent = $events->SeeEventTeamNB($SeeEvent, $_GET['page']);
                }
                $count = count($SeeEvent);
    		    $array['search'][1] = $_POST['begin'];
                $array['search'][2] = 'Begin date ';
                $_POST = null;

            /* NUMBER OF TEAMS */
    		} elseif(isset($_POST['nb_team']) && !empty($_POST['nb_team'])){
    		    $SeeEvent = $events->SeeFiltreEventNbTeam($_POST['nb_team'], $_GET['page']);
                if(!empty($SeeEvent[0])){
                    $SeeEvent = $events->SeeEventTeamNB($SeeEvent, $_GET['page']);
                }
                $count = count($SeeEvent);
    		    $array['search'][1] = $_POST['nb_team'];
                $array['search'][2] = 'Ending date ';
                $_POST = null;
            
            /* GLOBAL SEARCH */
            } elseif(isset($_POST['search']) && !empty($_POST['search'])){
                $SeeEvent = $events->SearchByEvent($_POST['search'], $_GET['page']);
                if(!empty($SeeEvent)){
                    $SeeEvent = $events->SeeEventTeamNB($SeeEvent, $_GET['page']);
                }
                $count = count($SeeEvent);
                $array['search'][1] = $_POST['search'];
                $array['search'][2] = '';
                $_POST = null;
            }

        /* * * * * * * * * * * * * * * * * * * * * * * * *
        * WHITHOUT FILTER
        */
		} else{
            $count = $events->CountEvent();
            $SeeEvent = $events->SeeEvent($_GET['page']);
            if(!empty($SeeEvent)){
                $SeeEvent = $events->SeeEventTeamNB($SeeEvent, $_GET['page']);
            }
            $array['search'] = '';
		}

        /* Construct the array to pass */
        $array['count'] = $count;
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

        $SeeGroups = $event->SeeGroupEvent($SeeEvent);
        $SeeDoneGroups = $event->SeeDoneGroup($SeeEvent);
        /* Construct the array to pass */
        $array['groups'] = $SeeGroups;
        $array['done'] = $SeeDoneGroups;
        $array['count'] = count($SeeGroups)+count($SeeDoneGroups);

        /* Construct the array to pass */
        $array['event'] = $SeeEvent[0];

        /* * * * * * * * * * * * * * * * * * * * * * * * *
        * WHITH FILTER
        */
        /* DEGRE OF HELP NEEDED */ 
        if(isset($_POST['help']) && !empty($_POST['help'])){
            $SeeGroups = $event->SeeFiltreGroupHelp($_POST['begin']);
            $SeeGroups = $event->EventTeamNB($SeeEvent);
            $array['search'] = $_POST['help'];
            $_POST = null;
            $array['groups'] = $SeeGroups;

        /* GOAL FOR MONEY */
        } elseif(isset($_POST['budget']) && !empty($_POST['budget'])){
            $gID = $event->SeeGroupID($eID);
            $SeeGroups = $event->SeeGroupEvent($gID, $_POST['budget']);
            $array['search'] = $_POST['budget'];
            $_POST = null;
            $array['groups'] = $SeeGroups;
        
        /* GLOBAL SEARCH */
        } elseif(isset($_POST['search']) && !empty($_POST['search'])){
            $SeeGroups = $event->SearchByProject($_POST['search'], $eID);
            $array['search'] = $_POST['search'];
            $_POST = '';

            $array['groups'] = $SeeGroups;
        }

        /* Construct the array to pass */
        // var_dump($array);

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
        define("PAGE_TITLE", SITE_NAME . " - " . $array['event']['event_name']); 
        define("PAGE_DESCR", SITE_NAME . " - " . substr($array['event']['event_decr'], 0, 100)); 
        define("PAGE_ID", $array['event']['event_name']);

        /* Load the view */
        $this->load->view('event', 'seeOneEvent', $array);

    }
    
    
	/**
     * mobile application
     *
     */
	public function Eventjson(){
		header('Content-Type: application/json');
		$event = $this->model = new EventModel();
		$json = $event->getEventJSON();
		echo $json;
	}

}

?>