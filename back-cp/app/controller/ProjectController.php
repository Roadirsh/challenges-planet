<?php 

/**
 * ProjetController
 *
 * Affichage des pages sans traitement spécifique // static
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

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
	 * Voir l'ensemble des projets
	 */
	public function Seeproject(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeProject");
		
		if(isset($_POST['search']) and !empty($_POST['search'])){
		    //var_dump($_POST);
            $search = $this->model = new ProjectModel($_POST);
            $AllGroup = $search->searchProject($_POST);
            $_POST = null;
		} else{
    		$AllGroups = $this->model = new ProjectModel();
            $AllGroup = $AllGroups-> getShowProjects();
            // UserModel::Seeuser();
            //var_dump($AllGroup);
		}
		
		
        

		// Appel de la vue 
		$this->load->view('project', 'seeProject', $AllGroup); // TODO
	
	}
	
	/**
	 * Voir UN projet
	 */
	public function Seeoneproject(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeProject");
		
		
		$OneGroups = $this->model = new ProjectModel();
        $OneGroup = $OneGroups-> Seeoneproject();


		// Appel de la vue 
		$this->load->view('project', 'seeOneProject', $OneGroup); // TODO
	
	}
	
	/**
	 * Ajouter un projet
	 *
	 * @param array $_POST
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
	
	/**
	 * Supprimer un projet
	 */
	public function Delproject(){
	
        $deleteProject = $this->model = new ProjectModel();
		$DeleProject = $deleteProject->Delproject();
		$_SESSION['message'] = "The project group has been well deleted";
		$this->coreRedirect('project', 'seeProject', $message);
	
	}
	
}

?>