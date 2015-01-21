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
	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
		if(isset($_POST['search']) && !empty($_POST['search'])){
		    $this->SearchProject($_POST);
		    
		} elseif(isset($_POST) && !empty($_POST)){
            
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
	
	/**
	 * GETTERS voir l'ensemble des groups
	 */
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
    
    /**
	 * Compter le nombre de groups
	 */
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
	
	/**
	 * SETTERS & GETTERS voir le nom d'un groupe
	 */
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
	
	/**
	 * SETTERS & GETTERS voir la description d'un groupe
	 */
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
	
	/**
	 * SETTERS & GETTERS voir l'image d'un groupe
	 */
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
	
	/**
	 * voir l'emplacement de l'image temporaire
	 */
	public function getEmplacementTmp()
	{
		return $this->GroupEmplacementTmpImg;
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
	 * SETTERS & GETTERS voir si le groupe est validé ou non
	 */
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
	
	
	/**
	 * Ajout d'un nouveau projet dans la base de données
	 */
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
    
    /**
	 * Déplacement du fichier de l'emplacement tmp 'public function getEmplacementTmp()' vers le bon emplacement serveur
	 */
    public function upload($index, $destination)
	{
	   //Test1: fichier correctement uploadé
	    if (!isset($_FILES["image"]) OR $_FILES["image"]['error'] > 0){
		    return FALSE;
		}
	   	//Déplacement
	    return move_uploaded_file($index,$destination);
	}
	
	/**
	 * Voir UN group
	 */
	public function Seeoneproject(){
    	$groupID = $_GET['id'];
    	try {
        	$select = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "group A, " . PREFIX . "event_has_group B, " . PREFIX . "event C
                                                WHERE A.group_id = " . $groupID . "
                                                AND A.group_id = B.group_group_id
                                                AND B.event_event_id = C.event_id");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $OneGroup = $select -> FetchAll();
            
            $select1 = $this->connexion->prepare("SELECT * 
                                                FROM " . PREFIX . "user_has_group A, " . PREFIX . "user B 
                                                WHERE A.group_group_id = " . $groupID . "
                                                AND A.user_user_id = B.user_id");
           
            $select1 -> execute();
            $select1 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneGroupMember = $select1 -> FetchAll();
            
            //var_dump($OneGroup); exit();

            $array = "";
            $array['group'] = $OneGroup;
            $array['group_user'] = $OneGroupMember;
            
            return $array;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
	
	
	/**
	 * Search Project
	 *
	 * @param array $_POST
	 */
	public function SearchProject($post){
	
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
                        // GROUP TABLE BDD
                        $r .= "group_name LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "group_descr LIKE '%".addslashes($e)."%' ";
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
    		                                " . PREFIX . "group
		                                WHERE " . $ajout . "
		                                GROUP BY group_id");
        //var_dump($select);
		$select -> execute();
		$select -> setFetchMode(PDO::FETCH_ASSOC);
		$retour = $select -> fetchAll();
		
		//var_dump($retour); exit();
		return $retour;
    }
    
	
	/**
     * Supprimer un groupe
     */
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