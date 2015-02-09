<?php 

/**
 * UserModel
 *
 * Everything who is relative to a USER
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * SEE ONE USER
 */ 
class UserModel extends CoreModel{

    /* * * * * * * * * * * * * * * * * * * * * * * * * */

    /* * * * * * * * * * * * * * * * * * * * * * * * * */

	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();

	}
	
/////////////////////////////////////////////////////
/* USER * * * * * * * * * * * * * * * * * * * * * * */

    /**
     * seeOneUser.php
     * 
     * All information about one user
     * 
     * @param $id $_GET ID
     */
	public function SeeOneUser() {

        $id = $_GET['id'];

        try {
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * Get All the informations about the user from the ID
            */
            $select = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "user
                                                WHERE user_type != 'admin'
                                                AND user_id = :userID");
           
            $select->bindValue(':userID', $id, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $user = $select->FetchAll();
            $select->closeCursor(); 

            if(!empty($user)){

                $select2 = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "phone
                                                WHERE user_user_id = :userID");
           
                $select2->bindValue(':userID', $id, PDO::PARAM_INT);
                $select2->execute();
                $select2->setFetchMode(PDO::FETCH_ASSOC);
                $phone = $select2->FetchAll();
                $select2->closeCursor(); 

                if(!empty($phone)){

                    $select3 = $this->connexion->prepare("SELECT *
                                                    FROM " . PREFIX . "adress
                                                    WHERE user_user_id = :userID");
               
                    $select3->bindValue(':userID', $id, PDO::PARAM_INT);
                    $select3->execute();
                    $select3->setFetchMode(PDO::FETCH_ASSOC);
                    $adress = $select3->FetchAll();
                    $select3->closeCursor(); 

                    
                    if(!empty($adress)){

                        $select4 = $this->connexion->prepare("SELECT *
                                                        FROM " . PREFIX . "bank_details
                                                        WHERE user_user_id = :userID");
                        
                        $select4->bindValue(':userID', $id, PDO::PARAM_INT);
                        $select4->execute();
                        $select4->setFetchMode(PDO::FETCH_ASSOC);
                        $adress = $select4->FetchAll();
                        $select4->closeCursor(); 
                    
                    }

                }

            }

            return $retour;
            
            
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
    }

   
}
?>