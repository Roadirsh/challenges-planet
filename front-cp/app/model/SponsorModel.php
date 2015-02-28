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
        	$select = $this->connexion->prepare("SELECT *, 
                                                    (SELECT COUNT(B.donate_amount)
                                                    FROM " . PREFIX . "donate B
                                                    WHERE B." . PREFIX . "user_user_id = A.user_id)
                                                    AS helped
                                                FROM " . PREFIX . "user A
                                                WHERE user_type = 'organisme'
                                                AND user_donut != 0
                                                GROUP BY A.user_id");
           
            // $select->bindValue(':id', $id, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $array = $select->FetchAll();
     


            // $i = 0;
            // foreach ($array as $key => $id) {
                
            //     $select = $this->connexion->prepare("SELECT COUNT(donate_id) as helped
            //                                     FROM " . PREFIX . "donate
            //                                     WHERE " . PREFIX . "user_user_id = :id");
           
            //     $select->bindValue(':id', $id['user_id'], PDO::PARAM_INT);
            //     $select->execute();
            //     $select->setFetchMode(PDO::FETCH_ASSOC);
            //     $countDonate = $select->FetchAll();


            //     $array[$i] = array_merge($array[0], $countDonate[0]);
            
            // $i ++;
            // }

            return $array;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
	}

/////////////////////////////////////////////////////
/* SEE ONE SPONSORS * * * * * * * * * * * * * * * */

    /**
     * seeOneProject.php
     * 
     */
    public function SeeOneSponsor($id) {

        try {
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * 
            */
            $select = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "user
                                                WHERE user_type = 'organisme'
                                                AND user_donut != 0
                                                AND user_id = :id");
           
            $select->bindValue(':id', $id, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $array = $select->FetchAll();

            return $array[0];
            
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
    }
    

    /**
     * seeOneProject.php
     * 
     */
    public function SeeOneSponsorGroup($id) {

        try {
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * 
            */
            $select = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "donate A,
                                                " . PREFIX . "group B
                                                WHERE B.group_valid = 1
                                                AND B.group_id = A.group_group_id
                                                AND A.cp_user_user_id = :id ");
           
            $select->bindValue(':id', $id, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $array = $select->FetchAll();

            return $array;
            
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
    }
}