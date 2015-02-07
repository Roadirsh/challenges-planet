<?php 

/**
 * SponsorModel
 *
 * Everything who is relative to a SPONSOR
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * SEE SPONSOR
 */
class SponsorModel extends CoreModel{

    /* * * * * * * * * * * * * * * * * * * * * * * * * */

    /* * * * * * * * * * * * * * * * * * * * * * * * * */
	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
	}
	
/////////////////////////////////////////////////////
/* SEE SPONSORS * * * * * * * * * * * * * * * * * * */
	public function Seesponsor() {
    	
    	try {
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * Get all sponsors who have make a donation
            */
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