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
 * SEE ONE SPONSOR
 */

/* Global Library */
include("../lib/pagination.php");
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
                $this->corePage404();
            }

		} else {
			$this->Seesponsor();
		}
	}


	/**
     * Linked to : 
     * model/SponsorModel.php
     * view/seesponsor.php
     * 
     * Here you will find all the gets of sponsors
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
        $AllSponsor = $AllSponsors->Seesponsor();

		/* Construct the array to pass */
		$array = array();
		$array['sponsors'] = $AllSponsor;

		/* Load the view */
		$this->load->view('sponsor', 'seeSponsor', $array);
	
	}

    /**
     * Linked to : 
     * model/SponsorModel.php
     * view/seesponsor.php
     * 
     * Here you will finds all the informations about one sponsor
     * 
     * @param INT GET ID
     */
    private function Seeonesponsor(){

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
        define("PAGE_TITLE", SITE_NAME . " sponsors");
        define("PAGE_DESCR", SITE_NAME . " All our sponsors");
        define("PAGE_ID", "seeSponsor");
        
        
        $sponsors = $this->model = new SponsorModel();
        $OneSponsors = $sponsors->SeeOneSponsor($_GET['id']);
        $OneSponsorGroup = $sponsors->SeeOneSponsorGroup($_GET['id']);

        /* Construct the array to pass */
        $array = array();
        $array['sponsor'] = $OneSponsors;
        $array['group'] = $OneSponsorGroup;

        /* Load the view */
        $this->load->view('sponsor', 'seeOneSponsor', $array);
    
    }
	
	
}

?>