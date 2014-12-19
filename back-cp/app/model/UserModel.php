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

        if(isset($_POST) && !empty($_POST)){
            
            $post = $_POST;
            
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
    		
        } else {
        
            if(isset($_GET['action']) && !empty($_GET['action'])){
    			//ucfirt = Met le premier caractère en majuscule
    			// echo ucfirst($_GET['action']);
    			$action = ucfirst($_GET['action']);
			    $this->$action();
    
    		}
        }
    		
		
	}

	public function insertNewUser(){
		try {
			
            $insert = $this->connexion->prepare("INSERT INTO `giraudsa`.`cp_user` (`user_id`, `user_date`, `user_birthday`, `user_lastname`, `user_firstname`, `user_mail`, `user_pseudo`, `user_password`, `user_profil_pic`) VALUES (NULL, now(), :birthday, :lastname, :firstname, :mail, :pseudo, :password, :profpic)");
            
			$birthday = $this->getUserBirthday();
			$firstName = $this->getUserFirstName();
			$lastName = $this->getUserlastName();
			$mail = $this->getUserMail();
			$pseudo = $this->getUserPseudo();
			$password = $this->getUserPassword();
			$profpic = $this->getUserProfPic();
			
            $insert->bindParam(':birthday', $birthday);
            $insert->bindParam(':lastname', $lastName);
            $insert->bindParam(':firstname', $firstName);
            $insert->bindParam(':mail', $mail);
            $insert->bindParam(':pseudo', $pseudo);
            $insert->bindParam(':password', $password);
            $insert->bindParam(':profpic', $profpic);
            
			$insert->execute();
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }

	}
	static function RecupUserData($id){
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
        
        $this->setUserBirthday($select['user_birthday']);
		$this->setUserLastName($select['user_lastname']);
		$this->setUserFirstName($select['user_firstname']);
		$this->setUserMail($select['user_mail']);
		$this->setUserPseudo($select['user_pseudo']);
		$this->setUserPassword($select['user_password']);
		$this->setUserProfPic($select['user_profil_pic']);
	}
	public function getUserBirthday(){
        return $this->userBirthday;
	}
	public function setUserBirthday($birthday){
		$birthday = (int) date('Ymd', strtotime($birthday)); //en int.
		$this->userBirthday = $birthday;
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
	
	
	
	
	// Afficher l'ensembles de users
	// static function Seeuser(){
	public function Seeuser(){
    	//var_dump($GLOBALS);
    	try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "user
                                            where user_type != 'admin'");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $AllUser = $select -> FetchAll();
            
            //var_dump($AllUser);
            return $AllUser;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}

}

?>