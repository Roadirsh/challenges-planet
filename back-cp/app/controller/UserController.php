<? 

/**
 * UserController
 *
 * Traitements relatifs au user
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

echo 'lili';
class UserController extends CoreController{
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
				$this->NbUsers();
			} else {
				$this->Login();

			}
		}

	}

	/**
	 * Login
	 */
	public function Login(){
		
		if(isset($_POST['login'])){
			echo 'post';
			// on rétabli les paramètres à zéro pour établir une nouvelle connexion
			session_unset();

			// Charger le modèle pour vérifier le login et mot de passe
			$isUser = $this->model = new UserModel();

			$user = $isUser->Login($_POST);
			
			// var_dump($_SESSION);
			// Appel de la vue
			if($user != 0){
				echo 'oui';
				$_POST = array();

				$this->coreRedirect('page', 'home');
				// header('location:index.php');

			} else{
				// Dispatcher des actions du controller
				define("PAGE_TITLE", "Login"); // TODO
				define('PAGE_DESCR', "Se connecter pour acceder au Dashboard."); // TODO
				define("PAGE_KW", "login, etc"); // TODO
				define("PAGE_ID", "page_login"); // TODO

				// on recharge la page de la connexion + message
				$this->load->view('connexion', 'login'); // TODO
				//$mess = $_SESSION["coreMessage"] = $messageErreur["USER_LOGIN_NOK"]; // TODO
				//$this->coreEcrireMessage($mess);
			}
		} else {
			// Dispatcher des actions du controller
			define("PAGE_TITLE", "Login"); // TODO
			define('PAGE_DESCR', "Se connecter pour acceder au Dashboard."); // TODO
			define("PAGE_KW", "login, etc"); // TODO
			define("PAGE_ID", "page_login"); // TODO

			// si il n'y a pas de formulaire 
			$this->load->view('connexion', 'login');
		}
	}


	/**
	 * Logout
	 */
	public function Logout(){

		$_SESSION['user'] == '';
		session_unset();
		session_destroy();
		$this->coreRedirect('user', 'login');
		// $this->model = new LogoutModel();
		// redirection dans le fichier UserModel

	}

		
}