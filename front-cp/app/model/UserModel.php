<?php 

/**
 * UserModel
 *
 * Requêtes relatifs a la connexion
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

/**
 * choix de l'action
 * instanciation de la class
 */
class UserModel extends CoreModel{

	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();

	}
	
	public function SeeOneUser(){

        $id = $_GET['id'];

        try {
            // USER INFORMATION
            $select = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "user
                                                WHERE user_type != 'admin'
                                                AND user_id = " . $id);
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $user = $select -> FetchAll();

            if(!empty($user)){

                $select = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "phone
                                                WHERE user_user_id = " . $id);
           
                $select -> execute();
                $select -> setFetchMode(PDO::FETCH_ASSOC);
                $phone = $select -> FetchAll();

                if(!empty($phone)){

                    $select = $this->connexion->prepare("SELECT *
                                                    FROM " . PREFIX . "adress
                                                    WHERE user_user_id = " . $id);
               
                    $select -> execute();
                    $select -> setFetchMode(PDO::FETCH_ASSOC);
                    $adress = $select -> FetchAll();

                    
                    if(!empty($adress)){

                        $select = $this->connexion->prepare("SELECT *
                                                        FROM " . PREFIX . "bank_details
                                                        WHERE user_user_id = " . $id);
                   
                        $select -> execute();
                        $select -> setFetchMode(PDO::FETCH_ASSOC);
                        $adress = $select -> FetchAll();

                    
                    }

                }

            }
            
            

            return $retour;
            
            
        } catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }

    }

   
}


            // echo '<pre>';
            // var_dump($retour);
            // echo '</pre>';
            // exit();
?>