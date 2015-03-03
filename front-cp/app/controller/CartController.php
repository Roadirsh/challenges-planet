<?php 

/**
 * CartController
 *
 * Everything who is relative to the cart
 * 
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

/**
 * CHECK IF IS IN STOCK
 * GET USERS INFO
 * CHECK IF USER EXIST
 * CHECK IF EMAIL EXIST
 * INSERT USER
 * INSERT DONATION
 */

class CartController extends CoreController {
	
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
            $this->Seeonecart();
		}
	}
    
    /**
     * Linked to : 
     * model/CartModel.php
     * view/cart/*.php
     * 
     * Here, you will have all informations needed to show up the last page of the cart
     * VALIDATION
     * 
     * @param GET ID
     */
	public function Seecart(){
	    
	    $stockID = $_GET['id'];
	    
	    // if stock product
        $isStock = $this->model = new CartModel();
		$Stock = $isStock->isStock($stockID);

	    if(!empty($Stock)){
    	    
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * <head> STUFF </head>
            */
    		define("PAGE_TITLE", SITE_NAME . " - Cart");
    		define("PAGE_DESCR", ""); // TODO
    		define("PAGE_ID", "home");

            /* Put information into SESSION */
            $this->coreSession('CART', '1', array(''));

            /* Load the view */
            $this->load->view('cart', 'validation');

	    } else {
	        $this->coreRedirect('notfound', 'notfound');
	    }
	    
	}


    /**
     * Linked to :
     * view/cart/*.php
     * 
     * Here, you will have all informations needed to show up the first page of the cart
     * SEE THE CART
     */
    public function Seeonecart(){

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
        define("PAGE_TITLE", SITE_NAME);
        define("PAGE_DESCR", SITE_NAME);
        define("PAGE_ID", "SeeOneCart");

        /* Construct the array to pass */
        $array = '';

        /* Load the view */
        $this->load->view('cart', 'SeeOneCart', $array); 

    }

    /**
     * Linked to : 
     * model/CartModel.php
     * view/cart/*.php
     * 
     * Here, you will have all informations needed to show up the second page of the cart
     * SEE THE INFORMATIONS
     */
    public function Seeinfocart(){

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
        define("PAGE_TITLE", SITE_NAME);
        define("PAGE_DESCR", SITE_NAME);
        define("PAGE_ID", "seeinfocart");
        
        $user = $this->model = new CartModel();
        
		if(isset($_SESSION[PREFIX . 'userID']))
		{
        	$array = $user->getInfoUser($_SESSION[PREFIX . 'userID']);
        }
        else{
	        $array = "";
        }

        /* Load the view */
        $this->load->view('cart', 'seeinfocart', $array); 

    }

    /**
     * Linked to : 
     * model/CartModel.php
     * view/cart/*.php
     * 
     * Here, you will have all informations needed to show up the third page of the cart
     * LET'S PAY
     */
    public function Paiement(){

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
        define("PAGE_TITLE", SITE_NAME);
        define("PAGE_DESCR", SITE_NAME);
        define("PAGE_ID", "paiement");

        $user = $this->model = new CartModel();
        
        /* * * * * * * * * * * * * * * * * * * * * * * * *
        * INSERT USER + CONNEXION
        */
        if(isset($_POST['user_password'])){
	        $userExist = $user->insertNewUser();
	        if($userExist){
		        $_SESSION['message'] = "Seems to be a problem, please verify you informations !";
                $_SESSION['messtype'] = 'danger';
		        $this->coreRedirect('cart', 'seeinfocart');
	        }
	        else{
		        $array = "";
		        $this->load->view('cart', 'paiement', $array);
	        }
	         
        }
        /* * * * * * * * * * * * * * * * * * * * * * * * *
        * UPDATE USER
        */
        else if (isset($_POST['user_mail']))
        {
	    	
	    	$userExist = $user->Uponeuser();
	        if($userExist){
                $_SESSION['message'] = "Seems to be a problem, please verify you informations !";
                $_SESSION['messtype'] = 'danger';
		        $this->coreRedirect('cart', 'seeinfocart');
	        }
	        else{
		        $array = "";
		        $this->load->view('cart', 'paiement', $array);
	        }
        }

        

    }

    /**
     * Linked to :
     * view/cart/*.php
     * 
     * Here, you will have all informations needed to show up the fourth page of the cart
     * Show the user a confirmation of what he did 
     * ASK FOR VALIDATION
     */
    public function Confirmation(){

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
        define("PAGE_TITLE", SITE_NAME);
        define("PAGE_DESCR", SITE_NAME);
        define("PAGE_ID", "confirmation");
        
        /* Load the view */
        // In a V2 project, we will implement the real paiement via visa card
	        $array = '';
	        $this->load->view('cart', 'confirmation', $array); 
			$_SESSION['doneff'] = false;
        
        
    }

    /**
     * Linked to :
     * view/addEvent.php
     * 
     * Here, you will have all informations needed to show up the third page of the cart
     * Give the user a summury
     */
    public function Seesummary(){

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
        define("PAGE_TITLE", SITE_NAME);
        define("PAGE_DESCR", SITE_NAME);
        define("PAGE_ID", "seeSummary");
        
        $cart = $this->model = new CartModel();
        if($_SESSION['doneff'] == false){
	        $_SESSION['doneff'] = $cart->donate();
	        
	        if($_SESSION['doneff'] == false){
 		        $_SESSION['message'] = "Seems to be a problem, please verify you informations !<br>
                                        - 13 or 16 numbers who begins with a 4 is required for your cart number<br>
                                        - 3 numbers only for the cryptogram<br>
                                        - date is mm/YY";
                $_SESSION['messtype'] = 'danger long';	 		      
 		        $this->coreRedirect('cart', 'confirmation');
 	        }		 	        
	        else{
		        $cart->sendMail();
	        }
			

        }

        $array = '';
        
        /* Load the view */
        $this->load->view('cart', 'seeSummary', $array); 

    }

}
