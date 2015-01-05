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
		
		if(isset($_POST) && !empty($_POST)){
            
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
	    //Test1: fichier correctement uploadé
	    if (!isset($_FILES["imageEvent"]) OR $_FILES["imageEvent"]['error'] > 0){
		    return FALSE;
		}
	   	//Déplacement
	    return move_uploaded_file($index,$destination);
	}

}