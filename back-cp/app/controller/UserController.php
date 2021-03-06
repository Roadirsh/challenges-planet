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
			if(method_exists($this, $action))
			{
            	$this->$action();
            }
            else
            {
	            $this->Seeuser();
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
	 * Voir l'ensemble des utilisateurs différents des admins
	 */
	public function Seeuser(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " home");
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeUser");
		
		
		if(isset($_POST) and !empty($_POST)){
		    //var_dump($_POST);
            $search = $this->model = new UserModel($_POST);
            $AllUser = $search->searchUser($_POST);
            $_POST = null;
		} else{
    		$showUser = $this->model = new UserModel();
            $AllUser = $showUser->Seeuser();
            // UserModel::Seeuser();
		}
        
		
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
		define("PAGE_TITLE", SITE_NAME . " - " . $OneUser['user'][0]['user_lastname']); // " . $OneUser[0]['user_firstname'] . "
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeUser");
		
		// Appel de la vue 
		$this->load->view('user', 'seeOneUser', $OneUser); // TODO
	
	}
	
	/**
	 * Voir UN admin
	 */
	public function Seeoneadmin(){
		
        $showOneAdmin = $this->model = new UserModel();
		$OneAdmin = $showOneAdmin->Seeoneadmin();
		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " - " . $OneAdmin['user'][0]['user_pseudo']); // " . $OneUser[0]['user_firstname'] . "
		define("PAGE_DESCR", SITE_NAME . " est un site génial"); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "seeUser");
		
		// Appel de la vue 
		$this->load->view('user', 'seeOneAdmin', $OneAdmin); // TODO
	
	}
	
	/**
	 * Modifier UN admin
	 */
	public function Uponeadmin(){
	
	    $upOneAdmin = $this->model = new UserModel();
		$upAdmin = $upOneAdmin->Uponeadmin();
		
		$_SESSION['message'] = "You've succeed in updating your profil";
		$this->coreRedirect('user', 'seeOneAdmin');
	
	}
	
	/**
	 * Modifier UN user
	 */
	public function Uponeuser(){
	
	    $upOneUser = $this->model = new UserModel();
		$upUser = $upOneUser->Uponeuser();
				
		
		$_SESSION['message'] = "You've succeed in updating your profil";
		$this->coreRedirect('user', 'seeoneuser', $upUser);
	
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