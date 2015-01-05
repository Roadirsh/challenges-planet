<?php 

/**
 * SponsorController
 *
 * Affichage des sponsors
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

class SponsorController extends CoreController {

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
				$this->Seesponsor();
			} else {
				$this->coreRedirect('user', 'login');
			}
		}
	}


	/**
	 * Page
	 */
	public function Seesponsor(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeProject");
		
		
		$AllSponsors = $this->model = new SponsorModel();
        $AllSponsor = $AllSponsors-> Seesponsor();
        //var_dump($AllGroup);

        echo '<h1>VAR_DUMP: l\'ensemble sponsors ayant déjà fait un don</h1>';
		var_dump($AllSponsor);
		// Appel de la vue 
		$this->load->view('sponsor', 'seeSponsor', $AllSponsor); // TODO
	
	}
	
	
}

?>