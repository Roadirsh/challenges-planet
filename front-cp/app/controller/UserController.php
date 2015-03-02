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
		
        $id = $_SESSION[PREFIX . 'userID'];
        $showUser = $this->model = new UserModel();

        /* * * * * * * * * * * * * * * * * * * * * * * * *
        * LET'S UPDATE
        */
        if(isset($_POST) && !empty($_POST)){
            if(isset($_POST['mp_pseudo']) && !empty($_POST['mp_pseudo'])){
                /* * * * * * * * * * * * * * * * * * * * * * * * *
                * CHANGE PSEUDO
                */
                $newpseudo = $showUser->updatePseudo($_POST['mp_pseudo'], $id);
                $_POST = null;
                // initialization of the messages
                $_SESSION['message'] = "Your pseudo has been well updated ! ";
                $_SESSION['messtype'] = 'success';
            }
            elseif(isset($_POST['mp_site'])){
                /* * * * * * * * * * * * * * * * * * * * * * * * *
                * CHANGE URL WEB SITE
                */
                $newwebsite = $showUser->updateWebsite($_POST['mp_site'], $id);
                $_POST = null;
                // initialization of the messages
                $_SESSION['message'] = "Your WebSite has been well updated ! ";
                $_SESSION['messtype'] = 'success';
            }
            elseif(isset($_POST['mp_phone']) && !empty($_POST['mp_phone'])){
                /* * * * * * * * * * * * * * * * * * * * * * * * *
                * CHANGE PHONE NUMBER
                */
                $newphone = $showUser->updatePhone($_POST['mp_phone'], $id);
                // initialization of the messages
                $_SESSION['message'] = "Your phone number has been well updated ! ";
                $_SESSION['messtype'] = 'success';
            }
            elseif(isset($_POST['mp_num']) && !empty($_POST['mp_num']) 
                && isset($_POST['mp_street']) && !empty($_POST['mp_street'])
                && isset($_POST['mp_city']) && !empty($_POST['mp_city'])
                && isset($_POST['mp_zip']) && !empty($_POST['mp_zip'])
                && isset($_POST['mp_country']) && !empty($_POST['mp_country'])){
                /* * * * * * * * * * * * * * * * * * * * * * * * *
                * CHANGE ADRESS PLACE
                */
                $array = array();
                $array['mp_num'] = $_POST['mp_num'];
                $array['mp_street'] = $_POST['mp_street'];
                $array['mp_zip'] = $_POST['mp_zip'];
                $array['mp_city'] = $_POST['mp_city'];
                $array['mp_country'] = $_POST['mp_country'];

                $newadress = $showUser->updateAdress($array, $id);
                $_POST = null;
                // initialization of the messages
                $_SESSION['message'] = "Your Adress has been well updated ! ";
                $_SESSION['messtype'] = 'success';
            }
            elseif(isset($_POST['mp_email']) && !empty($_POST['mp_email'])){
                if(filter_var($_POST['mp_email'], FILTER_VALIDATE_EMAIL)){
                    /* * * * * * * * * * * * * * * * * * * * * * * * *
                    * CHANGE EMAIL
                    */
                    $newmail = $showUser->updateMail($_POST['mp_email'], $id);
                    $_POST = null;
                    // initialization of the messages
                    $_SESSION['message'] = "Your email has been well updated ! ";
                    $_SESSION['messtype'] = 'success';
                }
            }
            elseif(isset($_POST['mp_pwd']) && !empty($_POST['mp_pwd'])){
                /* * * * * * * * * * * * * * * * * * * * * * * * *
                * CHANGE PASSWORD
                */
                $newpwd = $showUser->updatePwd($_POST['mp_pwd'], $id);
                $_POST = null;
                // initialization of the messages
                $_SESSION['message'] = "Your password has been well updated ! ";
                $_SESSION['messtype'] = 'success';
            }else{
                // initialization of the messages
                $_SESSION['message'] = "Seems to be a problem during the update, please try again ! ";
                $_SESSION['messtype'] = 'danger';
            }

        }

        /* * * * * * * * * * * * * * * * * * * * * * * * *
        * Information about one user only
        */
        $oneUser = $showUser->SeeMyPage();
        $oneUserEvents = $showUser->SeeMyPageEvents($_SESSION[PREFIX . 'userID']);
        $oneUserGroups = $showUser->SeeMyPageGroups($_SESSION[PREFIX . 'userID']);

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