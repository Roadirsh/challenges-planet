<?php 

/**
 * ProjectModel
 *
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * GET PROJECT JSON 
 */
class ProjectModel extends CoreModel{

    
    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
    }
    
    /**
     * seeOneProject.php
     * 
     */
    public function SeeOneGroup($id) {

        try {
            $select = $this->connexion->prepare("SELECT A.*, B.*, SUM(donate_amount) as group_needed, D.*
                                                FROM cp_group A, cp_event_has_group B, cp_donate C, cp_event D
                                                WHERE B.group_group_id = A.group_id
                                                AND C.group_group_id = A.group_id
                                                AND D.event_id = B.event_event_id
                                                AND A.group_valid = 1
                                                AND A.group_id = :id");

            $select->bindValue(':id', $id, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $group = $select->FetchAll();
            $select->closeCursor();

            $select2 = $this->connexion->prepare("SELECT A.cp_user_user_id, B.*
                                                FROM cp_donate A
                                                JOIN cp_user B
                                                ON A.cp_user_user_id = B.user_id
                                                WHERE group_group_id = 4");

            $select2->bindValue(':id', $id, PDO::PARAM_INT);
            $select2->execute();
            $select2->setFetchMode(PDO::FETCH_ASSOC);
            $sponsor = $select2->FetchAll();
            $select2->closeCursor(); 

            $array = array_merge($group[0], $sponsor);
            return $array;

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }   
    }


    /**
     * mobile application
     *
     */
    public function getProjectJSON() {

        try {
				$selectfrom = "SELECT group_name, group_descr, group_id 
                                                    FROM  `cp_group` ";
                if(isset($_GET['id'])){
	                $projetparevent = "`cp_event_has_group`.`event_event_id` = :id AND ";
					$jointure = "LEFT JOIN cp_event_has_group 
                             ON cp_group.group_id = cp_event_has_group.group_group_id ";
							 
                }
                else{
	                $jointure = "";
	                $projetparevent = "";
                }
                
                
                $where = "WHERE "  .  $projetparevent . " group_valid = 1";
                $query = $selectfrom.$jointure.$where;
                                                    
                $select = $this->connexion->prepare($query);
				if(isset($_GET['id'])){
                	$select->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                }
                $select->execute();
                $select->setFetchMode(PDO::FETCH_ASSOC);
                $event = $select->FetchAll();
                
                $json = json_encode($event);

                return $json;

        }

        catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
    }
}