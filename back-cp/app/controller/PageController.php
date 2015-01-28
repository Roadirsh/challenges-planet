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
			$this->$action();

		} else {
			// on test voir s'il y a une sesison ou non
			if(isset($_SESSION['user']) != ''){
				$this->Home();
			} else {
				$this->coreRedirect('user', 'login');
			}
		}
	}


	/**
	 * Page static ACCUEIL
	 */
	public function Home(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "home");

		if(isset($_POST) and !empty($_POST)){
		    var_dump($_POST);
            $search = $this->model = new PageModel($_POST);
            $searchAll = $search->searchAll($_POST);
            $this->coreRedirect('page', 'result', $searchAll);
		} else{
    		$count = $this->model = new PageModel();
            $NbUser = $count->NbUsers();
            $NbEvent = $count->NbEvents();
            $NbGroup = $count->NbGroups();
            $NbDonat = $count->NbDonat();
		}
		
		
		$countArray = '';
		$countArray['user'] = $NbUser;
		$countArray['event'] = $NbEvent;
		$countArray['group'] = $NbGroup;
		$countArray['donat'] = $NbDonat;
		
		//var_dump($countArray);
		
		// Appel de la vue 
		$this->load->view('page', 'home', $countArray); // TODO
	
	}
	
	/**
	 * Page static EQUIPE ADMINS
	 */
	public function Team(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "team");
		
		$Allteamusers = $this->model = new PageModel();
		$AllTeam = $Allteamusers->Seeteam();
		
		// Appel de la vue 
		$this->load->view('page', 'team', $AllTeam); // TODO
	
	}
	
	/**
	 * Suppression d'un membre de l'équipe si SUPER ADMIN
	 */
	public function Delteam(){
	
        $deleteTeam = $this->model = new PageModel();
		$DeleTeam = $deleteTeam->Delteam();
		$_SESSION['message'] = "The admin has been well deleted";
		$this->coreRedirect('page', 'team', $message);
	
	}
	
	/**
	 * Page static RESULTATS
	 */
	public function Result($searchUser){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "team");
		
		// Appel de la vue 
		$this->load->view('page', 'result', $searchUser); // TODO
	
	}
	
	
}

?>