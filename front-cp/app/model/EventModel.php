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
 */
class EventModel extends CoreModel{

    /* * * * * * * * * * * * * * * * * * * * * * * * * */
    /* ADD EVENT */
        private $Allevents;
    /* SEE EVENT */
    /* SEARCH */
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
     * addEvent.php
     * 
     * 4 events that a user can join
     */
    private function SeeTopEvent(){
        
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
            $this->setTopEvent($retour);
            
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }   
    }
    public function getTopEvent(){
        return $this->Allevents;
    }
    private function setTopEvent($retour){
        if(is_array($retour)){
            $this->Allevents = $retour;
        }
    }
    
    /**
     * addEvent.php
     * 
     * Add a event into the Database
     * 
     * @param Array = $_POST as $post
     */
    public function insertNewEvent($post) {
        $location = $post['place'] . ', ' . $post['country'];
        // var_dump($post); exit();
        $img = $_FILES['cover']['name'];
        $tmp = $_FILES['cover']['tmp_name'];
        try 
        {   
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * Insert into the database EVENT
            */
            $insert = $this->connexion->prepare("INSERT INTO " . PREFIX . "event
                                                (`event_name`, `event_decr`, `event_begin`, `event_end`, `event_valid`, `event_location`, `event_img`) 
                                                VALUES (:name, :descr, '" .$post['from']. "', '" .$post['from']. "', 0, :location, :img)");
            
            $insert->bindParam(':name', $post['name']);
            $insert->bindParam(':descr', $post['descr']);
            $insert->bindParam(':location', $location);
            $insert->bindParam(':img', $img);
            $insert->execute();
            
            return true;
            
        }
        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }
    }

    /**
     * addEvent.php
     * 
     * Add the image into the Database
     * 
     * Linked to the `public function insertNewEvent($post)`
     * 
     * @param String $destination
     * @param String $img
     */
    private function upload($index, $destination, $img) {
    
        $extension = $_FILES['cover']['type'];
        // Move
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
        
        $newwidth=1280;
        $newheight=($height/$width)*$newwidth;
        $tmp=imagecreatetruecolor($newwidth,$newheight);
        
        $newwidth1=268;
        $newheight1=($height/$width)*$newwidth1;
        $tmp1=imagecreatetruecolor($newwidth1,$newheight1);
        
        imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,
         $width,$height);
        
        imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1, 
        $width,$height);
        
        $filename = $destination;
        $filename1 = 'public/img/event/mini/'.$img;
        
        imagejpeg($tmp,$filename,100);
        imagejpeg($tmp1,$filename1,100);
        
        imagedestroy($src);
        imagedestroy($tmp);
        imagedestroy($tmp1);
    
        //Test1: fichier correctement uploadé
        if (!isset($_FILES["imageEvent"]) OR $_FILES["imageEvent"]['error'] > 0){
            return FALSE;
        }

       return true;
    }

/////////////////////////////////////////////////////
/* SEE EVENT * * * * * * * * * * * * * * * * * * * */

    /**
     * seeEvent.php
     * 
     * Get the number of teams for each events
     * @param Array $str // Event array
     */
    public function EventTeamNB($str) {

        $array = '';
        $i = 0;
        while($i < count($str)){

            /* * * * * * * * * * * * * * * * * * * * * * * *
            * Count the number of teams who are related to a event
            * Event Array, passed into $str
            */
            $select = $this->connexion->prepare("SELECT COUNT(*) as event_nb_team
                                            FROM " . PREFIX . "event_has_group
                                            WHERE event_event_id = :eventID
                                            LIMIT 7");

            $select->bindValue(':eventID', $str[$i]['event_id'], PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select->FetchAll();
            $select->closeCursor(); 
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * Create one uniq array whith all informations
            */
            $array[$i]= array_merge($str[$i], $retour['0']);

        $i ++;
        }

        //var_dump($array);
        return $array;
    }

    /**
     * seeEvent.php
     * 
     * Show all the event (7 per page)
     * Linked to the `public function EventTeamNB($str)`
     */
    public function SeeEvent() {
        
        try {
            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_valid = 1
                                            LIMIT 7");
           
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
     * seeEvent.php
     * 
     * Filter Kind of race
     * Linked to the `public function EventTeamNB($str)`
     * 
     * @param Array $post // Type of race
     */
    public function SeeFiltreEventType($post){

        try {
            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_type = :type");
           
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
     * seeEvent.php
     * 
     * Filter Date of begin 
     * Linked to the `public function EventTeamNB($str)`
     * 
     * @param Array $post // Beginning of race
     */
    public function SeeFiltreEventBeginning($post) {
    
        var_dump($post); 

        $date = "";
        if($post == '-1 week'){
            
        } elseif($post == '2-3 week'){
            
        }

        try {
            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_valid = 1
                                            AND " . DATEDIFF(day,current_date,'2008-06-05'));
           
            var_dump( $select); exit;
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
     * seeEvent.php
     * 
     * Filter by number of teams
     * Linked to the `public function EventTeamNB($str)`
     * 
     * @param Array $post // Number of teams for all the events
     */
    public function SeeFiltreEventNbTeam($post) {
    
        try {
            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_valid = 1");

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

                //var_dump($post);
                $nb_team = $CountGroupEvent['0']['event_nb_team'];
                
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
     * Search Event
     *
     * @param Array $_POST
     */
    public function SearchByEvent($post) {

        include('../lib/blacklist.inc.php');
        $search = addslashes($post);
        $search = preg_replace("/'/", "", $search);

        $expSearch = explode(" ", $search);

        $i = 0;
        $nbArraySearch = count($expSearch);

        $sql = array();
        foreach($expSearch as $phrase)
        {

            //$adv->blacklist
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
                                                LIMIT 7");

            $select2->bindValue(':eventID', $e['event_id'], PDO::PARAM_INT);
            $select2->execute();
            $select2->setFetchMode(PDO::FETCH_ASSOC);
            $AllEvent = $select2->FetchAll();
            $select2->closeCursor(); 
        }

        return $AllEvent;
    }

    /**
     * Search Project
     *
     * @param array $_POST
     */
    public function SearchByProject($post, $eID) {

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

            // var_dump($e);
            $select2 = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "group 
                                                WHERE group_id = :eventID
                                                AND group_valid = 1");

            $select2->bindValue(':eventID', $e['group_id'], PDO::PARAM_INT);
            $select2->execute();
            $select2->setFetchMode(PDO::FETCH_ASSOC);
            $AllGroups = $select2->FetchAll();
            // var_dump($AllGroups);
            $select2->closeCursor(); 

            if(!empty($AllGroups[0]['group_id'])){

                $select3 = $this->connexion->prepare("SELECT sum(donate_amount) AS needed
                                                    FROM cp_donate 
                                                    WHERE group_group_id = :groupID");

                $select3->bindValue(':groupID', $AllGroups[0]['group_id'], PDO::PARAM_INT);
                $select3->execute();
                $select3->setFetchMode(PDO::FETCH_ASSOC);
                $needed = $select3->fetchAll();
                $select3->closeCursor(); 
                
                if($needed[0]['needed'] >= $AllGroups[0]['group_money']){
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

        // var_dump($array); exit;
        return $array;    
    }

/////////////////////////////////////////////////////
/* SEE ONE EVENT * * * * * * * * * * * * * * * * * */
    
    /**
     * seeEvent.php
     * 
     * Filter Kind of race
     * Linked to the `public function SeeOneEvent()`
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
     * seeEvent.php
     * 
     * 
     * @param INT event ID  
     */
    public function SeeGroupID($eID) {
        try {

            $select1 = $this->connexion->prepare("SELECT group_group_id
                                                FROM " . PREFIX . "event_has_group 
                                                WHERE event_event_id = :eventID");

            $select1->bindValue(':eventID', $eID, PDO::PARAM_INT);
            $select1->execute();
            $select1->setFetchMode(PDO::FETCH_ASSOC);
            $AllGroupsID = $select1->FetchAll();
            $select1->closeCursor();

            $array = "";
            if(isset($AllGroupsID[0]['group_group_id']) && !empty($AllGroupsID[0]['group_group_id'])){
                $i = 0;
                foreach ($AllGroupsID as $key => $id) {

                    $select = $this->connexion->prepare("SELECT sum(donate_amount) as group_needed
                                                            FROM cp_donate 
                                                            WHERE group_group_id = :groupID");

                    $select->bindValue(':groupID', $id['group_group_id'], PDO::PARAM_INT);
                    $select->execute();
                    $select->setFetchMode(PDO::FETCH_ASSOC);
                    $n = $select->FetchAll();
                    $select->closeCursor(); 

                    if($n[0]['group_needed'] == null){
                        $n[0]['group_needed'] = '0';
                    }
                    $array[$i] = array_merge($AllGroupsID[$i], $n[0]);

                $i ++;
                }
            }

            return $array;

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        } 
    }

    /**
     * seeEvent.php
     * 
     * 
     * @param Array Groups ID  
     */
    public function SeeGroupEvent($gID, $money = null) {

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

            $array = '';
            $i = 0;
            foreach ($gID as $key => $g) {

                //var_dump($g); exit;
                $select = $this->connexion->prepare("SELECT *
                                                    FROM " . PREFIX . "group 
                                                    WHERE group_id = :groupID
                                                    AND group_valid = 1
                                                    " . $where . "
                                                    AND group_money > :needed");

                //var_dump($select); exit;
                $select->bindValue(':groupID', $g['group_group_id'], PDO::PARAM_INT);
                $select->bindValue(':needed', $g['group_needed'], PDO::PARAM_INT);
                $select->execute();
                $select->setFetchMode(PDO::FETCH_ASSOC);
                $SeeGroupEvent = $select->FetchAll();
                $select->closeCursor(); 

                
                if(!empty($SeeGroupEvent)){
                    $select2 = $this->connexion->prepare('SELECT sum(donate_amount) as group_needed
                                                        FROM cp_donate 
                                                        WHERE group_group_id = :groupID');

                    $select2->bindValue(':groupID', $SeeGroupEvent[0]['group_id'], PDO::PARAM_INT);
                    $select2->execute();
                    $select2->setFetchMode(PDO::FETCH_ASSOC);
                    $Needed = $select2->FetchAll();
                    $select2->closeCursor();
                    // var_dump($Needed);
                }

                if(!empty($Needed[$i]['group_needed'])){
                    $array[$i] = array_merge($SeeGroupEvent[$i], $Needed[$i]);
                } elseif(!empty($SeeGroupEvent[$i])){
                    if(!isset($array[$i]['group_needed'])){
                        $array[$i] = $SeeGroupEvent[$i];
                        $array[$i]['group_needed'] = '0';  
                    }
                } 

            $i ++;   
            }

            // var_dump($array); exit;

            return $array;

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        } 
    }

    /**
     * seeEvent.php
     * 
     * 
     * @param Array Groups ID  
     */
    public function SeeDoneGroup($gID) {
        // var_dump($gID); // exit;
        try {
            $array = '';
            $i = 0;
            foreach ($gID as $key => $g) {

                $select = $this->connexion->prepare("SELECT *
                                                    FROM " . PREFIX . "group 
                                                    WHERE group_id = :groupID
                                                    AND group_valid = 1
                                                    AND group_money < :needed");

                //var_dump($select); exit;
                $select->bindValue(':groupID', $g['group_group_id'], PDO::PARAM_INT);
                $select->bindValue(':needed', $g['group_needed'], PDO::PARAM_INT);
                $select->execute();
                $select->setFetchMode(PDO::FETCH_ASSOC);
                $SeeDoneGroup = $select->FetchAll();
                $select->closeCursor(); 
                
                //var_dump($SeeDoneGroup[0]['group_id']); exit;
                if(!empty($SeeDoneGroup[0]['group_id'])){
                    $array = $SeeDoneGroup;
                }
                
            $i ++;   
            }
            // var_dump($array); exit;

            return $array;

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        } 
    }


    /**
     * mobile application
     *
     */
    public function getEventJSON() {
        try 
        {       
            $select = $this->connexion->prepare("SELECT event_id, event_name, event_location 
                                                FROM " . PREFIX . "event 
                                                WHERE event_valid = 1");
                    
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $event = $select -> FetchAll(); 
            
            $json = json_encode($event);

            return $json;
        }
        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }

    }

    /**
     * mobile application
     *
     */




// if(isset($periode['min'])){
//             $date = new DateTime();
//             $date = $date->sub(new DateInterval($periode['min']));
//             echo $datemin = $date->format('Y-m-d') . "\n";

//             $data .= "AND event_begin >= " . $datemin;
//         } 

//         if(isset($periode['max'])){
//             $date = new DateTime();
//             $date = $date->sub(new DateInterval($periode['max']));
//             echo $datemax = $date->format('Y-m-d') . "\n";

//             $data .= " AND event_begin <= " . $datemax;
//         }
}