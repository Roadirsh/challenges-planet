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
	private $nameImg;
	private $userProfPicTmp;
	private $userType;
	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
		
        if(isset($_POST) && !empty($_POST)){
            
            $post = $_POST;
            $this->setUserType($post['type']);
            $this->setUserBirthday($post['birthday']);
    		$this->setUserLastName($post['lastname']);
    		$this->setUserFirstName($post['firstname']);
    		$this->setUserMail($post['mail']);
    		$this->setUserPseudo($post['pseudo']);
    		$this->setUserPassword(md5($post['password']));
            if(isset($_FILES['profil'])){
    			$this->setUserProfPic($_FILES['profil']);
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
	
	/**
	 * Déplacement du fichier de l'emplacement tmp 'public function $userProfPicTmp()' vers le bon emplacement serveur
	 */
	public function upload($index, $destination)
	{
	   //Test1: fichier correctement uploadé
	    if (!isset($_FILES["profil"]) OR $_FILES["profil"]['error'] > 0){
		    return FALSE;
		}
	   	//Déplacement
	    return move_uploaded_file($index,$destination);
	}
	
	/**
	 * Vérification de l'existence d'un user, pour éviter les doublons
	 */
	public function user_exist($pseudo)
	{
		try {
			
            $select = $this->connexion->prepare("SELECT count(*) as exist
                                            FROM " . PREFIX . "user WHERE user_pseudo = :pseudo");
            			
            $select->bindParam(':pseudo', $pseudo);
            $select->execute();
			$select->setFetchMode(PDO::FETCH_ASSOC);
			$select = $select -> FetchAll();
			
			if($select[0]['exist'] == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }

	}
	/**
	 * Ajout d'un utilisateur si il n'existe pas déjà
	 */
	public function insertNewUser(){
		$birthday = $this->getUserBirthday();
		$firstName = $this->getUserFirstName();
		$lastName = $this->getUserlastName();
		$mail = $this->getUserMail();
		$pseudo = $this->getUserPseudo();
		$password = $this->getUserPassword();
		$profpic = $this->getUserProfPic();
		$tmp = $this->getEmplacementImg();
		$type = $this->getUserType();
		$user_exist = $this->user_exist($pseudo);
		if($user_exist)
		{
			return true;
		}
		else
		{
			try {
				
	            $insert = $this->connexion->prepare("INSERT INTO `giraudsa`.`cp_user` (`user_id`, `user_date`, `user_birthday`, `user_lastname`, `user_firstname`, `user_mail`, `user_pseudo`, `user_password`, `user_profil_pic`, `user_type`) VALUES (NULL, now(), :birthday, :lastname, :firstname, :mail, :pseudo, :password, :profpic, :type)");
	            
				
				
	            $insert->bindParam(':birthday', $birthday);
	            $insert->bindParam(':lastname', $lastName);
	            $insert->bindParam(':firstname', $firstName);
	            $insert->bindParam(':mail', $mail);
	            $insert->bindParam(':pseudo', $pseudo);
	            $insert->bindParam(':password', $password);
	            $insert->bindParam(':profpic', $profpic);
	            $insert->bindParam(':type', $type);
	            
				$insert->execute();
				
				if(!empty($profpic)){
					$string= '../public/img/avatar/'.$profpic;
					$this->upload($tmp, $string);
				}
				return false;
	        }
	
	        catch (Exception $e)
	        {
	            echo 'Message:' . $e -> getMessage();
	        }
        }

	}
	
	/**
	 * SETTERS & GETTERS voir le type de l'utilisateur (admin, étudiant, organisme)
	 */
	public function getUserType()
	{
		return $this->userType;
	}
	public function setUserType($type)
	{
		if(is_string($type))
		{
			$this->userType = $type;
		}
	}
	
	/**
	 * SETTERS & GETTERS voir la date d'anniversaire d'un utilisateur
	 */
	public function getUserBirthday(){
        return $this->userBirthday;
	}
	public function setUserBirthday($birthday){
		$birthday = (int) date('Ymd', strtotime($birthday)); //en int.
		$this->userBirthday = $birthday;
	}

    /**
	 * SETTERS & GETTERS voir le nom de famille de l'utilisateur
	 */
	public function getUserlastName(){
		return $this->userLastName;
        
	}
	public function setUserLastName($name){
		if(is_string($name)){
			$this->userLastName = $name;
		}
	}

    /**
	 * SETTERS & GETTERS voir le prénom de l'utilisateur
	 */
	public function getUserFirstName(){
		return $this->userFirstName;
	}
	public function setUserFirstName($firstName){
		if(is_string($firstName)){
			$this->userFirstName = $firstName;
		}
	}

    /**
	 * SETTERS & GETTERS voir le mail de l'utilisateur
	 */
	public function getUserMail(){
		return $this->userMail;
	}
	// vérification de la validité du mail
	public function isValidEmail($email){ 
    	return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	public function setUserMail($mail){
		if($this->isValidEmail($mail)){
			$this->userMail = $mail;
		}
	}

    /**
	 * SETTERS & GETTERS voir le pseudo de l'utilisateur
	 */
	public function getUserPseudo(){
		return $this->userPseudo;
	}
	public function setUserPseudo($pseudo){
		if(is_string($pseudo)){
			$this->userPseudo = $pseudo;
		}
	}
	
	/**
	 * SETTERS & GETTERS voir le mot de passe de l'utilisateur
	 */
	public function getUserPassword(){
		return $this->userPassword;
	}
	// vérification de l'encrypte du MDP
	public function isValidMd5($md5)
	{
	    return preg_match('/^[a-f0-9]{32}$/', $md5);
	}
	public function setUserPassword($password){
		if($this->isValidMd5($password)){
			$this->userPassword = $password;
		}
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
	 * SETTERS & GETTERS voir la photo profil d'un utilisateur
	 */
	public function getUserProfPic(){
		return $this->userProfPic;
	}
	/**
	 * voir l'emplacement de l'image temporaire
	 */
	public function getEmplacementImg(){
		return $this->userProfPicTmp;
	}
	public function setUserProfPic($profpic){
		if($profpic['name'] != ''){
			if($this->isValidImg($profpic['name'])){
				$this->userProfPic = uniqid().$profpic['name'];
				$this->userProfPicTmp = $profpic['tmp_name'];
			}
		}
	}
	
	/**
	 * Voir l'emsemble des utilisateurs NON ADMINS
	 */
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
	
	/**
	 * Voir un utilisateur NON ADMINS
	 */
	public function Seeoneuser(){
    	//var_dump($GLOBALS);
    	$userID = $_GET['id'];
    	try {
        	$select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "user A, " . PREFIX . "group B, " . PREFIX . "event C
                                            where user_id = '" . $userID . "'");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser = $select -> Fetch();
            
            var_dump($OneUser);
            return $OneUser;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
	
	/**
	 * Supprimer un utilisateur
	 */
	public function Deluser(){
    	//var_dump($GLOBALS);
    	$deluserID = $_GET['id'];
    	
    	try {
    	    // rajouer un trigger corbeille
        	$select = $this->connexion->prepare("DELETE
                                            FROM " . PREFIX . "user
                                            where user_id = '" . $deluserID . "'");
           
            //var_dump($select); exit();
            $select -> execute();
            
            //var_dump($AllUser);
            return true;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}

}

?>