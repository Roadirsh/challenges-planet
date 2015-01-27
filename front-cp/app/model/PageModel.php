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
     * Les 4 derniers events de projets ajoutés
     */
    public function SeeFourEvents(){

        try {
            $select = $this->connexion->prepare("SELECT event_id, event_name, event_decr, event_img, event_valid 
                                            FROM " . PREFIX . "event
                                            where event_valid = 1
                                            LIMIT 4");
                    
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> fetchAll();

            $select -> closeCursor(); 
            //var_dump($retour);

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
    /**
     * Les 8 derniers groupes de projets ajoutés
     */
    public function SeeLastGroups(){

        try {
            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "group A, " . PREFIX . "event B, " . PREFIX . "event_has_group C
                                            WHERE A.group_valid = 1
                                            AND B.event_end > '" . date("Y-m-d") . "'
                                            AND A.group_id = C.group_group_id
                                            AND B.event_id = C.event_event_id
                                            GROUP BY A.group_id
                                            LIMIT 7");

            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> fetchAll();

            $select -> closeCursor(); 

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
    /**
     * Les 8 derniers COUNT SUPPORTERS de groupes de projets ajoutés
     */
    public function CountLastGroups($groupID){
    
        try {
            $select2 = $this->connexion->prepare("SELECT COUNT(donate_id) as count, group_money
                                            FROM " . PREFIX . "donate A, " . PREFIX . "group B 
                                            WHERE B.group_id = A.group_group_id 
                                            AND B.group_id = " . $groupID . "");

            //var_dump($select2);
            $select2 -> execute();
            $select2 -> setFetchMode(PDO::FETCH_ASSOC);
            $retour2 = $select2 -> fetchAll();
            //var_dump($retour2);
            $return = $retour2;
            $select2 -> closeCursor(); 
            
            return $return;
        
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
        
    }
    
    /**
     * 
     */
    public function CountDonut($groupID){
    
        try {
            $select = $this->connexion->prepare("SELECT sum(donate_amount) as needed
                                                FROM cp_donate 
                                                WHERE group_group_id = " . $groupID . "");

            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> fetchAll();
            //var_dump($retour);
            $return = $retour;
            $select -> closeCursor(); 
            
            return $return;
        
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
        
    }
    
    
    /**
     * Les 8 derniers sponsors
     */
    public function SeeLastSponsors(){

        try {
            $select = $this->connexion->prepare("SELECT * 
                                            FROM " . PREFIX . "user
                                            where user_type = 'organisme'
                                            and user_donut > 0
                                            LIMIT 8");
                    
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> fetchAll();

            $select -> closeCursor(); 
            // var_dump($retour);

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
    /**
     * Les 8 derniers sponsors
     */
    public function SeeDoneGroup(){
        
        try {
            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "group A, " . PREFIX . "event_has_group B, " . PREFIX . "event C 
                                            WHERE A.group_valid = 1
                                            AND A.group_id = B.group_group_id
                                            AND C.event_id = B.event_event_id
                                            AND C.event_end < '" . date("Y-m-d H:i:s") . "'
                                            GROUP BY A.group_id
                                            LIMIT 1");
                    
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> fetchAll();

            $select -> closeCursor(); 
            // var_dump($retour);

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
}