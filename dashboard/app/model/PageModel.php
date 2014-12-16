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
     * Nombre de Users
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
    }