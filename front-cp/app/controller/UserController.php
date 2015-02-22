<?php 

/**
 * UserController
 *
 * Everything who is relative to a USER
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * SEE ONE USER
 */
/* Global Library */
include("../lib/pagination.php");
class UserController extends CoreController {

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
			if(isset($_SESSION['user']) != ''){
				$this->Seeuser();
			} else {
				$this->coreRedirect('user', 'login');
			}
		}
	}
	
	/**
     * addEvent.php
     *
     * @param INT $_GET ID
     */
	private function SeeOneUser(){
		
        $showUser = $this->model = new UserModel();

        /* * * * * * * * * * * * * * * * * * * * * * * * *
        * Information about one user only
        */
		$oneUser = $showUser->SeeOneUser();

		/* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
		define("PAGE_TITLE", SITE_NAME . " User name"); // TODO
		define("PAGE_DESCR", SITE_NAME . " user name"); // TODO
		define("PAGE_ID", "seeOneUser");

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * Age telling
        */
        $date = new DateTime($oneUser['user_birthday']);
        $now = new DateTime();
        $interval = $now->diff($date);
        $age = $interval->y;


		/* Construct the array to pass */
		$array = array();
		$array['user'] = $oneUser;
        $array['user']['age'] = $age;
        /* Load the view */
		$this->load->view('user', 'seeOneUser', $array);
	
	}
}

?>