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
            $array = $select -> FetchAll();

            $i = 0;
            foreach ($array as $key => $id) {
                
                $select = $this->connexion->prepare("SELECT COUNT(donate_id) as helped
                                                FROM " . PREFIX . "donate
                                                WHERE " . PREFIX . "user_user_id = :id");
           
                $select->bindValue(':id', $id['user_id'], PDO::PARAM_INT);
                $select->execute();
                $select->setFetchMode(PDO::FETCH_ASSOC);
                $countDonate = $select->FetchAll();


                $array[$i] = array_merge($array[0], $countDonate[0]);
            
            $i ++;
            }

            return $array;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
	}

    // public function SeeSponsorCountDonate() {
        
    //     try {
    //         $select = $this->connexion->prepare("SELECT COUNT(donate_id) 
    //                                             FROM " . PREFIX . "donate
    //                                             WHERE " . PREFIX . "user_user_id = 220
    //                                             ");
           
    //         $select->bindValue(':id', $id, PDO::PARAM_INT);
    //         $select->execute();
    //         $select->setFetchMode(PDO::FETCH_ASSOC);
    //         $Allsponsor = $select->FetchAll();
            
    //         //var_dump($Allsponsor);
    //         return $Allsponsor;
            
            
    //     } catch (Exception $e) {
    //         echo 'Message:' . $e -> getMessage();
    //     }
    // }
    
}