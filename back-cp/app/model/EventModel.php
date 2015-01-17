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
	private $EventName;
	private $EventDescr;
	private $EventImg;
	private $EventBegin;
	private $EventEnd;
	private $EventOnline;
	private $EventEmplacementTmpImg; // STRING (Emplacement temporaire de l'image)

	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
		
		if(isset($_POST['search']) && !empty($_POST['search'])){
		    $this->SearchEvent($_POST);
		    
		} elseif(isset($_POST) && !empty($_POST)){
            
            $post = $_POST;
            $this->setEventName($post['nameEvent']);
            $this->setEventDescr($post['descrEvent']);
            if(isset($_FILES['imageEvent']))
            {
    			$this->setEventImg($_FILES['imageEvent']);
    		}
    		else
    		{
    			$this->setEventImg('');
    		}
    		$this->setEventBegin($post['dateBegin']);
    		$this->setEventEnd($post['dateEnd']);
    		if(isset($post['check']))
            {
    			$this->setEventOnline(true);
    		}
    		else
    		{
	    		$this->setEventOnline(false);
    		}
    		
        }
	}
	
	/**
	 * Voir l'ensemble des évenements
	 */
	public function getShowEvents(){
    	
    	try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event");
           
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
	 * Voir l'ensemble des évenements
	 */
	public function Seeoneevent(){
    	
    	$eventID = $_GET['id'];
    	try {
        	$select2 = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event
                                            WHERE event_id = " . $eventID);
           
            $select2 -> execute();
            $select2 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneEvent = $select2 -> FetchAll();
            
            $select3 = $this->connexion->prepare("SELECT B.group_id, B.group_name 
                                                FROM " . PREFIX . "event_has_group A, " . PREFIX . "group B
                                                WHERE A.event_event_id = " . $eventID . "
                                                AND B.group_id = A.group_group_id
                                                group by A.group_group_id");
           
            $select3 -> execute();
            $select3 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneEventGroup = $select3 -> FetchAll();

            //var_dump($AllEvent);
            $array = "";
            $array['event'] = $OneEvent;
            $array['event_group'] = $OneEventGroup;
            
            return $array;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
	
    /**
	 * Compter l'ensemble des évenements
	 */
	public function CountEvents(){
    	
    	try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $countEvent = $select -> rowCount();
            
            return $countEvent;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
	
	/**
	 * Search Event
	 *
	 * @param array $_POST
	 */
	public function searchEvent($post){
	
	    include('../lib/blacklist.inc.php');
        $post = $_POST['search'];
        $exp = explode(" ", $post);

	    $i = 0;
	    $count = count($exp);
        
	    foreach($exp as $k => $e)
	    {
	        if(!empty($e))
	        {
	            if(strlen($e) > 3)
	            {
	                if(!in_array(strtolower($e), $adv))
	                { 
	                    $r = '';
                        // EVENT TABLE BDD
	                    $r .= "event_name LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "event_decr LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "event_location LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
	                }
	            }
	        }
	        $i ++; 
	    }

	    $r = substr($r, 0, -4);
	    if(!empty($r)): $ajout = $r; endif;
	    
	    
	    
	    $select = $this->connexion->prepare("SELECT *
		                                FROM 
    		                                " . PREFIX . "event
		                                WHERE " . $ajout . "
		                                GROUP BY event_id");
        //var_dump($select);
		$select -> execute();
		$select -> setFetchMode(PDO::FETCH_ASSOC);
		$retour = $select -> fetchAll();
		
		//var_dump($retour); exit();
		return $retour;
    }
	
	/**
	 * Supprimer un évenement
	 */
	public function Delevent(){
    	//var_dump($GLOBALS);
    	$deleventID = $_GET['id'];
    	
    	try {
    	    // rajouer un trigger corbeille
        	$select = $this->connexion->prepare("DELETE
                                            FROM " . PREFIX . "event
                                            where event_id = '" . $deleventID . "'");
           
            //var_dump($select); exit();
            $select -> execute();
            
            //var_dump($AllUser);
            return true;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
	
	/**
	 * SETTERS & GETTERS voir le nom d'un évenement
	 */
	public function setEventName($name)
	{
		if(is_string($name))
		{
			$this->EventName = $name;
		}
	}
	public function getEventName()
	{
		return $this->EventName;
	}
	
	/**
	 * SETTERS & GETTERS voir la description d'un évenement
	 */
	public function setEventDescr($descr)
	{
		if(is_string($descr))
		{
			$this->EventDescr = $descr;
		}
	}
	public function getEventDescr()
	{
		return $this->EventDescr;
	}
	
	/**
	 * SETTERS & GETTERS voir l'image d'un évenement
	 */
	public function setEventImg($img)
	{
		if($img['name'] != ''){
			if($this->isValidImg($img['name'])){
				$this->EventImg = uniqid().$img['name'];
				$this->EventEmplacementTmpImg = $img['tmp_name'];
			}
		}
	}
	public function getEventImg()
	{
		return $this->EventImg;
	}
	// Récupérer l'emplacement d'une image
	public function getEmplacementTmp()
	{
		return $this->EventEmplacementTmpImg;
	}
	
	/**
	 * Vérifier le format de l'image
	 */
	public function isValidImg($fichier){
		$extensions_valides = array( 'jpg' , 'jpeg' , 'png' );
		$extension_upload = strtolower(  substr(  strrchr($fichier, '.') ,1)  );
		if(in_array($extension_upload,$extensions_valides) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * SETTERS & GETTERS voir si l'évenement est validé ou non
	 */
	public function setEventOnline($check)
	{
		if($check == true)
		{
			$this->EventOnline = true;
		}
		else
		{
			$this->EventOnline = false;
		}
	}
	public function getEventOnline()
	{
		return $this->EventOnline;
	}
	
	/**
	 * SETTERS & GETTERS voir la date de début d'un évenement
	 */
    public function setEventBegin($begin)
    {
		$this->EventBegin = $begin;
    }
	public function getEventBegin()
	{
		return $this->EventBegin;
	}
    
    /**
	 * SETTERS & GETTERS voir la date de fin d'un évenement
	 */
    public function setEventEnd($end)
	{
		$this->EventEnd = $end;
	}
	public function getEventEnd()
	{
		return $this->EventEnd;
	}

    /**
	 * Ajout d'un nouveau projet dans la base de données
	 */
	public function insertNewEvent()
	{
		$name = $this->getEventName();
		$descr = $this->getEventDescr();
		$check = $this->getEventOnline();
		$img = $this->getEventImg();
		$tmp = $this->getEmplacementTmp();
		$begin = $this->getEventBegin();
		$end = $this->getEventEnd();
		try 
		{		
	        $insert = $this->connexion->prepare("INSERT INTO `giraudsa`.`cp_event` (`event_id`, `event_date`, `event_name`, `event_decr`, `event_img`, `event_begin`, `event_end`, `event_valid`) VALUES (NULL, now(), :name, :descr, :img, :begin, :end, :valid)");
	            	
	        $insert->bindParam(':name', $name);
	        $insert->bindParam(':descr', $descr);
	        $insert->bindParam(':img', $img);
            $insert->bindParam(':valid', $check);
            $insert->bindParam(':begin', $begin);
            $insert->bindParam(':end', $end);

	        
			$insert->execute();
				
			if(!empty($img))
			{
				$string= '../public/img/event/'.$img;
				$this->upload($tmp, $string);
			}
		}
        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
    /**
	 * Déplacement du fichier de l'emplacement tmp 'public function getEmplacementTmp()' vers le bon emplacement serveur
	 */
    public function upload($index, $destination)
	{

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
		
		$newwidth=1280;
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		
		$newwidth1=196;
		$newheight1=($height/$width)*$newwidth1;
		$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
		
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,
		 $width,$height);
		
		imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1, 
		$width,$height);
		
		$filename = $destination;
		$filename1 = '../public/images/event/mini/'.$img;
		
		imagejpeg($tmp,$filename,100);
		imagejpeg($tmp1,$filename1,100);
		
		imagedestroy($src);
		imagedestroy($tmp);
		imagedestroy($tmp1);

		
		
		
		
		
		
		
		
		
		
	    //Test1: fichier correctement uploadé
	    if (!isset($_FILES["imageEvent"]) OR $_FILES["imageEvent"]['error'] > 0){
		    return FALSE;
		}
	   	//Déplacement
	    return move_uploaded_file($index,$destination);
	}

}