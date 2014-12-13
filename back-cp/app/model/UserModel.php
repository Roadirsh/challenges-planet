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
	private $userLastName;
	private $userFirstName;
	private $userMail;
	private $userPseudo;
	private $userPassword;
	private $userProfPic;
	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
		

	}

	public function insertNewUser($birthday, $lastname, $firstName, $mail, $pseudo, $password, $profpic = ''){
		try {
            $insert = $this->connexion->prepare("INSERT INTO `giraudsa`.`cp_user` (`user_id`, `user_date`, `user_birthday`, `user_lastname`, `user_firstname`, `user_mail`, `user_pseudo`, `user_password`, `user_profil_pic`) VALUES (NULL, now(), ':birthday', ':lastname', ':firstname', ':mail', ':pseudo', ':password', :profpic)");
            
            
            $select->bindParam(':birthday', $birthday);
            $select->bindParam(':lastname', $lastname);
            $select->bindParam(':firstname', $firstName);
            $select->bindParam(':mail', $mail);
            $select->bindParam(':pseudo', $pseudo);
            $select->bindParam(':password', $password);
            $select->bindParam(':profpic', $profpic);
            
			$select->execute();
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }

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

	public function getUserlastName($id){
		try {
            $select = $this->connexion->prepare("SELECT user_lastname 
                                            FROM " . PREFIX . "user WHERE user_id = :id");
            $select->bindValue(':id', $id, PDO::PARAM_INT);
           
            $userLastName = $select->execute();
            
            return $userLastName;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }	
	}
	
	public function setUserName($name){
		if(is_string($name)){
			$this->$userLastName = $name;
		}
	}

	public function getUserFirstName($id){
		try {
            $select = $this->connexion->prepare("SELECT user_firstname 
                                            FROM " . PREFIX . "user WHERE user_id = :id");
            $select->bindValue(':id', $id, PDO::PARAM_INT);
           
            $userFirstName = $select->execute();
            
            return $userFirstName;
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
	function isValidEmail($email){ 
    	return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	public function setUserMail($mail){
		if(isValidEmail($mail)){
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