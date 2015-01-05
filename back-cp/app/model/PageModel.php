<?php 

/**
 * UserModel
 *
 * Requêtes relatifs au user
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */


class PageModel extends CoreModel{

    /**
     * Compte du nombre de Users
     */
    public function NbUsers(){

        try {
            $select = $this->connexion->prepare("SELECT * 
                                            FROM " . PREFIX . "user");
                    
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> rowCount();

            // $select -> closeCursor();

            //var_dump($retour);

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
    /**
     * Voir l'ensemble des admins
     */
    public function Seeteam(){

        try {
            $select = $this->connexion->prepare("SELECT * 
                                            FROM " . PREFIX . "user
                                            WHERE user_type = 'admin'");
                    
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> fetchAll();

            // $select -> closeCursor();

            //var_dump($retour);

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
    /**
     * Supprimer un membre des admins
     */
    public function Delteam(){
    	//var_dump($GLOBALS);
    	$delteamID = $_GET['id'];
    	
    	try {
    	    // rajouer un trigger corbeille
        	$select = $this->connexion->prepare("DELETE
                                            FROM " . PREFIX . "user
                                            where user_id = '" . $delteamID . "'");
           
            //var_dump($select); exit();
            $select -> execute();
            
            //var_dump($AllUser);
            return true;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
}