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
 * MY PAGE
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
                if($action == 'SeeMyPage'){
                    if(isset($_SESSION[PREFIX . 'userID']) != ''){
                        $this->SeeMyPage();
                    } else {
                        $this->coreRedirect('page', 'home');
                    }
                } else {
                    $this->$action();
                }
                
            } else{
                $this->corePage404();
            }
            

		} else {
			$this->SeeOneUser();
		}
	}
	
	/**
     * Linked to : 
     * model/UserModel.php
     * view/seemypage.php
     *
     * Here you will find all information about the user in session 
     * You also can update it here. 
     * 
     * @param $_SESSION
     */
	private function SeeMyPage(){
		
        $showUser = $this->model = new UserModel();

        /* * * * * * * * * * * * * * * * * * * * * * * * *
        * Information about one user only
        */

		$oneUser = $showUser->SeeMyPage();
        $oneUserEvents = $showUser->SeeMyPageEvents($_SESSION[PREFIX . 'userID']);
        $oneUserGroups = $showUser->SeeMyPageGroups($_SESSION[PREFIX . 'userID']);

        if(isset($_POST) && !empty($_POST)){
            



            
        }
		/* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
		define("PAGE_TITLE", SITE_NAME . " User name"); // TODO
		define("PAGE_DESCR", SITE_NAME . " user name"); // TODO
		define("PAGE_ID", "seeMyPage");

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
        $array['events'] = $oneUserEvents;
        $array['groups'] = $oneUserGroups;
        /* Load the view */
		$this->load->view('user', 'seeMyPage', $array);
	
	}

    /**
     * Linked to : 
     * model/UserModel.php
     * view/seeoneuser.php
     *
     * Here you will find all information about the user 
     * 
     * @param INT $_GET ID
     */
    private function SeeOneUser(){

        $showUser = $this->model = new UserModel();

        $oneUser = $showUser->SeeOneUser($_GET['id']);

        if(!empty($oneUser)){
            $oneUserEvents = $showUser->SeeOneUserEvents($_GET['id']);
            $oneUserGroups = $showUser->SeeOneUserGroups($_GET['id']);

            /* * * * * * * * * * * * * * * * * * * * * * * *
            * <head> STUFF </head>
            */
            define("PAGE_TITLE", SITE_NAME . " User name"); // TODO
            define("PAGE_DESCR", SITE_NAME . " user name"); // TODO
            define("PAGE_ID", "seeMyPage");

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
            $array['events'] = $oneUserEvents;
            $array['group'] = $oneUserGroups;

            /* Load the view */
            $this->load->view('user', 'seeOneUser', $array);
        } else {
            /* Load the view */
            $this->coreRedirect('notfound', 'notfound');
        }
    }
}

?>