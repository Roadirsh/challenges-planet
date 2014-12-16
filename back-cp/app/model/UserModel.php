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
	function __construct($post){
		parent::__construct();
		
		$this->setUserBirthday($post['birthday']);
		$this->setUserLastName($post['lastname']);
		$this->setUserFirstName($post['firstname']);
		$this->setUserMail($post['mail']);
		$this->setUserPseudo($post['pseudo']);
		$this->setUserPassword(md5($post['password']));
		if(isset($_POST['profil'])){
			$this->setUserProfPic($post['profpic']);
		}else{
			$this->setUserProfPic('');
		}
	}

	public function insertNewUser(){
		try {
			
            $insert = $this->connexion->prepare("INSERT INTO `giraudsa`.`cp_user` (`user_id`, `user_date`, `user_birthday`, `user_lastname`, `user_firstname`, `user_mail`, `user_pseudo`, `user_password`, `user_profil_pic`) VALUES (NULL, now(), ':birthday', ':lastname', ':firstname', ':mail', ':pseudo', ':password', :profpic)");
            
			var_dump($this->getUserBirthday());            
            $insert->bindParam(':birthday', $this->getUserBirthday());
            $insert->bindParam(':lastname', $this->getUserlastName());
            $insert->bindParam(':firstname', $this->getUserFirstName());
            $insert->bindParam(':mail', $this->getUserMail());
            $insert->bindParam(':pseudo', $this->getUserPseudo());
            $insert->bindParam(':password', $this->getUserPassword());
            $insert->bindParam(':profpic', $this->getUserProfPic());
            
			$insert->execute();
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
        return $this->userBirthday;
	}
	public function setUserBirthday($birthday){
		if(is_integer($birthday)){
			$this->userBirthday = $birthday;
		}
	}

	public function getUserlastName(){
		return $this->userLastName;
        
	}
	
	public function setUserLastName($name){
		if(is_string($name)){
			$this->userLastName = $name;
		}
	}

	public function getUserFirstName(){
		return $this->userFirstName;
	}
	public function setUserFirstName($firstName){
		if(is_string($firstName)){
			$this->userFirstName = $firstName;
		}
	}

	public function getUserMail(){
		return $this->userMail;
	}
	public function isValidEmail($email){ 
    	return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	
	public function setUserMail($mail){
		if($this->isValidEmail($mail)){
			$this->userMail = $mail;
		}
	}

	public function getUserPseudo(){
		return $this->userPseudo;
	}
	public function setUserPseudo($pseudo){
		if(is_string($pseudo)){
			$this->userPseudo = $pseudo;
		}
	}
	
	public function getUserPassword(){
		return $this->userPassword;
	}
	public function isValidMd5($md5)
	{
	    return preg_match('/^[a-f0-9]{32}$/', $md5);
	}
	public function setUserPassword($password){
		if($this->isValidMd5($password)){
			$this->userPassword = $password;
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
		return $this->userProfPic;
	}
	public function setUserProfPic($profpic){
		if($profpic != ''){
			if($this->isValidImg($profpic)){
				$this->userProfPic = $profpic;
			}
		}
	}

}

?>