<?php 

/**
 * UserModel
 *
 * Requêtes relatifs a la connexion
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

/**
 * choix de l'action
 * instanciation de la class
 */
class UserModel extends CoreModel{
	private $userBirthday;
	private $userName;
	private $userFirstName;
	private $userMail;
	private $userPseudo;
	private $userPassword;
	private $userProfPic;
	
	/**
	 * Constructor
	 */
	function __construct($_POST){
		parent::__construct();
		

	}


	public function getUserBirthday($id){
		try {
            $select = $this->connexion->prepare("SELECT user_birthday 
                                            FROM " . PREFIX . "user WHERE user_id = :id");
            $select->bindValue(':id', $id, PDO::PARAM_INT);
           
            $userBirthday = $select->execute();
            
            return $userBirthday;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
	}
	public function setUserBirthday($birthday){
		if(is_integer($birthday)){
			$this->$userBirthday = $birthday;
		}
	}

	public function getUserName($id){
		try {
            $select = $this->connexion->prepare("SELECT user_name 
                                            FROM " . PREFIX . "user WHERE user_id = :id");
            $select->bindValue(':id', $id, PDO::PARAM_INT);
           
            $userName = $select->execute();
            
            return $userName;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }	
	}
	
	public function setUserName($name){
		if(is_string($name)){
			$this->$userName = $name;
		}
	}

	public function getUserFirstName($id){
		try {
            $select = $this->connexion->prepare("SELECT user_firstname 
                                            FROM " . PREFIX . "user WHERE user_id = :id");
            $select->bindValue(':id', $id, PDO::PARAM_INT);
           
            $userName = $select->execute();
            
            return $userName;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }	

	}
	public function setUserFirstName($firstName){
		if(is_string($firstName)){
			$this->$userFirstName = $firstName;
		}
	}

	public function getUserMail($id){
		try {
            $select = $this->connexion->prepare("SELECT user_mail 
                                            FROM " . PREFIX . "user WHERE user_id = :id");
            $select->bindValue(':id', $id, PDO::PARAM_INT);
           
            $userMail = $select->execute();
            
            return $userMail;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }	
	}
	public function setUserMail($mail){
		if(is_string($mail)){
			$this->$userMail = $mail;
		}
	}

	public function getUserPseudo($id){
		try {
            $select = $this->connexion->prepare("SELECT user_pseudo 
                                            FROM " . PREFIX . "user WHERE user_id = :id");
            $select->bindValue(':id', $id, PDO::PARAM_INT);
           
            $userPseudo = $select->execute();
            
            return $userPseudo;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }	
	}
	public function setUserPseudo($pseudo){
		if(is_string($pseudo)){
			$this->$userPseudo = $pseudo;
		}
	}
	
	public function getUserPassword($id){
		try {
            $select = $this->connexion->prepare("SELECT user_password 
                                            FROM " . PREFIX . "user WHERE user_id = :id");
            $select->bindValue(':id', $id, PDO::PARAM_INT);
           
            $userPassword = $select->execute();
            
            return $userPassword;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }	
	}
	public function isValidMd5($md5)
	{
	    return preg_match('/^[a-f0-9]{32}$/', $md5);
	}
	public function setUserPassword($password){
		if(isValidMd5($password)){
			$this->$userPassword = $password;
		}
	}
	
	public function isValidImg($fichier){
		$array= getImageSize($fichier); 
		$type= $array[2]; 
		switch($type){ 
		  case 1 : $type= "JPG"; return true; 
		  case 2 : $type= "PNG"; return true; 
		  case 3 : $type= "JPEG"; return true;
		} 
		return false;
		
	}
	public function getUserProfPic($id){
		try {
            $select = $this->connexion->prepare("SELECT user_profil_pic 
                                            FROM " . PREFIX . "user WHERE user_id = :id");
            $select->bindValue(':id', $id, PDO::PARAM_INT);
           
            $userProfPic = $select->execute();
            
            return $userProfPic;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }	
	}
	public function setUserProfPic($profpic){
		if(isValidImg($profpic)){
			$this->$userProfPic = $profpic;
		}
	}





}

?>