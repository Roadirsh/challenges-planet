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
     * home.php
     *
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
		$AllLastGroups = $Group->SeeGroups($gID);
		//var_dump($AllLastGroups);
		/* Get 1 teams from a finish event */
		$DoneGroup = $Group->SeeDoneGroup($gID);
		// var_dump($DoneGroup); 
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
     * cgu.php
     *
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