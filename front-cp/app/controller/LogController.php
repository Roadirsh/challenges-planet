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

            if(method_exists($this, $action)){
                $this->$action();
            } else{
                $this->corePage404();
            }


        } else {
            // is their a session or not?
            if (isset($_SESSION['user']) != '') {
                $this->Login();
            } else {
                $this->coreRedirect('', 'login');
            }
        }

	}
	
	/**
     * home.php => fancybox
     *
     * @param Array $_POST
     */
	public function Login(){
		
		
        require(ROOT . 'conf/messages.php');
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
				// initialization of the messages
				$_SESSION['message'] = $messageInfo['USER_LOGIN_OK'];
				$_SESSION['messtype'] = 'success';
				
				$this->coreRedirect('page', 'home');
			} else{
				$_POST = array();
                $messageErreur = '';
				// initialization of the messages
				$_SESSION['message'] = $messageErreur['USER_LOGIN_NOK'];
				$_SESSION['messtype'] = 'danger';	
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
        $_SESSION['connect_compte_FRONT'] = false;
        unset($_SESSION['cp_userID'], $_SESSION['cp_userPseudo'], $_SESSION['cp_user']);
		//session_unset('ChallengesPlanet');
		$this->coreRedirect('page', 'home');
	}
	
	/**
     * signup.php 
     *
     * @param Array $_POST
     */
	public function Signup(){

		include(ROOT . "conf/messages.php");

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

			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$addUser = $user->Signup($_POST);
				if($addUser){
                    $messageInfo = '';
					// initialization of the messages
					$_SESSION['message'] = $messageInfo['USER_SIGN_OK'];
					$_SESSION['messtype'] = 'success';	
	    			$this->coreRedirect('page', 'home');
				} else{
                    $messageErreur = '';
					// initialization of the messages
					$_SESSION['message'] = $messageErreur['USER_SIGN_NOK'];
					$_SESSION['messtype'] = 'danger';
					$this->load->view('connexion', 'signup');
				}
			} else{
                $messageErreur = '';
				// initialization of the messages
				$_SESSION['message'] = $messageErreur['USER_SIGN_NOK'];
				$_SESSION['messtype'] = 'danger';
				$this->load->view('connexion', 'signup');
			}
		}
		
		/* Load the view */
		$this->load->view('connexion', 'signup');

	}

    public function FacebookLogin(){


        $appID = '1032282680121355';
        $appSecret = 'd23586cd9525f8fcdfc8b96bf6eb2985';

        $connect = new FacebookConnect($appID, $appSecret);

        $user = $connect->connect('http://localhost:8888/challenges-planet/front-cp/public/index.php');

        var_dump($user);
    }


}