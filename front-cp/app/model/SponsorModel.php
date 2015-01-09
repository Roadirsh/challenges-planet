<?php 

/**
 * ProjectModel
 *
 * Requêtes relatifs aux groupes de projects
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

/**
 * choix de l'action
 * instanciation de la class
 */
class SponsorModel extends CoreModel{


    private $GroupID;       // INT
    private $GroupDate;     // DATE
	private $GroupName;     // STRING
	private $GroupDescr;    // LONG STRING
	private $GroupImg;      // STRING
	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
	}
	
	public function Seesponsor(){
    	
    	try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "user
                                            where user_type = 'organisme'
                                            and user_donut != 0");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $Allsponsor = $select -> FetchAll();
            
            //var_dump($Allsponsor);
            return $Allsponsor;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
    
}