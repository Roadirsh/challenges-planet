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
	function __construct($post ){
		parent::__construct();
		
		setUserBirthday($post['birthday']);
		setUserLastName($post['lastname']);
		setUserFirstName($post['firstname']);
		setUserMail($post['mail']);
		setUserPseudo($post['pseudo']);
		setUserPassword(md5($post['password']));
		setUserProfPic($post['profpic']);
		
		$this->insertNewUser($userBirthday, $userLastName, $userFirstName, $userMail, $userPseudo, $userPassword, $userProfPic);
		
		
		

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
	public function RecupUserData($id){
		try {
            $select = $this->connexion->prepare("SELECT user_birthday, user_lastname, user_firstname, user_mail, user_pseudo, user_password, user_profil_pic 
                                            FROM " . PREFIX . "user WHERE user_id = :id");
            $select->bindValue(':id', $id, PDO::PARAM_INT);
           
            $select->execute();
            
            $select = $select->setFetchMode(PDO::FETCH_ASSOC);
            }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
        
        setUserBirthday($select['user_birthday']);
		setUserLastName($select['user_lastname']);
		setUserFirstName($select['user_firstname']);
		setUserMail($select['user_mail']);
		setUserPseudo($select['user_pseudo']);
		setUserPassword($select['user_password']);
		setUserProfPic($select['user_profil_pic']);
	}
	public function getUserBirthday(){
        return $userBirthday;
	}
	public function setUserBirthday($birthday){
		if(is_integer($birthday)){
			$this->$userBirthday = $birthday;
		}
	}

	public function getUserlastName(){
		return $userLastName;
        
	}
	
	public function setUserLastName($name){
		if(is_string($name)){
			$this->$userLastName = $name;
		}
	}

	public function getUserFirstName(){
		return $userFirstName;
	}
	public function setUserFirstName($firstName){
		if(is_string($firstName)){
			$this->$userFirstName = $firstName;
		}
	}

	public function getUserMail(){
		return $userMail;
	}
	function isValidEmail($email){ 
    	return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	public function setUserMail($mail){
		if(isValidEmail($mail)){
			$this->$userMail = $mail;
		}
	}

	public function getUserPseudo(){
		return $userPseudo;
	}
	public function setUserPseudo($pseudo){
		if(is_string($pseudo)){
			$this->$userPseudo = $pseudo;
		}
	}
	
	public function getUserPassword(){
		return $userPassword;
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
	public function getUserProfPic(){
		return $userProfPic;
	}
	public function setUserProfPic($profpic){
		if(isValidImg($profpic)){
			$this->$userProfPic = $profpic;
		}
	}

}

?>