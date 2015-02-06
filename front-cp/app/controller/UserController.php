<?php 

/**
 * UserController
 *
 * Affichage des pages sans traitement spécifique // static
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

			
class UserController extends CoreController {

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
				$this->Seeuser();
			} else {
				$this->coreRedirect('user', 'login');
			}
		}
	}
	
	/**
	 * 
	 */
	public function SeeOneUser(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeOneUser");
		
        $showUser = $this->model = new UserModel();
		$oneUser = $showUser->SeeOneUser();


		
		// Appel de la vue 
		$this->load->view('user', 'seeUser', $OneUser); // TODO
	
	}
}

?>