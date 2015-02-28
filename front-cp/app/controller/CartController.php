<?php 

/**
 * CartController
 *
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

class CartController extends CoreController {
	
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
                $this->corePage404();
            }
            

		} else {
			// on test voir s'il y a une sesison ou non
			if(isset($_SESSION['user']) != ''){
				$this->Seeonecart();
			} else {
				$this->coreRedirect('user', 'login');
			}
		}
	}
    
    /**
	 * Page static INDEX
	 */
	public function Seecart(){
	    
	    $stockID = $_GET['id'];
	    
	    // if stock product
        $isStock = $this->model = new CartModel();
		$Stock = $isStock->isStock($stockID);
		var_dump($Stock);
	    if(!empty($Stock)){
    	    // Appel de la vue 
    	   // Définition des constante
    		define("PAGE_TITLE", SITE_NAME . " home");
    		define("PAGE_DESCR", ""); // TODO
    		define("PAGE_ID", "home");
            $this->coreSession('CART', '1', array(''));
            $this->load->view('cart', 'validation'); // TODO
	    } else {
	        echo 'ba non....';
    	    //$this->coreRedirect('notfound', 'notfound');
	    }
	    
	}



    public function Seeonecart(){

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
        define("PAGE_TITLE", SITE_NAME);
        define("PAGE_DESCR", SITE_NAME);
        define("PAGE_ID", "SeeOneCart");

        $array = '';
        /* Load the view */
        $this->load->view('cart', 'SeeOneCart', $array); 

    }
    public function Seeinfocart(){

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
        define("PAGE_TITLE", SITE_NAME);
        define("PAGE_DESCR", SITE_NAME);
        define("PAGE_ID", "seeinfocart");
        
        $user = $this->model = new CartModel();
        
		if(isset($_SESSION['cp_userID']))
		{
        	$array = $user->getInfoUser($_SESSION['cp_userID']);
        }
        else{
	        $array = "";
        }
        /* Load the view */
        $this->load->view('cart', 'seeinfocart', $array); 

    }
    public function Paiement(){

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
        define("PAGE_TITLE", SITE_NAME);
        define("PAGE_DESCR", SITE_NAME);
        define("PAGE_ID", "paiement");

        $array = '';
        /* Load the view */
        $this->load->view('cart', 'paiement', $array); 

    }
    public function Confirmation(){

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
        define("PAGE_TITLE", SITE_NAME);
        define("PAGE_DESCR", SITE_NAME);
        define("PAGE_ID", "confirmation");

        $array = '';
        /* Load the view */
        $this->load->view('cart', 'confirmation', $array); 

    }
    public function Seesummary(){

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
        define("PAGE_TITLE", SITE_NAME);
        define("PAGE_DESCR", SITE_NAME);
        define("PAGE_ID", "seeSummary");

        $array = '';
        /* Load the view */
        $this->load->view('cart', 'seeSummary', $array); 

    }

}
