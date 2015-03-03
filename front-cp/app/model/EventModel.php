<?php 
/**
 * EventModel
 *
 * Everything who is relative to an EVENT
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */
/**
 * ADD EVENT
 * SEE EVENTS
 * FILTER EVENTS
 * SEE ONE EVENT
 * JSON FOR MOBILE APPLICATION
 */
class EventModel extends CoreModel{
    /* * * * * * * * * * * * * * * * * * * * * * * * * */
        // ADD EVENT
        private $Allevents;

    /* * * * * * * * * * * * * * * * * * * * * * * * * */
    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
    }
    
/////////////////////////////////////////////////////
/* ADD EVENT * * * * * * * * * * * * * * * * * * * */

    /**
     * Linked to : 
     * controller/EventController.php
     * view/addEvent.php
     * 
     * 4 events that a user can join
     */
    public function SeeTopEvent(){
        
        try {
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * Get 4 events, randomly, to join as a user
            */
            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_valid = 1
                                            ORDER BY RAND()
                                            LIMIT 4");
           
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select->FetchAll();
            $select->closeCursor(); 

            return $retour;

            
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }   
    }
    
    /**
     * Linked to : 
     * controller/EventController.php
     * view/addEvent.php
     * `public function uplaod($index, $destination, $img)`
     * 
     * Add a event into the Database
     * 
     * @param Array = $_POST as $post
     */
    public function insertNewEvent($post) {
        $location = $post['place'] . ', ' . $post['country'];

        $img = '';
        if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){
            $img = uniqid().$_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];
        }

        try 
        {   
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * Insert into the database EVENT
            */
            $insert = $this->connexion->prepare("INSERT INTO " . PREFIX . "event
                                                (`event_name`, `event_decr`, `event_begin`, `event_end`, `event_valid`, `event_location`, `event_img`, `event_type`) 
                                                VALUES (:name, :descr, '" .$post['from']. "', '" .$post['end']. "', 0, :location, :img, :type)");
            
            $insert->bindParam(':name', $post['name']);
            $insert->bindParam(':descr', $post['descr']);
            $insert->bindParam(':type', $post['type']);
            $insert->bindParam(':location', $location);
            $insert->bindParam(':img', $img);
            $insert->execute();
            
            if(!empty($img))
            {
                $string = EVENT.'slider/'.$img;
                
                $this->upload($tmp, $string, $img);
            }

            return true;
            
        }
        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }
    }

    /**
     * Linked to : 
     * controller/EventController.php
     * view/addEvent.php
     * `public function insertNewEvent($post)`
     * 
     * Add the image into the Database
     * 
     * @param String $destination
     * @param String $img
     */
    public function upload($index, $destination, $img) {
        
        $extension = $this->getExtension($destination);
        //Déplacement
       move_uploaded_file($index,$destination);
        if($extension=="jpg" || $extension=="jpeg" )
        {
            $src = imagecreatefromjpeg($destination);
        }
        else if($extension=="png")
        {
            $src = imagecreatefrompng($destination);
        }
        else 
        {
            $src = imagecreatefromgif($destination);
        }
        
        list($width,$height)=getimagesize($destination);
        //resize et compression
        $newwidth=1280;
        $newheight=($height/$width)*$newwidth;
        $tmp=imagecreatetruecolor($newwidth,$newheight);
        // Duplication et resize
        $newwidth1=523;
        $newheight1=($height/$width)*$newwidth1;
        $tmp1=imagecreatetruecolor($newwidth1,$newheight1);
        
        imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,
         $width,$height);
        
        imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1, 
        $width,$height);
        
        $filename = $destination;
        $filename1 = EVENT . 'mini/'.$img;
        
        imagejpeg($tmp,$filename,100);
        imagejpeg($tmp1,$filename1,100);
        
        imagedestroy($src);
        imagedestroy($tmp);
        imagedestroy($tmp1);
        
        
           
       return true;
    }


/////////////////////////////////////////////////////
/* SEE EVENT * * * * * * * * * * * * * * * * * * * */

    /**
     * Linked to : 
     * controller/EventController.php
     * view/seeEvent.php
     * 
     * Count how many event there are
     */
    public function CountEvent() {
        
        try {
            $select = $this->connexion->prepare("SELECT COUNT(*) as count
                                            FROM " . PREFIX . "event
                                            WHERE event_valid = 1");
           
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $CountEvent = $select->FetchAll();
            $select->closeCursor(); 
            
            return $CountEvent[0];

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }   
    }

    /**
     * Linked to : 
     * controller/EventController.php
     * view/seeEvent.php
     * `public function EventTeamNB($str)`
     * 
     * Show all the event (7 per page)
     */
    public function SeeEvent($page = null) {

        if($page <= 0){
            $page = 2;
        }
        $debut = LIMIT * ($page-1);
        $limit = $debut + LIMIT;

        try {
            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_valid = 1
                                            LIMIT :debut, :limit");
           
            $select->bindValue(':debut', $debut, PDO::PARAM_INT);
            $select->bindValue(':limit', $limit, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $AllEvent = $select->FetchAll();
            $select->closeCursor(); 
            
            return $AllEvent;

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }   
    }

    /**
     * Linked to : 
     * controller/EventController.php
     * view/seeEvent.php
     * `public function EventTeamNB($str)`
     * 
     * Show all the event (7 per page)
     */
    public function SeeEventTeamNB($eID, $page = null) {
        
        // PAGINATION
        if($page <= 0){
            $page = 2;
        }
        $debut = LIMIT * ($page-1);
        $limit = $debut + LIMIT;

        try {
            /* * * * * * * * * * * * * * * * * * * * * * * * *
            * GET GROUPS ID
            */
            $array = array();
            $i = 0;
            foreach ($eID as $key => $eID) {
                $select = $this->connexion->prepare("SELECT A.group_id, A.group_money , SUM(B.donate_amount) as total,  C.group_group_id,  C.event_event_id
                                                    FROM " . PREFIX . "group A,  " . PREFIX . "donate B,  " . PREFIX . "event_has_group C
                                                    WHERE A.group_id = C.group_group_id 
                                                    AND B.group_group_id = A.group_id 
                                                    AND A.group_valid = 1 
                                                    AND C.event_event_id = :id
                                                    GROUP BY B.group_group_id 
                                                    HAVING total <= A.group_money");

                $select->bindValue(':id', $eID['event_id'], PDO::PARAM_INT);
                $select->execute();
                $select->setFetchMode(PDO::FETCH_ASSOC); 
                $group = $select->fetchAll();
                $select->closeCursor();
                $eID['event_nb_team'] = count($group);
                $array[$i] = $eID;

            $i ++;
            }

            return $array;

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }   
    }

    /**
     * Linked to : 
     * controller/EventController.php
     * view/seeEvent.php
     * `public function EventTeamNB($str)`
     * 
     * Filter Kind of race
     * 
     * @param Array $post // Type of race
     */
    public function SeeFiltreEventType($post, $page = null){

        // PAGINATION
        if($page <= 0){
            $page = 2;
        }
        $debut = LIMIT * ($page-1);
        $limit = $debut + LIMIT;

        try {
            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_type = :type
                                            AND event_valid = 1
                                            LIMIT :debut, :limit");

            $select->bindValue(':debut', $debut, PDO::PARAM_INT);
            $select->bindValue(':limit', $limit, PDO::PARAM_INT);
            $select->bindValue(':type', $post, PDO::PARAM_STR);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $ByNb = $select->FetchAll();
            $select->closeCursor(); 

            return $ByNb;

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
    }
    
    /**
     * Linked to : 
     * controller/EventController.php
     * view/seeEvent.php
     * `public function EventTeamNB($str)`
     * 
     * Filter Date of begin
     * 
     * @param Array $post // Beginning of race
     */
    public function SeeFiltreEventBeginning($post, $page = null) {

        if($page <= 0){
            $page = 2;
        }
        $debut = LIMIT * ($page-1);
        $limit = $debut + LIMIT;

        $datenow = date("Y-m-d");

        if($post == "1week"){
            $date = date('Y-m-d', strtotime("+1 week"));
        } elseif($post == "2-3week"){
            $date = date('Y-m-d', strtotime("+3 week"));
        } elseif($post == "1month"){
            $time = strtotime("now");
            $date = date("Y-m-d", strtotime("+1 month", $time));
        } elseif($post == "6month"){
            $time = strtotime("now");
            $date = date("Y-m-d", strtotime("+6 month", $time));
        }

        try {
            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_valid = 1
                                            AND event_begin >= '" . $date . "'
                                            LIMIT :debut, :limit");

            $select->bindValue(':debut', $debut, PDO::PARAM_INT);
            $select->bindValue(':limit', $limit, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $ByBe = $select->FetchAll();
            $select->closeCursor(); 

            return $ByBe;
            
            
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
    }
    
    /**
     * Linked to : 
     * controller/EventController.php
     * view/seeEvent.php
     * `public function EventTeamNB($str)`
     * 
     * Filter by number of teams
     * 
     * @param Array $post // Number of teams for all the events
     */
    public function SeeFiltreEventNbTeam($post, $page = null) {
    
        if($page <= 0){
            $page = 2;
        }
        $debut = LIMIT * ($page-1);
        $limit = $debut + LIMIT;

        try {

            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_valid = 1
                                            LIMIT :debut, :limit");
            
            $select->bindValue(':debut', $debut, PDO::PARAM_INT);
            $select->bindValue(':limit', $limit, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $AllEvent = $select->FetchAll();
            $select->closeCursor(); 
            $array = array('');

            $i = 0;
            while($i < count($AllEvent)){

                $select2 = $this->connexion->prepare("SELECT COUNT(*) as event_nb_team
                                                FROM " . PREFIX . "event_has_group
                                                WHERE event_event_id = :eventID");
                
                $select2->bindValue(':eventID', $AllEvent[$i]['event_id'], PDO::PARAM_INT);
                $select2->execute();
                $select2->setFetchMode(PDO::FETCH_ASSOC);
                $CountGroupEvent = $select2->FetchAll();
                $select2->closeCursor();

                $nb_team = $CountGroupEvent['0']['event_nb_team'];

                //var_dump($nb_team);
                /* * * * * * * * * * * * * * * * * * * * * * * *
                * Construction of the array 
                * Dispatching in the severals arrays
                */
                
                if($post == '1-15'){
                    if($nb_team != 0 && $nb_team < 15){
                        $array[$i] = array_merge($AllEvent[$i], $CountGroupEvent['0']);
                    }
                } elseif($post == '15-50'){
                    if($nb_team != 0 && $nb_team > 15 && $nb_team < 50){
                       $array[$i] = array_merge($AllEvent[$i], $CountGroupEvent['0']);
                    }
                } elseif($post == '+50'){
                    if($nb_team != 0 && $nb_team > 50){
                        var_dump($AllEvent[$i]);
                        $array[$i] = array_merge($AllEvent[$i], $CountGroupEvent['0']);
                    }
                }    
                
                
            $i ++;
            }

            return $array;
            
            
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////
/* SEARCH * * * * * * * * * * * * * * * * * * * * * */

    /**
     * Linked to : 
     * controller/EventController.php
     * view/seeEvent.php
     *
     * Search for an event
     * 
     * @param Array $_POST
     */
    public function SearchByEvent($post, $page = null) {

        if(!empty($page)){
            if($page <= 0){
                $page = 2;
            }
            $debut = LIMIT * ($page-1);
            $limit = $debut + LIMIT;
        } else{
            $debut = 0;
            $limit = LIMIT;
        }
        

        include('../lib/blacklist.inc.php');
        $search = addslashes($post);
        $search = preg_replace("/'/", "", $search);
        $search = preg_replace("/=/", "", $search);
        
        $expSearch = explode(" ", $search);
        $i = 0;
        $nbArraySearch = count($expSearch);
        $sql = array();
        foreach($expSearch as $phrase) {
            // var_dump($phrase); exit;

            if(!in_array(strtolower($phrase), $adv)) { 
                // EVENT TABLE BDD
                $sql[] = " event_name LIKE '%" . addslashes($phrase) . "%' ";
                $sql[] = " event_decr LIKE '%" . addslashes($phrase) . "%' ";
            }
            $reqSQL = implode(' OR ', $sql);
        }
        $ajout = '';
        if (count($sql) > 0) {
            $ajout = ' WHERE ' . $reqSQL;
        }

        $select = $this->connexion->prepare("SELECT event_id
                                            FROM " . PREFIX . "event
                                            " . $ajout . " 
                                            GROUP BY event_id");
        
        $select->execute();
        $select->setFetchMode(PDO::FETCH_ASSOC); 
        $eventID = $select->fetchAll();
        $select->closeCursor(); 
        // * * * * * * * * * * * * * * * * * * * * * * * * *  //
        $AllEvent = ''; 

        
        foreach ($eventID as $key => $e) {
            $select2 = $this->connexion->prepare("SELECT *, 
                                                    ( SELECT COUNT(*) 
                                                    FROM " . PREFIX . "event_has_group 
                                                    WHERE event_event_id = :eventID) 
                                                    AS `event_nb_team` 
                                                FROM " . PREFIX . "event 
                                                WHERE event_valid = 1 
                                                AND event_id = :eventID
                                                LIMIT :debut, :limit");

            $select2->bindValue(':debut', $debut, PDO::PARAM_INT);
            $select2->bindValue(':limit', $limit, PDO::PARAM_INT);
            $select2->bindValue(':eventID', $e['event_id'], PDO::PARAM_INT);
            $select2->execute();
            $select2->setFetchMode(PDO::FETCH_ASSOC);
            $AllEvent = $select2->FetchAll();
            $select2->closeCursor(); 
        }
        
        return $AllEvent;

    }
    /**
     * Linked to : 
     * controller/EventController.php
     * view/seeEvent.php
     *
     * Search for a project
     *
     * @param array $_POST
     */
    public function SearchByProject($post, $eID, $page = null) {

        include('../lib/blacklist.inc.php');
        $search = addslashes($post);
        
        $expSearch = explode(" ", $search);
        $i = 0;
        $nbArraySearch = count($expSearch);
        $sql = array();
        foreach($expSearch as $k => $phrase){
            // $adv->blacklist
            if(!in_array(strtolower($phrase), $adv)) { 
                // EVENT TABLE BDD
                $sql[] = " group_name LIKE '%" . addslashes($phrase) . "%' ";
                $sql[] = " group_descr LIKE '%" . addslashes($phrase) . "%' ";
            }
            $reqSQL = implode(' OR ', $sql);
        }
        $ajout = '';
        if (count($sql) > 0) {
            $ajout = ' WHERE ' . $reqSQL;
        }

        $select = $this->connexion->prepare("SELECT group_id
                                            FROM " . PREFIX . "group
                                            " . $ajout . " 
                                            AND group_valid = 1
                                            GROUP BY group_id");

        $select->execute();
        $select->setFetchMode(PDO::FETCH_ASSOC); 
        $group = $select->fetchAll();
        $select->closeCursor(); 
        $array = ''; 
        $i = 0;

        foreach ($group as $key => $e) {

            $select2 = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "group 
                                                WHERE group_id = :eventID
                                                AND group_valid = 1");
            $select2->bindValue(':eventID', $e['group_id'], PDO::PARAM_INT);
            $select2->execute();
            $select2->setFetchMode(PDO::FETCH_ASSOC);
            $AllGroups = $select2->FetchAll();
            $select2->closeCursor(); 

            if(!empty($AllGroups[0]['group_id'])){
                $select3 = $this->connexion->prepare("SELECT sum(donate_amount) AS group_needed
                                                    FROM " . PREFIX . "donate 
                                                    WHERE group_group_id = :groupID");

                $select3->bindValue(':groupID', $AllGroups[0]['group_id'], PDO::PARAM_INT);
                $select3->execute();
                $select3->setFetchMode(PDO::FETCH_ASSOC);
                $needed = $select3->fetchAll();
                $select3->closeCursor(); 
                
                if($needed[0]['group_needed'] >= $AllGroups[0]['group_money']){
                    $d[$i] = array_merge($AllGroups[0], $needed[0]);
                } else {
                    $gr[$i] = array_merge($AllGroups[0], $needed[0]);
                }
                
            }
        $i ++;   
        }
        
        if(!empty($gr)){
            $array['groups'] = $gr;
        }
        if(!empty($d)){
            $array['done'] = $d;
        }
        //var_dump($array); exit;
        return $array;    
    }
/////////////////////////////////////////////////////
/* SEE ONE EVENT * * * * * * * * * * * * * * * * * */
    
    /**
     * Linked to : 
     * controller/EventController.php
     * view/seeOneEvent.php
     * `public function SeeOneEvent()`
     *
     * Filter Kind of race
     * 
     * @param INT event ID  
     */
    public function SeeOneEvent($eID) {
        try {
            $select = $this->connexion->prepare("SELECT *, 
                                                    ( SELECT COUNT(*) 
                                                    FROM " . PREFIX . "event_has_group
                                                    WHERE event_event_id = :eventID) 
                                                    AS `event_nb_team`
                                                FROM " . PREFIX . "event 
                                                WHERE event_valid = 1 
                                                AND event_id = :eventID");
           
            $select->bindValue(':eventID', $eID, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $oneEvent = $select->FetchAll();
            $select->closeCursor();
            //var_dump($oneEvent); exit;
            return $oneEvent;
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        } 
    }

    /**
     * Linked to : 
     * controller/EventController.php
     * view/seeOneEvent.php
     * 
     * @param Array Groups ID  
     */
    public function SeeGroupEvent($eID, $money = null) {

        // var_dump($eID);
        if(isset($money)){
            if($money == 2000){
                $where = 'AND group_money <= 2000';
            } elseif($money == 6000){
                $where = 'AND group_money > 2000 AND group_money <= 6000';
            } elseif($money == 10000){
                $where = 'AND group_money > 6000 AND group_money <= 10000';
            } 
        } else{
            $where = '';
        }


        try {
            /* * * * * * * * * * * * * * * * * * * * * * * * *
            * GET GROUPS ID
            */
            $array = array();
            $i = 0;
            foreach ($eID as $key => $eID) {
                $select = $this->connexion->prepare("SELECT *, SUM(B.donate_amount) as group_needed, C.group_group_id, C.event_event_id
                                                    FROM " . PREFIX . "group A, " . PREFIX . "donate B, " . PREFIX . "event_has_group C
                                                    WHERE A.group_id = C.group_group_id 
                                                    AND B.group_group_id = A.group_id 
                                                    AND A.group_valid = 1
                                                    AND C.event_event_id = :id
                                                    " . $where . "
                                                    GROUP BY B.group_group_id 
                                                    HAVING group_needed <= A.group_money");

                $select->bindValue(':id', $eID['event_id'], PDO::PARAM_INT);
                $select->execute();
                $select->setFetchMode(PDO::FETCH_ASSOC); 
                $group = $select->fetchAll();
                $select->closeCursor();

            $i ++;
            }

            return $group;


        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        } 
    }

    /**
     * Linked to : 
     * controller/EventController.php
     * view/seeOneEvent.php
     * 
     * 
     * @param Array Groups ID  
     */
    public function SeeDoneGroup($eID) {

        try {
            /* * * * * * * * * * * * * * * * * * * * * * * * *
            * GET GROUPS ID
            */
            $array = array();
            $i = 0;
            foreach ($eID as $key => $eID) {
                $select = $this->connexion->prepare("SELECT A.*, SUM(B.donate_amount) as total, C.group_group_id, C.event_event_id
                                                    FROM " . PREFIX . "group A, " . PREFIX . "donate B, " . PREFIX . "event_has_group C
                                                    WHERE A.group_id = C.group_group_id 
                                                    AND B.group_group_id = A.group_id 
                                                    AND A.group_valid = 1
                                                    AND C.event_event_id = :id
                                                    GROUP BY B.group_group_id 
                                                    HAVING total >= A.group_money");

                $select->bindValue(':id', $eID['event_id'], PDO::PARAM_INT);
                $select->execute();
                $select->setFetchMode(PDO::FETCH_ASSOC); 
                $group = $select->fetchAll();
                $select->closeCursor();

                $eID['event_nb_team'] = count($group);
                $array[$i] = $eID;
                
            $i ++;
            }

            return $group;
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        } 
    }

    /**
     * Linked to : 
     * model/EventModel.php
     * MOBILE APPLICATION
     *
     */
    public function getEventJSON() {
        try 
        {       
            $select = $this->connexion->prepare("SELECT event_id, event_name, event_location 
                                                FROM " . PREFIX . "event 
                                                WHERE event_valid = 1");
                    
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $event = $select->FetchAll(); 
            
            $json = json_encode($event);
            return $json;
        }
        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }
    }
    
    // Return the file ext
    public function getExtension($fichier){
		$extension_upload = strtolower(  substr(  strrchr($fichier, '.') ,1)  );
		return $extension_upload;
	}
	
	public function insertNewGroup($idEvent){
		try 
			{		
				
				$this->connexion->beginTransaction();
		        $insert = $this->connexion->prepare("INSERT INTO `cp_group` (`group_id`, `group_date`, `group_name`, `group_descr`, `group_img`, `group_money`, `group_valid`, `group_project`, `group_budget`) VALUES (NULL, now(), :name, :descr, :img, :money, 0, :project, :budget)");
		            	
		        $insert->bindParam(':name', $_POST['name-team']);
		        $insert->bindParam(':descr', $_POST['team']);
		        $img = uniqid().$_FILES['myfiles']['name'];
		        $insert->bindParam(':img', $img);
				$insert->bindParam(':money', $_POST['group_money']);
	            $insert->bindParam(':project', $_POST['goal']);
	            $insert->bindParam(':budget', $_POST['budget']);
		        
				$insert->execute();
				$idGroup = $this->connexion->lastInsertId();
				if(!empty($img))
				{
					$string= PROJECT.$img;
					$tmp = $_FILES['myfiles']['tmp_name'];
					move_uploaded_file($tmp, $string);
				}
				
				$insertEventHasGroup = $this->connexion->prepare("INSERT INTO `cp_event_has_group` (`event_event_id`, `group_group_id`) VALUES (:event, :group)");
				$insertEventHasGroup->bindParam(':event', $idEvent);
				$insertEventHasGroup->bindParam(':group', $idGroup);
				$insertEventHasGroup->execute();
				
				$userExist = $this->isUserExistInEvent($_SESSION['cp_userMail'], $idEvent);
				if(!$userExist){		
					$insertEventHasUser = $this->connexion->prepare("INSERT INTO `cp_event_has_user` (`event_event_id`, `user_user_id`) VALUES (:event, :user)");
						$insertEventHasUser->bindParam(':event', $idEvent);
						$insertEventHasUser->bindParam(':user', $_SESSION['cp_userID']);
						$insertEventHasUser->execute();
						
					$insertUserHasGroup = $this->connexion->prepare("INSERT INTO `cp_user_has_group` (`user_user_id`, `group_group_id`) VALUES (:user, :group)");
						$insertUserHasGroup->bindParam(':user', $_SESSION['cp_userID']);
						$insertUserHasGroup->bindParam(':group', $idGroup);
						$insertUserHasGroup->execute();
				}else{
					$this->sendMail($_SESSION['cp_userMail']); 
				}
				
				$userExist = $this->isUserExistInEvent($_POST['mail_one'], $idEvent);
				if(!$userExist){		
					$insertEventHasUser = $this->connexion->prepare("INSERT INTO `cp_event_has_user` (`event_event_id`, `user_user_id`) VALUES (:event, :user)");
					$userId = $this->getUserIdByMail($_POST['mail_one']);
					$insertEventHasUser->bindParam(':event', $event);
					$insertEventHasUser->bindParam(':user', $userId);
					$insertEventHasUser->execute();
						
					$insertUserHasGroup = $this->connexion->prepare("INSERT INTO `cp_user_has_group` (`user_user_id`, `group_group_id`) VALUES (:user, :group)");
						$insertUserHasGroup->bindParam(':user', $userId);
						$insertUserHasGroup->bindParam(':group', $idGroup);
						$insertUserHasGroup->execute();
				}else{
					$this->sendMail($_POST['mail_one']);
				}
				
				if(isset($_POST['mail_two']) && !empty($_POST['mail_two'])){
					
					$userExist = $this->isUserExistInEvent($_POST['mail_two'], $idEvent);
					if(!$userExist){		
						$insertEventHasUser = $this->connexion->prepare("INSERT INTO `cp_event_has_user` (`event_event_id`, `user_user_id`) VALUES (:event, :user)");
						$userId = $this->getUserIdByMail($_POST['mail_two']);
						$insertEventHasUser->bindParam(':event', $event);
						$insertEventHasUser->bindParam(':user', $userId);
						$insertEventHasUser->execute();
							
						$insertUserHasGroup = $this->connexion->prepare("INSERT INTO `cp_user_has_group` (`user_user_id`, `group_group_id`) VALUES (:user, :group)");
							$insertUserHasGroup->bindParam(':user', $userId);
							$insertUserHasGroup->bindParam(':group', $idGroup);
							$insertUserHasGroup->execute();
					}else{
						$this->sendMail($_POST['mail_two']);
					}
				}
				
				if(isset($_POST['mail_three']) && !empty($_POST['mail_three'])){
					
					$userExist = $this->isUserExistInEvent($_POST['mail_three'], $idEvent);
					if(!$userExist){		
						$insertEventHasUser = $this->connexion->prepare("INSERT INTO `cp_event_has_user` (`event_event_id`, `user_user_id`) VALUES (:event, :user)");
						$userId = $this->getUserIdByMail($_POST['mail_three']);
						$insertEventHasUser->bindParam(':event', $event);
						$insertEventHasUser->bindParam(':user', $userId);
						$insertEventHasUser->execute();
							
						$insertUserHasGroup = $this->connexion->prepare("INSERT INTO `cp_user_has_group` (`user_user_id`, `group_group_id`) VALUES (:user, :group)");
							$insertUserHasGroup->bindParam(':user', $userId);
							$insertUserHasGroup->bindParam(':group', $idGroup);
							$insertUserHasGroup->execute();
					}else{
						$this->sendMail($_POST['mail_three']);
					}
				}
				if(isset($_POST['mail_four']) && !empty($_POST['mail_four'])){
					
					$userExist = $this->isUserExistInEvent($_POST['mail_four'], $idEvent);
					if(!$userExist){		
						$insertEventHasUser = $this->connexion->prepare("INSERT INTO `cp_event_has_user` (`event_event_id`, `user_user_id`) VALUES (:event, :user)");
						$userId = $this->getUserIdByMail($_POST['mail_four']);
						$insertEventHasUser->bindParam(':event', $event);
						$insertEventHasUser->bindParam(':user', $userId);
						$insertEventHasUser->execute();
							
						$insertUserHasGroup = $this->connexion->prepare("INSERT INTO `cp_user_has_group` (`user_user_id`, `group_group_id`) VALUES (:user, :group)");
							$insertUserHasGroup->bindParam(':user', $userId);
							$insertUserHasGroup->bindParam(':group', $idGroup);
							$insertUserHasGroup->execute();
					}else{
						$this->sendMail($_POST['mail_four']);
					}
				}

			$this->connexion->commit();
			return true;
		}
	    catch (Exception $e)
	    {
	        $this->connexion->rollback();
            echo 'Message:' . $e -> getMessage();
        }
	}
	
	/**
     * Linked to : 
     * controller/EventController.php
     * view/addEvent.php
     * 
     * Verification of exists user
     * 
     * @param String mail 
     * @param String event
     */
	public function isUserExistInEvent($studentMail, $event)
	{
		try {
			
				$select = $this->connexion->prepare("SELECT count(*) as exist , user_id 
                                                    FROM " . PREFIX . "user 
                                                    WHERE user_mail = :mail");
				$select->bindParam(':mail', $studentMail);
				$select->execute();
				$select->setFetchMode(PDO::FETCH_ASSOC);
				$select = $select->FetchAll();
				if(isset($select[0]['exist']) && $select[0]['exist'] == 1)
				{
					
					$select2 = $this->connexion->prepare("SELECT count(*) as exist
	                                                   FROM " . PREFIX . "event_has_user 
                                                       WHERE event_event_id = :event 
                                                       AND user_user_id = :student");
					
		            $select2->bindParam(':student', $select[0]['user_id']);
		            $select2->bindParam(':event', $event);
		            $select2->execute();
					$select2->setFetchMode(PDO::FETCH_ASSOC);
					$select2 = $select2 -> FetchAll();
					if($select2[0]['exist'] == 1)
					{
						
						return true;
					}else{
						
						return false;
						
					}
					
				}else{
					return true;
				}
	 		
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }

	}
	
	public function getUserIdByMail($mail)
	{
		$select = $this->connexion->prepare("SELECT user_id 
                                            FROM " . PREFIX . "user 
                                            WHERE user_mail = :mail");
		$select->bindParam(':mail', $mail);
		$select->execute();
		$select->setFetchMode(PDO::FETCH_ASSOC);
		$select = $select -> FetchAll();
		if(isset($select[0]['user_id'])){ 
			return $select[0]['user_id'];
		}
		else{
			return false;
		}
	}
	
     /**
     * Linked to : 
     * controller/EventController.php
     * view/addEvent.php
     * 
     * Send an email with swiftMailer
     *
     * @param array $_POST
     */
	public function sendMail($mail){
		require_once '../../front-cp/vendor/swiftmailer/lib/swift_required.php';

		// Create the Transport
		$transport = Swift_SmtpTransport::newInstance('ssl://smtp.gmail.com', 465)
		  ->setUsername('challengesplanet@gmail.com') 
		  ->setPassword('EEMI2014')
		  ;
		// Create the Mailer using your created Transport
		$mailer = Swift_Mailer::newInstance($transport);
		$body = "A friend of yours add you in a project, please senpai, sign up. http://ns366377.ovh.net:8888/challenges-planet/front-cp/public/index.php?module=log&action=signup";
		
		// Create a message
		$message = Swift_Message::newInstance('Wonderful Subject')
		  ->setFrom(array('john@doe.com' => 'John Doe'))
		  ->setTo(array('roadirsh@gmail.com', $mail))
		  ->setBody($body)
		  ;
		
		// Send the message
		$result = $mailer->send($message);
	}

}