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
    
    public function getProjectJSON() {

        try {

                $select = $this->connexion->prepare("SELECT group_name, group_descr, group_id 
                                                    FROM  `cp_group` 
                                                    LEFT JOIN cp_event_has_group 
                                                    ON cp_group.group_id = cp_event_has_group.group_group_id  
                                                    WHERE `cp_event_has_group`.`event_event_id` = :id");

                $select->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
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