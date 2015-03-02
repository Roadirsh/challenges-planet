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
 */
class PageModel extends CoreModel{

    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
    }

/////////////////////////////////////////////////////
/* HOME * * * * * * * * * * * * * * * * * * * * * * */

    /**
     * Linked to : 
     * controller/PageController.php
     * view/home.php
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
                                            ORDER BY event_id DESC
                                            LIMIT 4");
            
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
     * Linked to : 
     * controller/PageController.php
     * view/home.php
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
     * Linked to : 
     * controller/PageController.php
     * view/home.php
     * 
     * COUNT DONATE of added teams
     * 
     * @param Array = id of last added groups
     */
    public function CountDonut($groupID) {
    
        try {
            $select = $this->connexion->prepare("SELECT sum(donate_amount) as needed
                                                FROM " . PREFIX . "donate 
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
     * Linked to : 
     * controller/PageController.php
     * view/home.php
     * 
     * Get 8 last sponsors
     */
    public function SeeLastSponsors() {

        try {
            $select = $this->connexion->prepare("SELECT * 
                                            FROM " . PREFIX . "user A, " . PREFIX . "donate B 
                                            WHERE A.user_type = 'organisme'
                                            AND A.user_donut > 0
                                            GROUP BY A.user_id 
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
     * Linked to : 
     * controller/PageController.php
     * view/home.php
     * 
     * All groups ID
     */
    public function SeeGroupID() {
        try {

            $select = $this->connexion->prepare("SELECT A.group_id 
                                                FROM " . PREFIX . "group A, " . PREFIX . "event B, " . PREFIX . "event_has_group C
                                                WHERE A.group_valid = 1
                                                AND B.event_end >= " . date("Y-m-d") . "
                                                GROUP BY A.group_id");

            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $gID = $select->FetchAll();
            $select->closeCursor(); 

            $array = '';
            $i = 0;
            foreach ($gID as $key => $value) {

                $select2 = $this->connexion->prepare("SELECT sum(donate_amount) as group_needed
                                                    FROM " . PREFIX . "donate 
                                                    WHERE group_group_id = :groupID");

                $select2->bindValue(':groupID', $value['group_id'], PDO::PARAM_INT);
                $select2->execute();
                $select2->setFetchMode(PDO::FETCH_ASSOC);
                $Needed = $select2->FetchAll();
                $select2->closeCursor();

                if($Needed[0]['group_needed'] == null){
                    $Needed[0]['group_needed'] = '0';
                }

                $array[$i] = array_merge($gID[$i], $Needed[0]);

            $i ++;
            }
            return $array;

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        } 
    }

    /**
     * Linked to : 
     * controller/PageController.php
     * view/home.php
     * 
     * @param Array Groups ID  
     */
    public function SeeGroups($gID) {

        try {
            $array = '';
            $i = 0;
            $b = 0; // TODO

            while($i < count($gID)){

                $select = $this->connexion->prepare("SELECT *
                                                    FROM " . PREFIX . "group A, " . PREFIX . "event B, " . PREFIX . "event_has_group C
                                                    WHERE A.group_valid = 1
                                                    AND A.group_id = :groupID
                                                    AND B.event_end >= '" . date("Y-m-d H:i:s") . "'
                                                    AND A.group_id = C.group_group_id
                                                    AND B.event_id = C.event_event_id
                                                    AND A.group_money > :needed
                                                    GROUP BY A.group_id
                                                    ORDER BY A.group_date ASC
                                                    LIMIT 7");

                $select->bindValue(':groupID', $gID[$i]['group_id'], PDO::PARAM_INT);
                $select->bindValue(':needed', $gID[$i]['group_needed'], PDO::PARAM_INT);
                $select->execute();
                $select->setFetchMode(PDO::FETCH_ASSOC);
                $group = $select->FetchAll();
                $select->closeCursor();

                if(!empty($group[0]['group_id']) && !empty($group[0]['group_id'])){
                    $array[$b] = array_merge($group[0], $gID[$i]);
                } else {
                    $array[$b] = '';
                }

            $i ++;  
            $b ++;
            }


            return $array;

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        } 
    }

    /**
     * Linked to : 
     * controller/PageController.php
     * view/home.php
     * 
     * @param Array Groups ID  
     */
    public function SeeDoneGroup($gID) {

        try {
            $array = '';
            $i = 0;
            while($i < count($gID)){

                $select = $this->connexion->prepare("SELECT *
                                                    FROM " . PREFIX . "group A, " . PREFIX . "event B, " . PREFIX . "event_has_group C
                                                    WHERE A.group_valid = 1
                                                    AND A.group_id = :groupID
                                                    AND B.event_end <= '" . date("Y-m-d H:i:s") . "'
                                                    AND A.group_id = C.group_group_id
                                                    AND B.event_id = C.event_event_id
                                                    AND A.group_money < :needed
                                                    GROUP BY A.group_id
                                                    ORDER BY A.group_date ASC
                                                    LIMIT 1");

                $select->bindValue(':groupID', $gID[$i]['group_id'], PDO::PARAM_INT);
                $select->bindValue(':needed', $gID[$i]['group_needed'], PDO::PARAM_INT);
                $select->execute();
                $select->setFetchMode(PDO::FETCH_ASSOC);
                $group = $select->FetchAll();
                $select->closeCursor();

                if(isset($group[0])){
                    $array = array_merge($gID[$i], $group[0]);
                }
            $i ++;   
            }
            return $array;

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        } 
    }
    
}