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
	
	public function getInfoUser($id){
    	//var_dump($GLOBALS);
    	$userID = $id;
    	try {
    	    
    	    $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "user
                                            WHERE  user_id = " . $userID . "");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser = $select -> FetchAll();

            $oneuserID = $OneUser[0]['user_id'];
         
            $select1 = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "adress A  
                                            WHERE   A.user_user_id = " . $oneuserID . " AND ad_type = 'invoice'");

            $select1 -> execute();
            $select1 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser1 = $select1 -> FetchAll();
            
            $select2 = $this->connexion->prepare("SELECT * FROM " . PREFIX . "phone B WHERE B.user_user_id = " . $oneuserID . "");
            $select2->execute();
            $select2 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser2 = $select2 -> FetchAll();

            $array = "";
            $array['user'] = $OneUser;
            $array['info'] = $OneUser1;
            $array['phone'] = $OneUser2;    	  

            return $array;
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
}