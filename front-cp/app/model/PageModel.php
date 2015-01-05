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
     * Les 8 derniers groupes de projets ajoutés
     */
    public function SeeLastGroups(){

        try {
            $select = $this->connexion->prepare("SELECT * 
                                            FROM " . PREFIX . "group
                                            where group_valid = 1
                                            LIMIT 8");
                    
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> fetchAll();

            // $select -> closeCursor(); 
            // var_dump($retour);

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
}