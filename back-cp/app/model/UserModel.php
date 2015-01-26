<?php 
		$logger->log('Include', 'loadapp', "Chargement du modèle UserModel.php", Logger::GRAN_MONTH);

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

	
	private $userPhone;

	private $nomRueHome;
	private $numRueHome;
	private $zipcodeHome;
	private $cityHome;
	private $countryHome;
	private $nomRueInvoice;
	private $numRueInvoice;
	private $zipcodeInvoice;
	private $cityInvoice;
	private $countryInvoice;
	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
		
        if(isset($_POST) && !empty($_POST)){
            
            $post = $_POST;
            if(isset($post['type'])){   
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

        		//adresse
        		$this->setUserNumRue($post['numRueHome'], $post["numRueInvoice"]);
        		$this->setUserNomRue($post['nomRueHome'], $post['nomRueInvoice']);
        		$this->setUserZipcode($post["zipcodeHome"], $post["zipcodeInvoice"]);
        		$this->setUserCity($post['cityHome'], $post['cityInvoice']);
        		$this->setUserCountry($post["countryHome"], $post['countryInvoice']);
        		if(isset($post["phoneNumber"]) && !empty($post["phoneNumber"]))
        		{
        			$this->setUserPhone($post["phoneNumber"]);
        		}
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
	   /*
		if (!isset($_FILES["profil"]) OR $_FILES["profil"]['error'] > 0){
				    return FALSE;
				}
		*/
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
	 * Vérification d'un email, pour éviter les doublons
	 */
	public function email_exist($mail)
	{
		try {
			
            $select = $this->connexion->prepare("SELECT count(*) as exist
                                            FROM " . PREFIX . "user WHERE user_mail = :mail");
            			
            $select->bindParam(':mail', $mail);
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

		$streetHome = $this->getNomRueHome();
		$numHome = $this->getNumRueHome();
		$zipcodeHome = $this->getZipcodeHome();
		$cityHome = $this->getCityHome();
		$countryHome = $this->getCountryHome();
		$streetInvoice = $this->getNomRueInvoice();
		$numInvoice = $this->getNumRueInvoice();
		$zipcodeInvoice = $this->getZipcodeInvoice();
		$cityInvoice = $this->getCityInvoice();
		$countryInvoice = $this->getCountryInvoice();
		$phone = $this->getUserPhone();
		$user_exist = $this->user_exist($pseudo);
		$email_exist = $this->email_exist($mail);
		

		
		if($user_exist || $email_exist )
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
					$string= '../../front-cp/public/img/avatar/'.$profpic;
					$this->upload($tmp, $string);
				}

				$id = $this->connexion->lastInsertId();
				// Insert home adress
				$insert = $this->connexion->prepare("INSERT INTO `giraudsa`.`cp_adress` (`adress_id`, `ad_date`, `ad_num`, `ad_street`, `ad_zipcode`, `ad_city`, `ad_country`, `ad_type`, `user_user_id`) VALUES (NULL, now(), :num, :street, :zipcode, :city, :country, 'home', :user_id)");
	            
				
				
	            $insert->bindParam(':num', $numHome);
	            $insert->bindParam(':street', $streetHome);
	            $insert->bindParam(':zipcode', $zipcodeHome);
	            $insert->bindParam(':city', $cityHome);
	            $insert->bindParam(':country', $countryHome);
	            $insert->bindParam(':user_id', $id);
	            
				$insert->execute();
				
				// Insert invoice adress
				$insert = $this->connexion->prepare("INSERT INTO `giraudsa`.`cp_adress` (`adress_id`, `ad_date`, `ad_num`, `ad_street`, `ad_zipcode`, `ad_city`, `ad_country`, `ad_type`, `user_user_id`) VALUES (NULL, now(), :num, :street, :zipcode, :city, :country, 'invoice', :user_id)");
	            
				
				
	            $insert->bindParam(':num', $numInvoice);
	            $insert->bindParam(':street', $streetInvoice);
	            $insert->bindParam(':zipcode', $zipcodeInvoice);
	            $insert->bindParam(':city', $cityInvoice);
	            $insert->bindParam(':country', $countryInvoice);
	            $insert->bindParam(':user_id', $id);
	            
				$insert->execute();

				if($phone != null)
				{
					$insert = $this->connexion->prepare("INSERT INTO `giraudsa`.`cp_phone` (`phone_id`, `phone_date`, `phone_num`, `user_user_id`) VALUES (NULL, CURRENT_TIMESTAMP, :phone, :id); ");
					
					$insert->bindParam(':phone', $phone);
					$insert->bindParam(':id', $id);
					
					$insert->execute();
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
		if($birthday > "1900-01-01" && $birthday < date('Y-m-d', strtotime('-13 years')))
		{
			$this->userBirthday = $birthday;
		}
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
                                            FROM " . PREFIX . "user
                                            WHERE  user_id = " . $userID . "");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser = $select -> FetchAll();

            $oneuserID = $OneUser[0]['user_id'];
            $select1 = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "adress A, " . PREFIX . "phone B  
                                            WHERE  A.user_user_id = " . $oneuserID . "
                                            AND B.user_user_id = " . $oneuserID . "");
           
            $select1 -> execute();
            $select1 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser1 = $select1 -> FetchAll();

            
    	    if(!empty($OneUser)){
                $userID = $_GET['id'];
                $select = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "user A, " . PREFIX . "group B, " . PREFIX . "user_has_group C, " . PREFIX . "event_has_group D, " . PREFIX . "event E, " . PREFIX . "event_has_user F
                                                WHERE A.user_id = " . $userID . "
                                                AND A.user_id = C.user_user_id 
                                                AND C.group_group_id = B.group_id 
                                                AND B.group_id = D.group_group_id 
                                                AND D.event_event_id = E.event_id
                                                AND A.user_id = F.user_user_id
                                                GROUP BY E.event_id");
                 
                $select -> execute();
                $select -> setFetchMode(PDO::FETCH_ASSOC);
                $Usercomplement = $select -> FetchAll();
                
                //var_dump($OneUser);
                //var_dump($Usercomplement);
                if(!empty($Usercomplement)){
                    $array = "";
                    $array['user'] = $OneUser;
                    $array['plususer'] = $OneUser1;
                    $array['action'] = $Usercomplement;
                    
                    return $array;
                    
                } else{
                    $array = "";
                    $array['user'] = $OneUser;
                    $array['plususer'] = $OneUser1;
                    
                    return $array;
                }
    	    }
    	    
        	//var_dump($OneUser);
            $array = "";
                    $array['user'] = $OneUser;
                    $array['plususer'] = $OneUser1;
                    
                    return $array;
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
	
	
	/**
	 * Voir un utilisateur NON ADMINS
	 */
	public function Seeoneadmin(){
    	//var_dump($GLOBALS);
    	$userID = $_SESSION['userID'];
    	try {
    	    
    	    $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "user
                                            WHERE  user_id = " . $userID . "");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser = $select -> FetchAll();

            $oneuserID = $OneUser[0]['user_id'];
            
            $select1 = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "adress A, " . PREFIX . "phone B  
                                            WHERE  A.user_user_id = " . $oneuserID . "
                                            AND B.user_user_id = " . $oneuserID . "");

            $select1 -> execute();
            $select1 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser1 = $select1 -> FetchAll();
            
            $array = "";
            $array['user'] = $OneUser;
            $array['info'] = $OneUser1;
            
            return $array;
            
        } catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
       
       
    /**
	 * Update un utilisateur admin
	 */
	public function Uponeadmin(){
	    $userID = $_SESSION['userID'];
	    
	    
    	try {
    	    // UPDATE DANS LA TABLE USER 
    	   
			$requete = "UPDATE " . PREFIX . "user SET `user_lastname` = :lastname, `user_firstname` = :firstname, `user_mail` = :mail, `user_pseudo` = :pseudo,";
			
			if(isset($_POST['user_password']) && !empty($_POST['user_password']))
			{
			    $requete .= "`user_password` = :password,";
			}
			
    	    $requete .="`user_profil_pic` = :profpic WHERE user_id = :id";
    	    
    	    $update = $this->connexion->prepare($requete); 

            $update->bindParam(':lastname', $_POST['user_lastname']);
            $update->bindParam(':firstname', $_POST['user_firstname']);
            $update->bindParam(':mail', $_POST['user_mail']);
            $update->bindParam(':pseudo', $_POST['user_pseudo']);
            $update->bindParam(':id', $userID);
			if(isset($_POST['user_password']) && !empty($_POST['user_password']))
			{
            	$update->bindParam(':password', md5($_POST['user_password']));
            }
            if(isset($_FILES))
            {
	            $profpic = uniqid().$_FILES['user_img']['name'];
	            $update->bindParam(':profpic', $profpic);
				$string= '../../front-cp/public/img/avatar/'.$profpic;
				$this->upload($_FILES['user_img']['tmp_name'], $string);
				

            }
            else
            {
	        	$update->bindParam(':profpic', $_POST['profpic']);

            }
            
			$update->execute();
			
			// UPDATE DANS LA TABLE ADRESS
			$update1 = $this->connexion->prepare("UPDATE " . PREFIX . "adress
    	                                        SET
    	                                        `ad_num` = :num,
    	                                        `ad_street` = :street,
    	                                        `ad_zipcode` = :zipcode,
    	                                        `ad_city` = :city,
    	                                        `ad_country` = :country
    	                                        WHERE user_user_id = " . $userID); 

            $update1->bindParam(':num', $_POST['ad_num']);
            $update1->bindParam(':street', $_POST['ad_street']);
            $update1->bindParam(':zipcode', $_POST['ad_zipcode']);
            $update1->bindParam(':city', $_POST['ad_city']);
            $update1->bindParam(':country', $_POST['ad_country']);
            
			$update1->execute();
			
            // UPDATE DANS LA TABLE PHONE
			$update2 = $this->connexion->prepare("UPDATE " . PREFIX . "phone 
    	                                        SET
    	                                        `phone_num` = :num
    	                                        WHERE user_user_id = " . $userID); 

            $update2->bindParam(':num', $_POST['phone_num']);
            
			$update2->execute();
			
			return false;
				
				
				
        } catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }

	}
	
	/**
	 * Search User
	 *
	 * @param array $_POST
	 */
	public function SearchUser($post){
	
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
                        // USER TABLE BDD
                        $r .= "user_lastname LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "user_firstname LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "user_mail LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "user_pseudo LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "user_type LIKE '%".addslashes($e)."%' ";
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
    		                                " . PREFIX . "user
		                                WHERE " . $ajout . "
		                                GROUP BY user_id");
        //var_dump($select);
		$select -> execute();
		$select -> setFetchMode(PDO::FETCH_ASSOC);
		$retour = $select -> fetchAll();
		
		return $retour;
    }
    
	/**
	 * Supprimer un utilisateur
	 */
	public function Deluser(){
    	//var_dump($GLOBALS);
    	$deluserID = $_GET['id'];
    	
    	try {
	    	$select  = $this->connexion->prepare("Select user_profil_pic FROM " . PREFIX . "user where user_id = '" . $deluserID . "'" );
	    	$select->execute();
	    	$select -> setFetchMode(PDO::FETCH_ASSOC);
			$retour = $select -> fetch();

			$retour = $retour['user_profil_pic'];
			$file = '../../front-cp/public/img/avatar/'.$retour;
			
			if(file_exists($file) && $file != '../../front-cp/public/img/avatar/')
			{
	    		unlink($file);
			}
			
    	    // rajouer un trigger corbeille
        	$delete = $this->connexion->prepare("DELETE
                                            FROM " . PREFIX . "user
                                            where user_id = '" . $deluserID . "'");
           
            $delete -> execute();
            

            //var_dump($AllUser);
            return true;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}

	
	
	
	
	
	
		
	/**
	 * SETTERS & GETTERS voir le num de la rue d'un utilisateur
	 */
	public function getnumRueHome()
	{
		return $this->numRueHome;
	}
	public function getnumRueInvoice()
	{
		return $this->numRueInvoice;
	}
	public function setUserNumRue($numRueHome, $numRueInvoice)
	{
		if(is_string($numRueHome) && is_string($numRueInvoice))
		{
			$this->numRueHome = $numRueHome;
			$this->numRueInvoice = $numRueInvoice;
		}
	}
	
	
	/**
	 * SETTERS & GETTERS voir le nom de la rue d'un utilisateur
	 */
	public function getNomRueHome()
	{
		return $this->nomRueHome;
	}
	public function getNomRueInvoice()
	{
		return $this->nomRueInvoice;
	}
	public function setUserNomRue($nomRueHome, $nomRueInvoice)
	{
		if(is_string($nomRueHome) && is_string($nomRueInvoice))
		{
			$this->nomRueHome = $nomRueHome;
			$this->nomRueInvoice = $nomRueInvoice;
		}
	}
		
	/**
	 * SETTERS & GETTERS voir code postal d'un utilisateur
	 */
	public function getZipcodeHome()
	{
		return $this->zipcodeHome;
	}
	public function getZipcodeInvoice()
	{
		return $this->zipcodeInvoice;
	}
	public function setUserZipcode($zipcodeHome, $zipcodeInvoice)
	{
		if(is_string($zipcodeHome) && strlen($zipcodeHome) <= 9 && strlen($zipcodeHome) >= 1 && is_string($zipcodeInvoice) && strlen($zipcodeInvoice) <= 9 && strlen($zipcodeInvoice) >= 1)
		{
			$this->zipcodeHome = $zipcodeHome;
			$this->zipcodeInvoice = $zipcodeInvoice;
		}
	}
	
	/**
	 * SETTERS & GETTERS voir la ville d'un utilisateur
	 */
	public function getCityHome()
	{
		return $this->cityHome;
	}
	public function getCityInvoice()
	{
		return $this->cityInvoice;
	}
	public function setUserCity($cityHome, $cityInvoice)
	{
		if(is_string($cityHome) && is_string($cityInvoice))
		{
			$this->cityHome = $cityHome;
			$this->cityInvoice = $cityInvoice;
		}
	}
	
	/**
	 * SETTERS & GETTERS voir le pays d'un utilisateur
	 */
	public function getCountryHome()
	{
		return $this->countryHome;
	}
	public function getCountryInvoice()
	{
		return $this->countryInvoice;
	}
	public function setUserCountry($countryHome, $countryInvoice)
	{
		$arrayCountry = getPays();
		$arrayCountry = array_map('strtolower', $arrayCountry);
		$countryHome = strtolower($countryHome);
		$countryInvoice = strtolower($countryInvoice);
		if(in_array($countryHome, $arrayCountry) && in_array($countryInvoice, $arrayCountry))
		{
			$this->countryHome = $countryHome;
			$this->countryInvoice = $countryInvoice;
		}
	}
	public function getUserPhone()
	{
		return $this->userPhone;
	}
	public function setUserPhone($phone){
	
		if(preg_match("/^\+(?:[0-9]?){6,14}[0-9]$/", $phone))
		{
			$this->userPhone = $phone;
		}
	}
	
	
	




}

?>