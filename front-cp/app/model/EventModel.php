<?php 

/**
 * ProjectModel
 *
 * Requêtes relatifs aux évenements
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

/**
 * choix de l'action
 * instanciation de la class
 */
class EventModel extends CoreModel{

	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
	}
	
	public function getShowEvents(){
    	
    	try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            where event_valid = 1");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $AllEvent = $select -> FetchAll();
            
            //var_dump($AllEvent);
            return $AllEvent;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
    
	public function CountEvents(){
    	
    	try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $countEvent = $select -> rowCount();
            
            return $countEvent;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
}