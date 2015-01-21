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
            
            //var_dump($AllEvent);
            return $AllEvent;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}

	
}