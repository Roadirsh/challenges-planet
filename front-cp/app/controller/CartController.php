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
                $this->coreRedirect('notfound', 'notfound');
            }
            

		} else {
			// on test voir s'il y a une sesison ou non
			if(isset($_SESSION['user']) != ''){
				$this->Seecart();
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
    		define("PAGE_KW", SITE_NAME); // TODO
    		define("PAGE_ID", "home");
            $this->coreSession('CART', '1', array(''));
            $this->load->view('cart', 'validation'); // TODO
	    } else {
	        echo 'ba non....';
    	    //$this->coreRedirect('notfound', 'notfound');
	    }
	    
	}
	
	/**
	 * 
	 */
	public function ModifyCart(){
        // SI CHANGEMENT DE QUANTITE
    }
    
    /**
	 * 
	 */
	public function ValidateCart(){
	    // INSCRIPTION 
	    // DONATION ++
    }


}
