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
            $this->$action();
            

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
	 * Voir l'ensemble des utilisateurs différents des admins
	 */
	public function Seeuser(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeUser");
		
        $showUser = $this->model = new UserModel();
		$AllUser = $showUser->Seeuser();
		// UserModel::Seeuser();
		
		// echo 'user = '; var_dump($AllUser);

		
		// Appel de la vue 
		$this->load->view('user', 'seeUser', $AllUser); // TODO
	
	}
	
	/**
	 * Voir UN utilisateur avec sont évenement associé et son groupe
	 */
	public function Seeoneuser(){
		
        $showOneUser = $this->model = new UserModel();
		$OneUser = $showOneUser->Seeoneuser();
		
		
		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " - " . $OneUser[0]['user_firstname'] . "");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeUser");
		
		
		// UserModel::Seeuser();
		
		// echo 'user = '; var_dump($AllUser);

		
		// Appel de la vue 
		$this->load->view('user', 'seeOneUser', $OneUser); // TODO
	
	}
	
	/**
	 * Ajouter un utilisateur
	 *
	 * @param array $_POST
	 */
	public function Adduser(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "addUser");
		if(isset($_POST) and !empty($_POST)){
			$userAdd = $this->model = new UserModel($_POST);
            $Existdeja = $userAdd->insertNewUser();
		}

		// Appel de la vue 
		if(isset($Existdeja) and $Existdeja == true )
		{
			$this->load->view('user', 'addUser', $Existdeja);
		}
		else
		{
			$this->load->view('user', 'addUser');
		}
	
	}
	
	/**
	 * Supprimer un utilisateur
	 */
	public function Deluser(){
	
        $deleteUser = $this->model = new UserModel();
		$DeleUser = $deleteUser->Deluser();
		$_SESSION['message'] = "The user has been well deleted";
		
		$this->coreRedirect('user', 'seeUser');
	
	}
	
}

?>