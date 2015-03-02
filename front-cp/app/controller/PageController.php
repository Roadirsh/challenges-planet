<?php 

/**
 * PageController
 *
 * All pages without any action from the user, except home
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * HOME
 * CGU
 */
class PageController extends CoreController {

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
			
			$this->Home();
		}
	}


	/**
     * Linked to : 
     * model/PageModel.php
     * view/home.php
     * 
     * Here you will have 3 differents functions. 
     * The first one is to get the sliders events. The four 4 last one 
     * The second one is to get the 7 last teams
     * + one extra to get one done group (event time passed)
     * The third on is to get 8 sponsors
     */
	private function Home(){

		/* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", "Platform of comparison of students and companies within the framework of participation of event sportsmen to be sponsored");
		define("PAGE_ID", "home");

		$Group = $this->model = new PageModel();

		/* Get 4 events for the slider */
		$AllfourEvents = $Group->SeeFourEvents();

		/* Get 7 last added teams */
		$gID = $Group->SeeGroupID();

		$AllLastGroups = '';
		$DoneGroup = '';

		if(!empty($gID)){
			$AllLastGroups = $Group->SeeGroups($gID);
			/* Get 1 teams from a finish event */
			$DoneGroup = $Group->SeeDoneGroup($gID);
		}

		/* Get 7 sponsors */
		$AllLastSponsors = $Group->SeeLastSponsors();
		
		/* Construct the array to pass */
		$array = array();
		$array['slider'] = $AllfourEvents;
		$array['group'] = $AllLastGroups;
		$array['sponsor'] = $AllLastSponsors;
		$array['done'] = $DoneGroup;
		
		/* Load the view */
		$this->load->view('page', 'home', $array);
	
	}

	/**
     * Linked to :
     * view/cgu.php
     */
	private function cgu(){

		/* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
		define("PAGE_TITLE", SITE_NAME . " GUC");
		define("PAGE_DESCR", SITE_NAME . "");
		define("PAGE_ID", "cgu");
		
		/* Load the view */
		$this->load->view('page', 'cgu');
	
	}
	
	
}

?>