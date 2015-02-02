<?php 

/**
 * ProjectModel
 *
 * Requêtes relatifs aux évenements
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

/**
 * choix de l'action
 * instanciation de la class
 */

class EventModel extends CoreModel{

	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
	}
	
	public function SeeTopEvent(){
    	
    	try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_valid = 1
                                            ORDER BY RAND()
                                            LIMIT 4");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $AllEvent = $select -> FetchAll();
            
            //var_dump($AllEvent);
            return $AllEvent;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
	
	/**
	 * Ajout d'un nouveau projet dans la base de données
	 */
	public function insertNewEvent($post)
	{
        $location = $post['place'] . ', ' . $post['country'];
        //var_dump($_FILES); exit();
        $img = $_FILES['cover']['name'];
        $tmp = $_FILES['cover']['tmp_name'];
		try 
		{		
	        $insert = $this->connexion->prepare("INSERT INTO " . PREFIX . "event
	                                            (`event_name`, `event_decr`, `event_begin`, `event_end`, `event_valid`, `event_location`, `event_img`) 
	                                            VALUES (:name, :descr, :begin, :end, 0, :location, :img)");
	            	
	        $insert->bindParam(':name', $post['name']);
	        $insert->bindParam(':descr', $post['descr']);
            $insert->bindParam(':begin', $post['from']);
            $insert->bindParam(':end', $post['end']);
            $insert->bindParam(':location', $location);
	        $insert->bindParam(':img', $img);

            /*if(!empty($img)) {
				$string= '/public/img/event/slider/'.$img;
				$this->upload($tmp, $string, $img);
			}*/

			$insert->execute();
			
			
		}
        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
    public function upload($index, $destination, $img){
	
	    $extension = $_FILES['cover']['type'];
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
       	
       //$img = $this->getEventImg();
       //copy($destination, '../public/images/event/mini/'.$img);
       
       return true;
    }
    
    
    /**
	 * LIST EVENT - SEEEVENT PAGE
	 */
    public function SeeEvent(){
    	
    	try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_valid = 1
                                            LIMIT 7");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $AllEvent = $select -> FetchAll();

            $array = array('');
            $i = 0;
            while($i < count($AllEvent)){
            
                $select = $this->connexion->prepare("SELECT COUNT(*) as event_nb_team
                                                FROM " . PREFIX . "event_has_group
                                                WHERE event_event_id = " . $AllEvent[$i]['event_id'] . "
                                                LIMIT 7");
               
                $select -> execute();
                $select -> setFetchMode(PDO::FETCH_ASSOC);
                $CountGroupEvent = $select -> FetchAll();
                
                //var_dump($AllEvent[$i], $CountGroupEvent['0']); exit();
                $array[$i]= array_merge($AllEvent[$i], $CountGroupEvent['0']);
                //var_dump($array);

            $i ++;
            }
            
            return $array;

            //var_dump($AllEvent);
            //return $AllEvent;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
	
	/**
	 * FILTRE KIND OF RACE
	 */
    public function SeeFiltreEventType($post){
    
        try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_type = '" . $post . "'");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $ByNb = $select -> FetchAll();
            
            $array = array('');
            $i = 0;
            while($i < count($ByNb)){
            
                $select = $this->connexion->prepare("SELECT COUNT(*) as event_nb_team
                                                FROM " . PREFIX . "event_has_group
                                                WHERE event_event_id = " . $ByNb[$i]['event_id']);
               
                $select -> execute();
                $select -> setFetchMode(PDO::FETCH_ASSOC);
                $CountGroupEvent = $select -> FetchAll();
                
                //var_dump($ByNb[$i], $CountGroupEvent['0']); exit();
                $array[$i]= array_merge($ByNb[$i], $CountGroupEvent['0']);
                //var_dump($array);

            $i ++;
            }

            //var_dump($array);
            return $array;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
    /**
	 * FILTRE BEGINNING EVENT
	 */
    public function SeeFiltreEventBeginning($post){
    
        var_dump($post); 
        if($post == '-1 week'){ $date = '';} // date actuel - 1semaine
        exit();
        
        try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_begin '" . $date . "'");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $ByNb = $select -> FetchAll();
            
            $array = array('');
            $i = 0;
            while($i < count($ByNb)){
            
                $select = $this->connexion->prepare("SELECT COUNT(*) as event_nb_team
                                                FROM " . PREFIX . "event_has_group
                                                WHERE event_event_id = " . $ByNb[$i]['event_id']);
               
                $select -> execute();
                $select -> setFetchMode(PDO::FETCH_ASSOC);
                $CountGroupEvent = $select -> FetchAll();
                
                //var_dump($ByNb[$i], $CountGroupEvent['0']); exit();
                $array[$i]= array_merge($ByNb[$i], $CountGroupEvent['0']);
                //var_dump($array);

            $i ++;
            }

            //var_dump($array);
            return $array;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    }
	
	/**
	 * FILTRE NUMBER OF TEAM
	 */
    public function SeeFiltreEventNbTeam($post){
    
        try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_valid = 1");
           
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $AllEvent = $select -> FetchAll();

            $array = array('');
            $i = 0;
            while($i < count($AllEvent)){
                
                $select = $this->connexion->prepare("SELECT COUNT(*) as event_nb_team
                                                FROM " . PREFIX . "event_has_group
                                                WHERE event_event_id = " . $AllEvent[$i]['event_id']);
               
                //var_dump($select);
                $select -> execute();
                $select -> setFetchMode(PDO::FETCH_ASSOC);
                $CountGroupEvent = $select -> FetchAll();
                
                //var_dump($post);
                $nb_team = $CountGroupEvent['0']['event_nb_team'];
                //echo 'nb team' . $nb_team;
                
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
            echo 'Message:' . $e -> getMessage();
        }
    }

     /**
     * Search User
     *
     * @param array $_POST
     */
    public function Search($post){
    
        // var_dump($post);

        include('../lib/blacklist.inc.php');
        $search = addslashes($post);
        
        $expSearch = explode(" ", $search);

        $i = 0;
        $nbArraySearch = count($expSearch);

        $sql = array();
        foreach($expSearch as $phrase)
        {

            //$adv -> blacklist
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
        
        $select -> execute();
        $select -> setFetchMode(PDO::FETCH_ASSOC); 
        $eventID = $select -> fetchAll();

        // * * * * * * * * * * * * * * * * * * * * * * * * *  //

        foreach ($eventID as $key => $e) {

            //var_dump($e);
            $select = $this->connexion->prepare("SELECT *, 
                                                    ( SELECT COUNT(*) 
                                                    FROM cp_event_has_group 
                                                    WHERE event_event_id = " . $e['event_id'] . ") 
                                                    AS `event_nb_team` 
                                                FROM cp_event 
                                                WHERE event_valid = 1 
                                                AND event_id =" .  $e['event_id'] . "
                                                LIMIT 7");
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $AllEvent = $select -> FetchAll();

        }
        
        return $AllEvent;
    }
}