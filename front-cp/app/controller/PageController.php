<?php 

/**
 * PageController
 *
 * Affichage des pages sans traitement spécifique // static
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */
 

class PageController extends CoreController {

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
				$this->Home();
			} else {
				//$this->coreRedirect('user', 'login');
				// temporaire
				$this->Home();
			}
		}
	}


	/**
	 * Page static INDEX
	 */
	public function Home(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", "Plateforme de mise en relation d'étudiants et entreprises dans le cadre de participation d'évènement sportifs à sponsoriser"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "home");

		$Group = $this->model = new PageModel();
		$AllfourEvents = $Group->SeeFourEvents();
		$AllLastGroups = $Group->SeeLastGroups();
		$DoneGroup = $Group->SeeDoneGroup();
		$AllLastSponsors = $Group->SeeLastSponsors();
		
		$array = '';
		$array['slider'] = $AllfourEvents;
		$array['group'] = $AllLastGroups;
		$array['sponsor'] = $AllLastSponsors;
		$array['done'] = $DoneGroup;

        $i = 0;
		foreach($array['group'] as $k => $t){
		    $CountLastGroups = $Group->CountLastGroups($t['group_id']);
		    $CountDonut = $Group->CountDonut($t['group_id']);
		    // var_dump($CountDonut);
		    $array['group'][$i] = array_merge($t, $CountLastGroups, $CountDonut);
		    $i ++;
		}
		//var_dump($array['group']);
		
		// Appel de la vue 
		$this->load->view('page', 'home', $array); // TODO
	
	}
	
	/**
	 * Page static INDEX
	 */
	public function Notfound(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " - ERROR"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "notfound");
		
		// Appel de la vue 
		$this->load->view('layout', 'notfound'); // TODO
	
	}

	/**
	 * Page static INDEX
	 */
	public function cgu(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " - ERROR"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "notfound");
		
		// Appel de la vue 
		$this->load->view('page', 'cgu'); // TODO
	
	}
	
	
}

?>