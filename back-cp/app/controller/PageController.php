<?

/**
* PageController
*
* Affichage des pages sans traitement spécifique // static
*
* @package 		Framework_L&G
* @copyright 	L&G
**/

class PageController extends CoreController{
	
	/**
	* Constructor
	**/
	function __construct(){

		// on déclanche le constructeur de la class parent
		parent::__construct();

		// chargement du model si necessaire
		//$this->model = new Model();

		// Dispatcher des actions du controller
		if((isset($_GET['action'])) || ($_GET['action'] === "home")) {
			$this->index();
		} elseif($_GET['action'] === "cgu"){
			$this->cgu();
		} elseif($_GET['action'] === "apropos"){
			$this->apropos();
		} else{
			$this->corePage404();
		}
	}


	/**
	* Page static INDEX
	**/
	public function home(){
		
		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "home");

		// Appel de la vue
		$this->Load->view('page', 'home');
	}









}