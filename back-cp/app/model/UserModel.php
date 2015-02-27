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
    			if(method_exists($this, $action))
    			{
			    	$this->$action();
			    }
			    
			    
    		}
        }
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
	 * Vérification de l'existence d'une adresse d'un user
	*/
	public function adressUserExist($id, $type)
	{
		try {
			
            $select = $this->connexion->prepare("SELECT count(*) as exist
                                            FROM " . PREFIX . "adress WHERE user_user_id = :id and ad_type = :type");
            			
            $select->bindParam(':id', $id);
            $select->bindParam(':type', $type);
            $select->execute();
			$select->setFetchMode(PDO::FETCH_ASSOC);
			$select = $select -> FetchAll();
			
			if($select[0]['exist'] >= 1)
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
	 * Vérification de l'existence d'un numero de téléphone d'un user
	*/
	public function numeroUserExist($id)
	{
		try {
			
            $select = $this->connexion->prepare("SELECT count(*) as exist
                                            FROM " . PREFIX . "phone WHERE user_user_id = :id");
            			
            $select->bindParam(':id', $id);
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
				
				$this->connexion->beginTransaction();
				
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
				$this->connexion->commit();
				return false;
	        }
	
	        catch (Exception $e)
	        {
		        $this->connexion->rollBack();
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
	
	public function getExtension($fichier){
		$extension_upload = strtolower(  substr(  strrchr($fichier, '.') ,1)  );
		return $extension_upload;
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
		
		$newwidth=250;
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
                                            where user_type != 'admin' AND user_type != 'delete'");
           
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
                                            FROM " . PREFIX . "adress A  
                                            WHERE   A.user_user_id = " . $oneuserID . "");

            $select1 -> execute();
            $select1 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser1 = $select1 -> FetchAll();
            
            $select2 = $this->connexion->prepare("SELECT * FROM " . PREFIX . "phone B WHERE B.user_user_id = " . $oneuserID . "");
            $select2->execute();
            $select2 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser2 = $select2 -> FetchAll();
            
            
            
            
            
            
            
            
            
            
            
            
            if(!empty($OneUser1)){
                $userID = $_GET['id'];
                $select = $this->connexion->prepare("SELECT event_date, event_name, group_name
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
           
    	    }            
            
            
            
            
         
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            $array = "";
            $array['user'] = $OneUser;
            $array['info'] = $OneUser1;
            $array['phone'] = $OneUser2;    	
               
            if(!empty($Usercomplement)){
                    
                    $array['action'] = $Usercomplement;

                    
            }    
            
        	
                    
            return $array;
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
	
	
	/**
	 * Voir un utilisateur  ADMIN
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
                                            FROM " . PREFIX . "adress A  
                                            WHERE   A.user_user_id = " . $oneuserID . "");

            $select1 -> execute();
            $select1 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser1 = $select1 -> FetchAll();
            
            $select2 = $this->connexion->prepare("SELECT * FROM " . PREFIX . "phone B WHERE B.user_user_id = " . $oneuserID . "");
            $select2->execute();
            $select2 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser2 = $select2 -> FetchAll();
            
            $array = "";
            $array['user'] = $OneUser;
            $array['info'] = $OneUser1;
            $array['phone'] = $OneUser2;
            /*
echo '<pre>';
            var_dump($array);
            echo '</pre>';
            exit(0);
*/
            
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
			$this->connexion->beginTransaction();

			$requete = "UPDATE " . PREFIX . "user SET `user_lastname` = :lastname, `user_firstname` = :firstname, `user_mail` = :mail, `user_pseudo` = :pseudo,";
			
			if(isset($_POST['user_password']) && !empty($_POST['user_password']))
			{
			    $requete .= "`user_password` = :password,";
			}
			
    	    $requete .=" `user_profil_pic` = :profpic WHERE user_id = :id";
    	    
    	    $update = $this->connexion->prepare($requete); 

            $update->bindParam(':lastname', $_POST['user_lastname']);
            $update->bindParam(':firstname', $_POST['user_firstname']);
            $update->bindParam(':mail', $_POST['user_mail']);
            $update->bindParam(':pseudo', $_POST['user_pseudo']);
            $update->bindParam(':id', $userID);
			if(isset($_POST['user_password']) && !empty($_POST['user_password']))
			{
				$password =  md5($_POST['user_password']);
            	$update->bindParam(':password', $password);
            }
            if(isset($_FILES) && !empty($_FILES['user_img']['name']))
            {
	            
	            $profpic = uniqid().$_FILES['user_img']['name'];
	            $update->bindParam(':profpic', $profpic);
				$string= AVATAR . $profpic;
				$this->upload($_FILES['user_img']['tmp_name'], $string);
				$_SESSION['userPic'] = $profpic;
				
				

            }
            else
            {
	        	$update->bindParam(':profpic', $_POST['profpic']);

            }
            
			$update->execute();

			if($this->numeroUserExist($userID))
			{
				// UPDATE DANS LA TABLE PHONE
				
			$update1 = $this->connexion->prepare("UPDATE " . PREFIX . "phone
    	                                        SET phone_num = :phone
    	   	    	                            WHERE user_user_id = " . $userID); 

            $update1->bindParam(':phone', $_POST['phone_num']);
			$update1->execute();
			}
			else
			{
				$insert = $this->connexion->prepare("INSERT INTO `cp_phone` (`phone_id`, `phone_date`, `phone_num`, `user_user_id`) VALUES (NULL, CURRENT_TIMESTAMP, :phone, :id); ");
					
					$insert->bindParam(':phone', $_POST['phone_num']);
					$insert->bindParam(':id', $userID);
					
					$insert->execute();	            
			}

			if($this->adressUserExist($userID, 'Home'))
			{
				// UPDATE DANS LA TABLE ADRESS HOME
				
			$update2 = $this->connexion->prepare("UPDATE " . PREFIX . "adress
    	                                        SET
    	                                        `ad_num` = :num,
    	                                        `ad_street` = :street,
    	                                        `ad_zipcode` = :zipcode,
    	                                        `ad_city` = :city,
    	                                        `ad_country` = :country
    	                                        WHERE user_user_id = " . $userID . " and ad_type = 'Home'"); 

            $update2->bindParam(':num', $_POST['ad_numHome']);
            $update2->bindParam(':street', $_POST['ad_streetHome']);
            $update2->bindParam(':zipcode', $_POST['ad_zipcodeHome']);
            $update2->bindParam(':city', $_POST['ad_cityHome']);
            $update2->bindParam(':country', $_POST['ad_countryHome']);
            
			$update2->execute();
			}
			else
			{
				$insert = $this->connexion->prepare("INSERT INTO `cp_adress` (`adress_id`, `ad_date`, `ad_num`, `ad_street`, `ad_zipcode`, `ad_city`, `ad_country`, `ad_type`, `user_user_id`) VALUES (NULL, now(), :num, :street, :zipcode, :city, :country, 'Home', :user_id)");
	            
	            $insert2->bindParam(':num', $_POST['ad_numHome']);
	            $insert2->bindParam(':street', $_POST['ad_streetHome']);
	            $insert2->bindParam(':zipcode', $_POST['ad_zipcodeHome']);
	            $insert2->bindParam(':city', $_POST['ad_cityHome']);
	            $insert2->bindParam(':country', $_POST['ad_countryHome']);
	            $insert2->bindParam(':user_id', $userID);
	            
				$insert2->execute();
			}
			
			if($this->adressUserExist($userID, 'Invoice'))
			{
				// UPDATE DANS LA TABLE ADRESS HOME
				
			$update3 = $this->connexion->prepare("UPDATE " . PREFIX . "adress
    	                                        SET
    	                                        `ad_num` = :num,
    	                                        `ad_street` = :street,
    	                                        `ad_zipcode` = :zipcode,
    	                                        `ad_city` = :city,
    	                                        `ad_country` = :country
    	                                        WHERE user_user_id = " . $userID . " and ad_type = 'Invoice'"); 

            $update3->bindParam(':num', $_POST['ad_numInvoice']);
            $update3->bindParam(':street', $_POST['ad_streetInvoice']);
            $update3->bindParam(':zipcode', $_POST['ad_zipcodeInvoice']);
            $update3->bindParam(':city', $_POST['ad_cityInvoice']);
            $update3->bindParam(':country', $_POST['ad_countryInvoice']);
            
			$update3->execute();
			}
			else
			{
				$insert3 = $this->connexion->prepare("INSERT INTO `cp_adress` (`adress_id`, `ad_date`, `ad_num`, `ad_street`, `ad_zipcode`, `ad_city`, `ad_country`, `ad_type`, `user_user_id`) VALUES (NULL, now(), :num, :street, :zipcode, :city, :country, 'Invoice', :user_id)");
	            
	            $insert3->bindParam(':num', $_POST['ad_numInvoice']);
	            $insert3->bindParam(':street', $_POST['ad_streetInvoice']);
	            $insert3->bindParam(':zipcode', $_POST['ad_zipcodeInvoice']);
	            $insert3->bindParam(':city', $_POST['ad_cityInvoice']);
	            $insert3->bindParam(':country', $_POST['ad_countryInvoice']);
	            $insert3->bindParam(':user_id', $userID);
	            
				$insert3->execute();

			}
			$this->connexion->commit();

			return false;
	
        } catch (Exception $e) {
	        $this->connexion->rollBack();
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
                    $r .= "( user_lastname LIKE '%".addslashes($phrase)."%' ";
                    if($i < $nbArraySearch){
    	                $r .= "OR ";
                    }
                    $r .= "user_firstname LIKE '%".addslashes($phrase)."%' ";
					if($i < $nbArraySearch){
                        $r .= "OR ";
                    }
                    $r .= "user_mail LIKE '%".addslashes($phrase)."%' ";
                    if($i < $nbArraySearch){
                        $r .= "OR ";
                    }
                    $r .= "user_pseudo LIKE '%".addslashes($phrase)."%' ";
                    if($i < $nbArraySearch){
                        $r .= "OR ";
                    }
                    
	            }
				$r = substr($r, 0, -3);
				$r .= "  ) AND ";
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
			$query = "SELECT * FROM " . PREFIX . "user " . $ajout . " user_type != 'admin' AND user_type != 'delete' GROUP BY user_id";
		    $select = $this->connexion->prepare($query);
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
	    	$select  = $this->connexion->prepare("Select user_donut FROM " . PREFIX . "user where user_id = '" . $deluserID . "'" );
	    	$select->execute();
	    	$select -> setFetchMode(PDO::FETCH_ASSOC);
			$retour = $select -> fetch();
			
			$retour = $retour['user_donut'];
			
			if($retour == 0){
				
				$select  = $this->connexion->prepare("Select user_profil_pic FROM " . PREFIX . "user where user_id = '" . $deluserID . "'" );
	    	$select->execute();
	    	$select -> setFetchMode(PDO::FETCH_ASSOC);
			$retour = $select -> fetch();

			$retour = $retour['user_profil_pic'];
			$file = AVATAR . $retour;
			
			if(file_exists($file) && $file != AVATAR)
			{
	    		unlink($file);
			}
			
    	    // rajouer un trigger corbeille
        	$delete = $this->connexion->prepare("DELETE
                                            FROM " . PREFIX . "user
                                            where user_id = '" . $deluserID . "'");
           
            $delete -> execute();
				
			}
			else{
				$requete = "UPDATE " . PREFIX . "user SET `user_type` = 'delete' WHERE user_id = :id";
			
    	    
    	    $update = $this->connexion->prepare($requete);      
    	    $update->bindParam(':id' , $deluserID);       
			$update->execute();
			}
			
			
	    	
            

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
	
	
	/**
	 * Update un utilisateur
	 */
	public function Uponeuser(){
	    $userID = $_GET['id'];
	    


    	try {
    	    // UPDATE DANS LA TABLE USER 
			$this->connexion->beginTransaction();

			$requete = "UPDATE " . PREFIX . "user SET `user_lastname` = :lastname, `user_firstname` = :firstname, `user_mail` = :mail, `user_pseudo` = :pseudo,";
			
			if(isset($_POST['user_password']) && !empty($_POST['user_password']))
			{
			    $requete .= "`user_password` = :password,";
			}
			
    	    $requete .=" `user_profil_pic` = :profpic WHERE user_id = :id";
    	    
    	    $update = $this->connexion->prepare($requete); 

            $update->bindParam(':lastname', $_POST['user_lastname']);
            $update->bindParam(':firstname', $_POST['user_firstname']);
            $update->bindParam(':mail', $_POST['user_mail']);
            $update->bindParam(':pseudo', $_POST['user_pseudo']);
            $update->bindParam(':id', $userID);
			if(isset($_POST['user_password']) && !empty($_POST['user_password']))
			{
				$password = md5($_POST['user_password']);
            	$update->bindParam(':password', $password);
            }
            
            
            if(isset($_FILES) && !empty($_FILES['user_img']['name']))
            {
	            $select  = $this->connexion->prepare("Select user_profil_pic FROM " . PREFIX . "user where user_id = '" . $userID . "'" );
				$select->execute();
				$select -> setFetchMode(PDO::FETCH_ASSOC);
				$retour = $select -> fetch();

				$retour = $retour['user_profil_pic'];
				$file = AVATAR . $retour;
			
				if(file_exists($file) && $file != AVATAR)
				{
	    			unlink($file);
				}
	            $profpic = uniqid().$_FILES['user_img']['name'];
	            $update->bindParam(':profpic', $profpic);
				$string= AVATAR . $profpic;
				$this->upload($_FILES['user_img']['tmp_name'], $string);
				
				

            }
            else
            {
	        	$update->bindParam(':profpic', $_POST['profpic']);

            }
            
			$update->execute();

			if($this->numeroUserExist($userID))
			{
				// UPDATE DANS LA TABLE PHONE
				
			$update1 = $this->connexion->prepare("UPDATE " . PREFIX . "phone
    	                                        SET phone_num = :phone
    	   	    	                            WHERE user_user_id = " . $userID); 

            $update1->bindParam(':phone', $_POST['phone_num']);
			$update1->execute();
			}
			else
			{
				$insert = $this->connexion->prepare("INSERT INTO `cp_phone` (`phone_id`, `phone_date`, `phone_num`, `user_user_id`) VALUES (NULL, CURRENT_TIMESTAMP, :phone, :id); ");
					
					$insert->bindParam(':phone', $_POST['phone_num']);
					$insert->bindParam(':id', $userID);
					
					$insert->execute();	            
			}

			if($this->adressUserExist($userID, 'Home'))
			{
				// UPDATE DANS LA TABLE ADRESS HOME
				
			$update2 = $this->connexion->prepare("UPDATE " . PREFIX . "adress
    	                                        SET
    	                                        `ad_num` = :num,
    	                                        `ad_street` = :street,
    	                                        `ad_zipcode` = :zipcode,
    	                                        `ad_city` = :city,
    	                                        `ad_country` = :country
    	                                        WHERE user_user_id = " . $userID . " and ad_type = 'Home'"); 

            $update2->bindParam(':num', $_POST['ad_numHome']);
            $update2->bindParam(':street', $_POST['ad_streetHome']);
            $update2->bindParam(':zipcode', $_POST['ad_zipcodeHome']);
            $update2->bindParam(':city', $_POST['ad_cityHome']);
            $update2->bindParam(':country', $_POST['ad_countryHome']);
            
			$update2->execute();
			}
			else
			{
				$insert = $this->connexion->prepare("INSERT INTO `cp_adress` (`adress_id`, `ad_date`, `ad_num`, `ad_street`, `ad_zipcode`, `ad_city`, `ad_country`, `ad_type`, `user_user_id`) VALUES (NULL, now(), :num, :street, :zipcode, :city, :country, 'Home', :user_id)");
	            
	            $insert2->bindParam(':num', $_POST['ad_numHome']);
	            $insert2->bindParam(':street', $_POST['ad_streetHome']);
	            $insert2->bindParam(':zipcode', $_POST['ad_zipcodeHome']);
	            $insert2->bindParam(':city', $_POST['ad_cityHome']);
	            $insert2->bindParam(':country', $_POST['ad_countryHome']);
	            $insert2->bindParam(':user_id', $userID);
	            
				$insert2->execute();
			}
			
			if($this->adressUserExist($userID, 'Invoice'))
			{
				// UPDATE DANS LA TABLE ADRESS HOME
				
			$update3 = $this->connexion->prepare("UPDATE " . PREFIX . "adress
    	                                        SET
    	                                        `ad_num` = :num,
    	                                        `ad_street` = :street,
    	                                        `ad_zipcode` = :zipcode,
    	                                        `ad_city` = :city,
    	                                        `ad_country` = :country
    	                                        WHERE user_user_id = " . $userID . " and ad_type = 'Invoice'"); 

            $update3->bindParam(':num', $_POST['ad_numInvoice']);
            $update3->bindParam(':street', $_POST['ad_streetInvoice']);
            $update3->bindParam(':zipcode', $_POST['ad_zipcodeInvoice']);
            $update3->bindParam(':city', $_POST['ad_cityInvoice']);
            $update3->bindParam(':country', $_POST['ad_countryInvoice']);
            
			$update3->execute();
			}
			else
			{
				$insert3 = $this->connexion->prepare("INSERT INTO `cp_adress` (`adress_id`, `ad_date`, `ad_num`, `ad_street`, `ad_zipcode`, `ad_city`, `ad_country`, `ad_type`, `user_user_id`) VALUES (NULL, now(), :num, :street, :zipcode, :city, :country, 'Invoice', :user_id)");
	            
	            $insert3->bindParam(':num', $_POST['ad_numInvoice']);
	            $insert3->bindParam(':street', $_POST['ad_streetInvoice']);
	            $insert3->bindParam(':zipcode', $_POST['ad_zipcodeInvoice']);
	            $insert3->bindParam(':city', $_POST['ad_cityInvoice']);
	            $insert3->bindParam(':country', $_POST['ad_countryInvoice']);
	            $insert3->bindParam(':user_id', $userID);
	            
				$insert3->execute();

			}
			$this->connexion->commit();

			return $userID;
	
        } catch (Exception $e) {
	        $this->connexion->rollBack();
            echo 'Message:' . $e -> getMessage();
        }

	}





}

?>