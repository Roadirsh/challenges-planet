<?php 

/**
 * ProjetController
 *
 * Affichage des pages sans traitement spécifique // static
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */
 
//$logger->log('test', 'loadapp', "Chargement du controller page", Logger::GRAN_MONTH);

class ProjectController extends CoreController {

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
				$this->Seeproject();
			} else {
				$this->coreRedirect('user', 'login');
			}
		}
	}


	/**
	 * Page
	 */
	public function Seeproject(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeProject");
		
		
		$AllGroups = $this->model = new ProjectModel();
        $AllGroup = $AllGroups-> getShowProjects();
        //var_dump($AllGroup);

		// Appel de la vue 
		$this->load->view('project', 'seeProject', $AllGroup); // TODO
	
	}
	
	/**
	 * Page
	 */
	public function Addproject(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "addProject");
		
		if(isset($_POST) and !empty($_POST)){
			$projectAdd = $this->model = new ProjectModel($_POST);
			$projectAdd->insertNewProject();
		}
		
		// Appel de la vue 
		$this->load->view('project', 'addProject'); // TODO
	
	}
	
}

?>