<?php 

/**
 * LogController
 *
 * All manipulations relative to the action of login log out sign up
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * LOGIN
 * LOGOUT
 * SIGN UP
 */
class LogController extends CoreController{

	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
		if(isset($_GET['action'])){
			//ucfirt = put the first letter in Uppercase
			$action = ucfirst($_GET['action']);
			
			$this->$action();

		} else {
			// is their a session or not?
			if(isset($_SESSION['']) != ''){
				$this->coreRedirect('', 'login');
			} else {
				$this->Login();

			}
		}

	}
	
	/**
     * home.php => fancybox
     *
     * @param Array $_POST
     */
	public function Login(){
		
		if(isset($_POST['email']) && !empty($_POST['email'])){

			/* * * * * * * * * * * * * * * * * * * * * * * *
	        * 1. unset session if their is one, to build a new one
	        */
			session_unset();

			/* * * * * * * * * * * * * * * * * * * * * * * *
	        * 2. Test if login == password
	        */
			$isUser = $this->model = new LogModel($_POST);
			$User = $isUser->Login($_POST);
			
			/* * * * * * * * * * * * * * * * * * * * * * * *
	        * 3. Load the view
	        */
	        // testing connexion is true
			if($User != 0){
				$_POST = array();
				$this->coreRedirect('page', 'home');
			} else{
				
				$this->coreRedirect('page', 'home');
			}
		} else {
			
			$this->coreRedirect('page', 'home');
		}
	}


	/**
     * home.php 
     *
     */
	public function Logout(){
		session_unset();
		session_destroy();
		$this->coreRedirect('page', 'home');
	}
	
	/**
     * signup.php 
     *
     * @param Array $_POST
     */
	public function Signup(){

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
		define("PAGE_TITLE", SITE_NAME . " - Sign up!");
		define("PAGE_DESCR", SITE_NAME . " sign up!");
		define("PAGE_ID", "signup");
		
		$user = $this->model = new LogModel();
		
		/* * * * * * * * * * * * * * * * * * * * * * * * *
        * WHITH FORM $_POST testing email and password
        */
		if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['pwd']) && !empty($_POST['pwd'])){
			$addUser = $user->Signup($_POST);
			if($addUser){
    			$this->coreRedirect('page', 'home');
			}
		}
		
		/* Load the view */
		$this->load->view('connexion', 'signup');

	}

		
}