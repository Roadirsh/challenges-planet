<?php 

/**
 * UserModel
 *
 * Requêtes relatifs au user
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * SEE EVENTS
 * SEE PROJECTS
 * SEE SPONSORS
 * SEE GCU
 */
class PageModel extends CoreModel{

    /* * * * * * * * * * * * * * * * * * * * * * * * * */

    /* * * * * * * * * * * * * * * * * * * * * * * * * */

    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
    }

/////////////////////////////////////////////////////
/* HOME * * * * * * * * * * * * * * * * * * * * * * */

    /**
     * home.php
     * 
     * 4 events last added
     */
    public function SeeFourEvents() {

        try {
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * Get 4 events, last added and valid
            */
            $select = $this->connexion->prepare("SELECT event_id, event_name, event_decr, event_img, event_valid 
                                            FROM " . PREFIX . "event
                                            where event_valid = 1
                                            LIMIT 4");
            
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select->fetchAll();
            $select->closeCursor();

            //$this->setSeeFourEvents($retour);
            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }
    }
    
    /**
     * home.php
     * 
     * 7 last added teams
     */
    public function SeeLastGroups() {

        try {
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * Get 7 teams, last added, where the event is not finished
            */
            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "group A, " . PREFIX . "event B, " . PREFIX . "event_has_group C
                                            WHERE A.group_valid = 1
                                            AND B.event_end > '" . date("Y-m-d H:i:s") . "'
                                            AND A.group_id = C.group_group_id
                                            AND B.event_id = C.event_event_id
                                            GROUP BY A.group_id
                                            LIMIT 7");
            
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select->fetchAll();
            $select->closeCursor(); 

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }
    }
    
    /**
     * home.php
     * 
     * COUNT SPONSORS of added teams
     * 
     * @param Array = id of last added groups
     */
    public function CountLastGroups($groupID) {
    
        try {
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * Get count of donation per group
            */
            $select = $this->connexion->prepare("SELECT COUNT(donate_id) as count, group_money
                                            FROM " . PREFIX . "donate A, " . PREFIX . "group B 
                                            WHERE B.group_id = A.group_group_id 
                                            AND B.group_id = :groupID");
            
            $select->bindValue(':groupID', $groupID, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select->fetchAll();
            $select->closeCursor(); 
            
            return $retour;
        
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }    
    }
    
    /**
     * home.php
     * 
     * COUNT DONATE of added teams
     * 
     * @param Array = id of last added groups
     */
    public function CountDonut($groupID) {
    
        try {
            $select = $this->connexion->prepare("SELECT sum(donate_amount) as needed
                                                FROM cp_donate 
                                                WHERE group_group_id = :groupID");

            $select->bindValue(':groupID', $groupID, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select->fetchAll();
            $select->closeCursor(); 

            return $retour;
        
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }  
    }
    
    
    /**
     * home.php
     * 
     * Get 8 last sponsors
     */
    public function SeeLastSponsors() {

        try {
            $select = $this->connexion->prepare("SELECT * 
                                            FROM " . PREFIX . "user A, " . PREFIX . "donate B 
                                            WHERE A.user_type = 'organisme'
                                            AND A.user_donut > 0
                                            ORDER BY B.donate_date ASC
                                            LIMIT 8");
            
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select->fetchAll();
            $select->closeCursor(); 

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }
    }
    
    /**
     * home.php
     * 
     * One group wich event is finished
     */
    public function SeeDoneGroup() {
        
        try {
            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "group A, " . PREFIX . "event_has_group B, " . PREFIX . "event C 
                                            WHERE A.group_valid = 1
                                            AND A.group_id = B.group_group_id
                                            AND C.event_id = B.event_event_id
                                            AND C.event_end < '" . date("Y-m-d H:i:s") . "'
                                            GROUP BY A.group_id
                                            LIMIT 1");
            
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select->fetchAll();
            $select->closeCursor(); 
            
            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }
    }
    
}