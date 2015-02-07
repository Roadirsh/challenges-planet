<?php 

/**
 * SponsorController
 *
 * Everything who is relative to a SPONSOR
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * SEE SPONSOR
 */
class SponsorController extends CoreController {

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
                $this->coreRedirect('notfound', 'notfound');
            }

		} else {
			// is their a session or not?
			if(isset($_SESSION['user']) != ''){
				$this->Seesponsor();
			} else {
				$this->coreRedirect('user', 'login');
			}
		}
	}


	/**
     * seeSponsor.php
     *
     */
	private function Seesponsor(){

		/* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
		define("PAGE_TITLE", SITE_NAME . " sponsors");
		define("PAGE_DESCR", SITE_NAME . " All our sponsors");
		define("PAGE_ID", "seeSponsor");
		
		
		$AllSponsors = $this->model = new SponsorModel();
		/* All sponsors who gave */
        $AllSponsor = $AllSponsors-> Seesponsor();

		/* Construct the array to pass */
		$array = array();
		$array['sponsors'] = $AllSponsor;

		/* Load the view */
		$this->load->view('sponsor', 'seeSponsor', $array);
	
	}
	
	
}

?>