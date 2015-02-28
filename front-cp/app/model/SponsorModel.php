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
 * SEE ONE SPONSOR
 */
class SponsorModel extends CoreModel{
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
	}
	
/////////////////////////////////////////////////////
/* SEE SPONSORS * * * * * * * * * * * * * * * * * * */

    /**
     * Linked to : 
     * controller/SponsorController.php
     * view/seeSponsor.php
     * 
     */
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
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $array = $select->FetchAll();
     

            return $array;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
	}

/////////////////////////////////////////////////////
/* SEE ONE SPONSORS * * * * * * * * * * * * * * * */

    /**
     * Linked to : 
     * controller/SponsorController.php
     * view/seeSOneSponsor.php
     * 
     */
    public function SeeOneSponsor($id) {

        try {
            $select = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "user
                                                WHERE user_type = 'organisme'
                                                AND user_donut != 0
                                                AND user_id = :id");
           
            $select->bindValue(':id', $id, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $sponsor = $select->FetchAll();

            if(isset($sponsor[0])){
                $retour = $sponsor[0];
            } else{
                $retour = $sponsor;
            }
            

            if(!empty($sponsor)){

                $select2 = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "phone
                                                WHERE user_user_id = :userID");
           
                $select2->bindValue(':userID', $id, PDO::PARAM_INT);
                $select2->execute();
                $select2->setFetchMode(PDO::FETCH_ASSOC);
                $phone = $select2->FetchAll();
                $select2->closeCursor(); 

                if(!empty($phone[0])){
                    $retour = array_merge($retour, $phone[0]);
                }
  
                $select3 = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "adress
                                                WHERE user_user_id = :userID");
           
                $select3->bindValue(':userID', $id, PDO::PARAM_INT);
                $select3->execute();
                $select3->setFetchMode(PDO::FETCH_ASSOC);
                $adress = $select3->FetchAll();
                $select3->closeCursor(); 

                if(!empty($adress[0])){
                    $retour = array_merge($retour, $adress[0]);
                }
    

            }
            
            return $retour;
            
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
    }
    

    /**
     * Linked to : 
     * controller/SponsorController.php
     * view/seeSponsor.php
     * 
     */
    public function SeeOneSponsorGroup($id) {

        try {
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