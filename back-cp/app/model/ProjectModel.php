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
	private $GroupStudent;
	private $GroupEvent;
	private $GroupMoney;
	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
		if(isset($_POST['search']) && !empty($_POST['search'])){
		    $this->SearchProject($_POST);
		    
		} elseif(isset($_POST) && !empty($_POST)){
            
    
            $post = $_POST;
            if(!isset($post['update']) ){ 
	            $this->setGroupStudent($post['student']);
	            $this->setGroupEvent($post['event']);
	            $this->setGroupName($post['name']);
	            $this->setGroupDescr($post['descr']);
	            $this->setGroupMoney($post['money']);
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
	}
	
	// Récupére la liste des étudiants et la liste des événements en ligne
	public function getDataAdd()
	{
		try
		{
			$selectEvent = $this->connexion->prepare("SELECT event_id, event_name FROM " . PREFIX . "event where event_valid = 1");
			$selectEvent->execute();
            $selectEvent -> setFetchMode(PDO::FETCH_ASSOC);
			$listEvent = $selectEvent->FetchAll();
			
			$selectUser = $this->connexion->prepare("SELECT user_id, user_pseudo, user_mail FROM " . PREFIX . "user where user_type = 'student'");
			$selectUser->execute();
            $selectUser -> setFetchMode(PDO::FETCH_ASSOC);
			$listUser = $selectUser->FetchAll();
			$array = array($listEvent, $listUser);

			
			return $array;

		}
		catch (Exeption $e)
		{
			echo 'Message:' . $e->getMessage();
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
		
		$newwidth=378;
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		
		
		
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,
		 $width,$height);
		
		
		
		$filename = $destination;
		
		imagejpeg($tmp,$filename,100);
		
		imagedestroy($src);
		imagedestroy($tmp);
		
	   	
		   
	   return true;
	}
	
	public function getExtension($fichier){
		$extension_upload = strtolower(  substr(  strrchr($fichier, '.') ,1)  );
		return $extension_upload;
	}
	
	/**
	 * SETTERS & GETTERS étudiant
	 */
	public function setGroupStudent($students)
	{
		try 
		{
			$this->GroupStudent = array();
			foreach($students as $student){
				
			
				$selectUser = $this->connexion->prepare("SELECT count(*) as exist FROM " . PREFIX . "user where user_id = :student");
				$selectUser->bindParam(':student', $student);
	
				$selectUser->execute();
				
	            $selectUser -> setFetchMode(PDO::FETCH_ASSOC);
				$user = $selectUser->FetchAll();
				if($user[0]['exist'] == 1)
				{
					
					array_push($this->GroupStudent, $student);
				}
			}

		}
		catch (Exception $e) 
		{
            echo 'Message:' . $e -> getMessage();
        }
		
	}
	public function getGroupStudent()
	{
		return $this->GroupStudent;
	}
	
	/**
	 * SETTERS & GETTERS événement
	 */
	public function setGroupEvent($event)
	{
		try 
		{
			$selectEvent = $this->connexion->prepare("SELECT count(*) as exist FROM " . PREFIX . "event where event_id = :event");
			$selectEvent->bindParam(':event', $event);

			$selectEvent->execute();
			
            $selectEvent -> setFetchMode(PDO::FETCH_ASSOC);
			$Event = $selectEvent->FetchAll();
			if($Event[0]['exist'] == 1)
			{
				$this->GroupEvent = $event;
			}

		}
		catch (Exception $e) 
		{
            echo 'Message:' . $e -> getMessage();
        }
		
	}
	public function getGroupEvent()
	{
		return $this->GroupEvent;
	}

	/**
	 * SETTERS & GETTERS montant recherché
	 */
	public function setGroupMoney($money)
	{	
		$this->GroupMoney = $money;
	}
	public function getGroupMoney()
	{
		return $this->GroupMoney;
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
	 * Vérification si l'utilisateur participe à l'événement
	 */
	public function isUserExistInEvent($student, $event)
	{
		try {
			
				
			
	            $select = $this->connexion->prepare("SELECT count(*) as exist
	                                            FROM " . PREFIX . "event_has_user WHERE event_event_id = :event AND user_user_id = :student");
	            			
	            $select->bindParam(':student', $student);
	            $select->bindParam(':event', $event);
	            $select->execute();
				$select->setFetchMode(PDO::FETCH_ASSOC);
				$select = $select -> FetchAll();
				if($select[0]['exist'] == 1)
				{
					return true;
				}else{
					return false;
				}
			
			
			
							
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }

	}
	public function isUserInGroup($student, $group){
		try {
			
				
			
	            $select = $this->connexion->prepare("SELECT count(*) as exist
	                                            FROM " . PREFIX . "user_has_group WHERE group_group_id = :group AND user_user_id = :student");
	            			
	            $select->bindParam(':student', $student);
	            $select->bindParam(':group', $group);
	            $select->execute();
				$select->setFetchMode(PDO::FETCH_ASSOC);
				$select = $select -> FetchAll();
				if($select[0]['exist'] == 1)
				{
					return true;
				}else{
					return false;
				}
			
			
			
							
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
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
		$event = $this->getGroupEvent();
		$students = $this->getGroupStudent();
		$money = $this->getGroupMoney();
		
		
		
		
		
			try 
			{		
				
				$this->connexion->beginTransaction();
		        $insert = $this->connexion->prepare("INSERT INTO `giraudsa`.`cp_group` (`group_id`, `group_date`, `group_name`, `group_descr`, `group_img`, `group_money`, `group_valid`) VALUES (NULL, now(), :name, :descr, :img, :money, :valid)");
		            	
		        $insert->bindParam(':name', $name);
		        $insert->bindParam(':descr', $descr);
		        $insert->bindParam(':img', $img);
				$insert->bindParam(':money', $money);
	            $insert->bindParam(':valid', $check);
		        
				$insert->execute();
				$idGroup = $this->connexion->lastInsertId();
				if(!empty($img))
				{
					$string= PROJECT.$img;
					$this->upload($tmp, $string);
				}
				
				
				$insertEventHasGroup = $this->connexion->prepare("INSERT INTO `cp_event_has_group` (`event_event_id`, `group_group_id`) VALUES (:event, :group)");
				$insertEventHasGroup->bindParam(':event', $event);
				$insertEventHasGroup->bindParam(':group', $idGroup);
				$insertEventHasGroup->execute();
				
				foreach($students as $student){
					$userExist = $this->isUserExistInEvent($student, $event);
					if(!$userExist){
			
						
					$insertEventHasUser = $this->connexion->prepare("INSERT INTO `cp_event_has_user` (`event_event_id`, `user_user_id`) VALUES (:event, :user)");
					$insertEventHasUser->bindParam(':event', $event);
					$insertEventHasUser->bindParam(':user', $student);
					$insertEventHasUser->execute();
					
					$insertUserHasGroup = $this->connexion->prepare("INSERT INTO `cp_user_has_group` (`user_user_id`, `group_group_id`) VALUES (:user, :group)");
					$insertUserHasGroup->bindParam(':user', $student);
					$insertUserHasGroup->bindParam(':group', $idGroup);
					$insertUserHasGroup->execute();
					}else{
						return false;
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
            
            $select1 = $this->connexion->prepare("SELECT user_id, user_mail, user_pseudo 
                                                FROM " . PREFIX . "user_has_group A, " . PREFIX . "user B 
                                                WHERE A.group_group_id = " . $groupID . "
                                                AND A.user_user_id = B.user_id");
           
            $select1 -> execute();
            $select1 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneGroupMember = $select1 -> FetchAll();
            
            $select2 = $this->connexion->prepare("SELECT user_id, user_mail, user_pseudo FROM cp_user where user_type='student'");
            $select2 -> execute();
            $select2 -> setFetchMode(PDO::FETCH_ASSOC);
            $users = $select2->FetchAll();
            //var_dump($OneGroup); exit();

            $array = "";
            $array['group'] = $OneGroup;
            $array['group_user'] = $OneGroupMember;
            $array['listeuser'] = $users;
            
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
        $search = addslashes($post['search']);
        
        $expSearch = explode(" ", $search);
        

	    $i = 0;
	    $nbArraySearch = count($expSearch);
   	    foreach($expSearch as $phrase)
	    {
			$r = "WHERE ";
	        if(!empty($phrase))
	        {
				//$adv -> blacklist
	            if(!in_array(strtolower($phrase), $adv))
	            { 
                    // USER TABLE BDD
                    $r .= "( group_name LIKE '%".addslashes($phrase)."%' ";
                    if($i < $nbArraySearch){
    	                $r .= "OR ";
                    }
                    $r .= "group_descr LIKE '%".addslashes($phrase)."%' ";
					if($i < $nbArraySearch){
                        $r .= "OR ";
                    }
                    
	            }
				$r = substr($r, 0, -3);
				$r .= "  ) ";
				$i ++; 
	    	}
	    	if(!empty($r))
			{
		   		$ajout = $r;
	       	}
			else 
			{
				$ajout = "";
        	}
	    }
			$query = "SELECT * FROM " . PREFIX . "group " . $ajout . "  GROUP BY group_id";
		    $select = $this->connexion->prepare($query);
        //var_dump($select);
		$select -> execute();
		$select -> setFetchMode(PDO::FETCH_ASSOC);
		$retour = $select -> fetchAll();
		
		return $retour;
    }
    
	public function getUsersByGroup($group){
		
		try {
			
            $select = $this->connexion->prepare("select `user_user_id` from cp_user_has_group where `group_group_id` = :group");
            			
            $select->bindParam(':group', $group);
            $select->execute();
			$select->setFetchMode(PDO::FETCH_ASSOC);
			$select = $select -> FetchAll();
			
			return $select;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }


	}
	/**
     * Supprimer un groupe
     */
	public function Delproject(){
    	//var_dump($GLOBALS);
    	$delgroupID = $_GET['id'];
    	
    	
    	
    	try {
	    	
	    	$this->connexion->beginTransaction();
	    	
	    	$select  = $this->connexion->prepare("Select group_img FROM " . PREFIX . "group where group_id = '" . $delgroupID . "'" );
	    	$select->execute();
	    	$select -> setFetchMode(PDO::FETCH_ASSOC);
			$retour = $select -> fetch();

			$retour = $retour['group_img'];
			$file = PROJECT . $retour;
			
			
			if(file_exists($file) && $file != PROJECT)
			{
	    		unlink($file);
			}
	    	
	    	$users = $this->getUsersByGroup($delgroupID);
	    	
	    	foreach ($users as $key => $value)
	    	{
				$select = $this->connexion->prepare("DELETE
                                            FROM " . PREFIX . "event_has_user
                                            where user_user_id = '" . $value["user_user_id"] . "'");
                                          
				$select -> execute();

			}

    	    // rajouer un trigger corbeille
        	$select = $this->connexion->prepare("DELETE
                                            FROM " . PREFIX . "group
                                            where group_id = '" . $delgroupID . "'");
                                            
                                          
           
            $select -> execute();
           
            
            $select = $this->connexion->prepare("DELETE
                                            FROM " . PREFIX . "user_has_group
                                            where group_group_id = '" . $delgroupID . "'");
                                            
                                          
           
            $select -> execute();

            
            $select = $this->connexion->prepare("DELETE
                                            FROM " . PREFIX . "event_has_group
                                            where group_group_id = '" . $delgroupID . "'");
                                            
                                          
           
            $select -> execute();
            
            

            $this->connexion->commit();
            //var_dump($AllUser);
            return true;
            
            
    	} catch (Exception $e) {
	    	$this->connexion->rollback();
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
	
	/**
	 * Update un utilisateur
	 */
	public function UponeProject(){
	    $groupId = $_GET['id'];
	    


    	try {
    	    // UPDATE DANS LA TABLE USER 
			$this->connexion->beginTransaction();
			
			
			
			
			
			
			
			
			
			$requete = "UPDATE " . PREFIX . "group SET `group_name` = :name, `group_descr` = :description, `group_img` = :img, `group_money` = :money, group_valid = :valid WHERE group_id = :id";
    	    
    	    $update = $this->connexion->prepare($requete); 

            $update->bindParam(':name', $_POST['group_name']);
            $update->bindParam(':description', $_POST['mce_0']);
            $update->bindParam(':money', $_POST['group_money']);
            $update->bindParam(':id', $groupId);
            $update->bindParam(':valid', $_POST['valid']);
            
            
            if(isset($_FILES) && !empty($_FILES['group_img']['name']))
            {
	            $select  = $this->connexion->prepare("Select group_img FROM " . PREFIX . "group where group_id = '" . $groupId . "'" );
				$select->execute();
				$select -> setFetchMode(PDO::FETCH_ASSOC);
				$retour = $select -> fetch();

				$retour = $retour['group_img'];
				$file = PROJECT . $retour;
			
				if(file_exists($file) && $file != PROJECT)
				{
	    			unlink($file);
				}
	            $imgpic = uniqid().$_FILES['group_img']['name'];
	            $update->bindParam(':img', $imgpic);
				$string= PROJECT . $imgpic;
				$this->upload($_FILES['group_img']['tmp_name'], $string);
				
				

            }
            else
            {
	        	$update->bindParam(':img', $_POST['grouppic']);

            }
            
			$update->execute();
			
			
			foreach($_POST['members'] as $userID){
				
				if(!$this->isUserExistInEvent($userID, $_POST['event_id']) && !$this->isUserInGroup($userID, $groupId))
				{
				// UPDATE DANS LA TABLE ADRESS HOME
				
				$insert = $this->connexion->prepare("INSERT INTO cp_event_has_user (event_event_id, user_user_id) VALUES (:eventid, :userid)");
				$insert->bindParam(':eventid', $_POST['event_id']);
				$insert->bindParam('userid', $userID);
				$insert->execute();
				
				$insert = $this->connexion->prepare("INSERT INTO cp_user_has_group (group_group_id, user_user_id) VALUES (:groupid, :userid)");
				$insert->bindParam(':groupid', $groupId);
				$insert->bindParam('userid', $userID);
				$insert->execute();
				}
			}
			
			$membresActuels = $this->getUsersByGroup($groupId);
			foreach($membresActuels as $membre){
				
				if(!in_array($membre['user_user_id'], $_POST['members'])){
		
				$delete = $this->connexion->prepare("DELETE
	                                        FROM " . PREFIX . "user_has_group
	                                        where user_user_id = '" . $membre['user_user_id'] . "'");
					$delete -> execute();
					$delete = $this->connexion->prepare("DELETE
	                                        FROM " . PREFIX . "event_has_user
	                                        where user_user_id = '" . $membre['user_user_id'] . "'");
					$delete -> execute();
					}
			}
			$this->connexion->commit();

			return $groupId;
	
        } catch (Exception $e) {
	        $this->connexion->rollBack();
            echo 'Message:' . $e -> getMessage();
        }

	}

}