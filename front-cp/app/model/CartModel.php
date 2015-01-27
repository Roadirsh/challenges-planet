<?php 

/**
 * Model
 *
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

/**
 * choix de l'action
 * instanciation de la class
 */

class CartModel extends CoreModel{

	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
	}
	
	public function isStock($id){
    	
    	try {
        	$select = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "group
                                                WHERE group_id = " . $id);
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $isStock = $select -> FetchAll();
            
            //var_dump($isStock); exit();
            return $isStock;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
}