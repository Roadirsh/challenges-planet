<?php 

/**
 * ProjectModel
 *
 * Requêtes relatifs aux groupes de projects
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

/**
 * choix de l'action
 * instanciation de la class
 */
class ProjectModel extends CoreModel{


    private $GroupID;       		// INT
    private $GroupDate;     		// DATE
	private $GroupName;     		// STRING
	private $GroupDescr;    		// LONG STRING
	private $GroupImg;      		// STRING
	private $GroupOnline;			// BOOL
	private $GroupEmplacementTmpImg;// STRING (Emplacement temporaire de l'image)
	private $GroupType;				// STRING
	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
		if(isset($_POST) && !empty($_POST)){
            
            $post = $_POST;
            $this->setGroupName($post['name']);
            $this->setGroupDescr($post['descr']);
            if(isset($post['check']))
            {
    			$this->setGroupOnline(true);
    		}
    		else
    		{
	    		$this->setGroupOnline(false);
    		}
            if(isset($_FILES['image']))
            {
    			$this->setGroupImg($_FILES['image']);
    		}
    		else
    		{
    			$this->setGroupImg('');
    		}
    		
        }
	}
	
	public function getShowProjects(){
    	
    	try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "group");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $AllGroup = $select -> FetchAll();
            
            //var_dump($AllGroup);
            return $AllGroup;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
    
	public function CountProjects(){
    	
    	try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "group");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $countGroup = $select -> rowCount();
            
            return $countGroup;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
	
	public function setGroupName($name)
	{
		if(is_string($name))
		{
			$this->GroupName = $name;
		}
	}
	
	public function getGroupName()
	{
		return $this->GroupName;
	}
	
	public function setGroupDescr($descr)
	{
		if(is_string($descr))
		{
			$this->GroupDescr = $descr;
		}
	}
	
	public function getGroupDescr()
	{
		return $this->GroupDescr;
	}
	
	public function setGroupImg($img)
	{
		if($img['name'] != ''){
			if($this->isValidImg($img['name'])){
				$this->GroupImg = uniqid().$img['name'];
				$this->GroupEmplacementTmpImg = $img['tmp_name'];
			}
		}
	}
	
	public function getGroupImg()
	{
		return $this->GroupImg;
	}
	
	public function getEmplacementTmp()
	{
		return $this->GroupEmplacementTmpImg;
	}
	
	
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
	
	public function setGroupOnline($check)
	{
		if($check == true)
		{
			$this->GroupOnline = true;
		}
		else
		{
			$this->GroupOnline = false;
		}
	}
	
	public function getGroupOnline()
	{
		return $this->GroupOnline;
	}
	
	
	// Ajout d'un nouveau projet dans la base de données
	public function insertNewProject()
	{
		$name = $this->getGroupName();
		$descr = $this->getGroupDescr();
		$check = $this->getGroupOnline();
		$img = $this->getGroupImg();
		$tmp = $this->getEmplacementTmp();
		try 
		{		
	        $insert = $this->connexion->prepare("INSERT INTO `giraudsa`.`cp_group` (`group_id`, `group_date`, `group_name`, `group_descr`, `group_img`, `group_valid`) VALUES (NULL, now(), :name, :descr, :img, :valid)");
	            	
	        $insert->bindParam(':name', $name);
	        $insert->bindParam(':descr', $descr);
	        $insert->bindParam(':img', $img);
            $insert->bindParam(':valid', $check);
	        
			$insert->execute();
				
			if(!empty($img))
			{
				$string= '../public/img/group/'.$img;
				$this->upload($tmp, $string);
			}
		}
        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    public function upload($index, $destination)
	{
		
		
	   //Test1: fichier correctement uploadé
	    if (!isset($_FILES["image"]) OR $_FILES["image"]['error'] > 0){
		    return FALSE;
		}
	   	//Déplacement
	    return move_uploaded_file($index,$destination);
	}
	
	
	public function Delproject(){
    	//var_dump($GLOBALS);
    	$delgroupID = $_GET['id'];
    	
    	try {
    	    // rajouer un trigger corbeille
        	$select = $this->connexion->prepare("DELETE
                                            FROM " . PREFIX . "group
                                            where group_id = '" . $delgroupID . "'");
           
            //var_dump($select); exit();
            $select -> execute();
            
            //var_dump($AllUser);
            return true;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}

}