<?php 

/**
 * CartModel
 *
 * Everything who is relative to the cart
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

/**
 * CHECK IF IS IN STOCK
 * GET USERS INFO
 * CHECK IF USER EXIST
 * CHECK IF EMAIL EXIST
 * INSERT USER
 * INSERT DONATION
 */

class CartModel extends CoreModel{
	
	private $userMail;
	private $userPassword;
	private $userSite;
	private $phoneNum;
	private $cardNumber; 
	private $crypto;
	private $expiration;

	
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
	}

/////////////////////////////////////////////////////
/* GET LIST * * * * * * * * * * * * * * * * * * * */

    /**
     * Linked to : 
     * controller/CartController.php
     * view/cart/*.php
     * 
     * Get all users information
     *
     * @param ID 
     */
    public function getInfoUser($userID) {

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
                                            WHERE A.user_user_id = " . $oneuserID . " 
                                            AND ad_type = 'invoice'");

            $select1 -> execute();
            $select1 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser1 = $select1 -> FetchAll();
            
            $select2 = $this->connexion->prepare("SELECT * 
                                                FROM " . PREFIX . "phone B 
                                                WHERE B.user_user_id = " . $oneuserID . "");
            $select2->execute();
            $select2 -> setFetchMode(PDO::FETCH_ASSOC);
            $OneUser2 = $select2 -> FetchAll();

            $array = "";
            $array['user'] = $OneUser;
            $array['info'] = $OneUser1;
            $array['phone'] = $OneUser2;          

            return $array;
            
        } catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    }
	
    /**
     * Linked to : 
     * controller/CartController.php
     * view/cart/*.php
     * `public function upload($index, $destination) `
     * 
     * Get the ext file
     *
     * @param String PSEUDO 
     */
    public function getExtension($fichier) {
        $extension_upload = strtolower(  substr(  strrchr($fichier, '.') ,1)  );
        return $extension_upload;
    }

/////////////////////////////////////////////////////
/* CHECK LIST * * * * * * * * * * * * * * * * * * */

    /**
     * Linked to : 
     * controller/CartController.php
     * view/cart/*.php
     * 
     * Check if the project still exists
     *
     * @param ID 
     */
    public function isStock($id){
        
        try {
            $select = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "group
                                                WHERE group_id = " . $id);
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $isStock = $select -> FetchAll();

            return $isStock;
            
            
        } catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    }

    /**
     * Linked to : 
     * controller/CartController.php
     * view/cart/*.php
     * 
     * Check that the user doesn't exists to not make dubble
     *
     * @param String PSEUDO 
     */
    public function user_exist($pseudo) {
        try {
            
            $select = $this->connexion->prepare("SELECT count(*) as exist
                                                FROM " . PREFIX . "user 
                                                WHERE user_pseudo = :pseudo");
                        
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
     * Linked to : 
     * controller/CartController.php
     * view/cart/*.php
     * 
     * Check that the email doesn't exists to not make dubble
     *
     * @param String PSEUDO 
     */
    public function email_exist($mail) {
        try {
            
            $select = $this->connexion->prepare("SELECT count(*) as exist
                                                FROM " . PREFIX . "user 
                                                WHERE user_mail = :mail");
                        
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
     * Linked to : 
     * controller/CartController.php
     * view/cart/*.php
     * 
     * Check that the phone doesn't exists to not make dubble
     *
     * @param String PSEUDO 
     */
    public function numeroUserExist($id) {
        try {
            
            $select = $this->connexion->prepare("SELECT count(*) as exist
                                                FROM " . PREFIX . "phone 
                                                WHERE user_user_id = :id");
                        
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
     * Linked to : 
     * controller/CartController.php
     * view/cart/*.php
     * 
     * Check that the adress doesn't exists to not make dubble
     *
     * @param String PSEUDO 
     */
    public function adressUserExist($id, $type) {
        try {
            
            $select = $this->connexion->prepare("SELECT count(*) as exist
                                                FROM " . PREFIX . "adress 
                                                WHERE user_user_id = :id 
                                                AND ad_type = :type");
                        
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
    
    //Getter/setter
    /**
	 * SETTERS & GETTERS le mail de l'utilisateur
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
	 * SETTERS & GETTERS voir cardNumber
	 */
	public function getCardNumber(){
		return $this->cardNumber;
	}
	
	public function setCardNumber($number){
		if(preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $number)){
			$this->cardNumber = $number;
		}
	}
	/**
	 * SETTERS & GETTERS voir crypto
	 */
	public function getCrypto(){
		return $this->crypto;
	}
	
	public function setCrypto($number){
		if(preg_match('/^\d{3}$/', $number)){
			$this->crypto = $number;
		}
	}
	/**
	 * SETTERS & GETTERS voir expiration
	 */
	public function getExpirationDate(){
		return $this->expiration;
	}
	
	public function setExpirationDate($string){
		if(preg_match('/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/', $string)){
			$this->expiration = $string;
		}
	}
	/**
	 * SETTERS & GETTERS site de l'utilisateur
	 */
	public function getUserSite(){
		return $this->userSite;
	}
	// vérification de la validité du mail
	public function isValidSite($site){ 
    	return filter_var($site, FILTER_VALIDATE_URL);
	}
	public function setUserSite($site){
		if($this->isValidSite($site)){
			$this->userSite = $site;
		}
	}
	
	public function getUserPhone()
	{
		return $this->phoneNum;
	}
	public function setUserPhone($phone){
	
		if(preg_match("/^\+(?:[0-9]?){6,14}[0-9]$/", $phone))
		{
			$this->phoneNum = $phone;
		}
	}
    
/////////////////////////////////////////////////////
/* ADD  * * * * * * * * * * * * * * * * * * * * * * */

	/**
     * Linked to : 
     * controller/CartController.php
     * view/cart/*.php
     * 
     * Add a user if not exists
     *
     * @param ID 
     */
	public function insertNewUser() {
		$user_exist = $this->user_exist($_POST['user_pseudo']);
		$email_exist = $this->email_exist($_POST['user_mail']);
		$password = md5($_POST['user_password']);
		$this->setUserPassword($password);
		$this->setUserMail($_POST['user_mail']);
		$this->setUserSite($_POST['user_site']);
		$this->setUserPhone($_POST['phone_number']);
		
		$password = $this->getUserPassword();
		$mail = $this->getUserMail();
		$site = $this->getUserSite();
		$phone = $this->getUserPhone();
		
		
		if($user_exist || $email_exist || is_null($password) || is_null($mail) || is_null($site) || is_null($phone))
		{
			return true;
		}
		else
		{
			try {
				
				$this->connexion->beginTransaction();
				
	            $insert = $this->connexion->prepare("INSERT INTO " . PREFIX . "user
                                                    (`user_id`, `user_date`, `user_lastname`, `user_firstname`, `user_mail`, `user_pseudo`, `user_password`, `user_profil_pic`, `user_type`, `user_site`) 
                                                    VALUES 
                                                    (NULL, now(), :lastname, :firstname, :mail, :pseudo, :password, :profpic, 'organisme', :site)");
	            
				
	            $insert->bindParam(':lastname', $_POST['user_lastname']);
	            $insert->bindParam(':firstname', $_POST['user_firstname']);
	            $insert->bindParam(':mail', $mail);
	            $insert->bindParam(':pseudo', $_POST['user_pseudo']);
		        $insert->bindParam(':password', $password);
	            $profpic = uniqid().$_FILES['user_pic']['name'];
	            $insert->bindParam(':profpic', $profpic);
				$insert->bindParam(':site', $site);
	            
				$insert->execute();
				
				if(!empty($profpic)){
					$string= '../../front-cp/public/img/avatar/'.$profpic;
					$this->upload($_FILES['user_pic']['tmp_name'], $string);
				}

				$id = $this->connexion->lastInsertId();
				
				
				// Insert invoice adress
				$insert = $this->connexion->prepare("INSERT INTO `" . PREFIX . "adress` 
                                                    (`adress_id`, `ad_date`, `ad_num`, `ad_street`, `ad_zipcode`, `ad_city`, `ad_country`, `ad_type`, `user_user_id`) 
                                                    VALUES 
                                                    (NULL, now(), :num, :street, :zipcode, :city, :country, 'invoice', :user_id)");
	            
				
				
	            $insert->bindParam(':num', $_POST['invoice_ad_num']);
	            $insert->bindParam(':street', $_POST['invoice_ad_street']);
	            $insert->bindParam(':zipcode', $_POST['invoice_ad_zipcode']);
	            $insert->bindParam(':city', $_POST['invoice_ad_city']);
	            $insert->bindParam(':country', $_POST['invoice_ad_country']);
	            $insert->bindParam(':user_id', $id);
	            
				$insert->execute();

				$insert = $this->connexion->prepare("INSERT INTO `" . PREFIX . "phone` 
                                                    (`phone_id`, `phone_date`, `phone_num`, `user_user_id`) 
                                                    VALUES 
                                                    (NULL, CURRENT_TIMESTAMP, :phone, :id); ");
					
				$insert->bindParam(':phone', $phone);
				$insert->bindParam(':id', $id);
					
				$insert->execute();
				
				$this->connexion->commit();
				$_SESSION['connect_compte_FRONT'] = true;
				$_SESSION[PREFIX . 'user'] = $_POST['user_lastname'];
				$_SESSION[PREFIX . 'userPseudo'] = $_POST['user_pseudo'];
				$_SESSION[PREFIX . 'userID'] = $id;
				$_SESSION[PREFIX . 'spyID'] = rand();
				
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
     * Linked to : 
     * controller/CartController.php
     * view/cart/*.php
     * 
     * Move the file from 'public function getEmplacementTmp()' to good on server
     *
     * @param String PSEUDO 
     */
    public function upload($index, $destination) {
		
		$extension = $this->getExtension($destination);

		//MOVE
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
     * Linked to : 
     * controller/CartController.php
     * view/cart/*.php
     * 
     * Update a user informations
     *
     * @param String PSEUDO 
     */
	public function Uponeuser(){
	    $userID = $_SESSION[PREFIX .'userID'];
	    


    	try {
		    	
			$this->setUserMail($_POST['user_mail']);
			$this->setUserSite($_POST['user_site']);
			$this->setUserPhone($_POST['phone_number']);
			
			$mail = $this->getUserMail();
			$site = $this->getUserSite();
			$phone = $this->getUserPhone();
			
			
			if( is_null($mail) || is_null($site) || is_null($phone))
			{
				return true;
			}
			else
			{
	    	    // UPDATE IN USER 
				$this->connexion->beginTransaction();
	
				$requete = "UPDATE " . PREFIX . "user 
	                        SET `user_lastname` = :lastname, 
	                        `user_firstname` = :firstname, 
	                        `user_mail` = :mail, 
	                        `user_pseudo` = :pseudo, 
	                        `user_profil_pic` = :profpic, 
	                        `user_site` = :site 
	                        WHERE user_id = :id";
	    	    
	    	    $update = $this->connexion->prepare($requete); 
	
	            $update->bindParam(':lastname', $_POST['user_lastname']);
	            $update->bindParam(':firstname', $_POST['user_firstname']);
	            $update->bindParam(':mail', $_POST['user_mail']);
	            $update->bindParam(':pseudo', $_POST['user_pseudo']);
	            $update->bindParam(':id', $userID);
				$update->bindParam(':site', $_POST['user_site']);
			            
	            
	            if(isset($_FILES) && !empty($_FILES['user_pic']['name']))
	            {
		            $select  = $this->connexion->prepare("SELECT user_profil_pic 
	                                                    FROM " . PREFIX . "user 
	                                                    WHERE user_id = '" . $userID . "'" );
					$select->execute();
					$select -> setFetchMode(PDO::FETCH_ASSOC);
					$retour = $select -> fetch();
	
					$retour = $retour['user_profil_pic'];
					$file = AVATAR . $retour;
				
					if(file_exists($file) && $file != AVATAR)
					{
		    			unlink($file);
					}
		            $profpic = uniqid().$_FILES['user_pic']['name'];
		            $update->bindParam(':profpic', $profpic);
					$string= AVATAR . $profpic;
					$this->upload($_FILES['user_pic']['tmp_name'], $string);
					
					
	
	            }
	            else
	            {
		        	$update->bindParam(':profpic', $_POST['hidden_user_pic']);
	
	            }
	            
				$update->execute();
	
				if($this->numeroUserExist($userID))
				{
					// UPDATE IN PHONE
					
				$update1 = $this->connexion->prepare("UPDATE " . PREFIX . "phone
	    	                                        SET phone_num = :phone
	    	   	    	                            WHERE user_user_id = " . $userID); 
	
	            $update1->bindParam(':phone', $_POST['phone_number']);
				$update1->execute();
				}
				else
				{
					$insert = $this->connexion->prepare("INSERT INTO `" . PREFIX . "phone` 
	                                                    (`phone_id`, `phone_date`, `phone_num`, `user_user_id`) 
	                                                    VALUES 
	                                                    (NULL, CURRENT_TIMESTAMP, :phone, :id); ");
						
						$insert->bindParam(':phone', $_POST['phone_number']);
						$insert->bindParam(':id', $userID);
						
						$insert->execute();	            
				}
				
				if($this->adressUserExist($userID, 'Invoice'))
				{
					// UPDATE IN ADRESS
					
				$update3 = $this->connexion->prepare("UPDATE " . PREFIX . "adress
	    	                                        SET
	    	                                        `ad_num` = :num,
	    	                                        `ad_street` = :street,
	    	                                        `ad_zipcode` = :zipcode,
	    	                                        `ad_city` = :city,
	    	                                        `ad_country` = :country
	    	                                        WHERE user_user_id = " . $userID . " and ad_type = 'Invoice'"); 
	
	            $update3->bindParam(':num', $_POST['invoice_ad_num']);
	            $update3->bindParam(':street', $_POST['invoice_ad_street']);
	            $update3->bindParam(':zipcode', $_POST['invoice_ad_zipcode']);
	            $update3->bindParam(':city', $_POST['invoice_ad_city']);
	            $update3->bindParam(':country', $_POST['invoice_ad_country']);
	            
				$update3->execute();
				}
				else
				{
					$insert3 = $this->connexion->prepare("INSERT INTO `" . PREFIX . "adress` 
	                                                    (`adress_id`, `ad_date`, `ad_num`, `ad_street`, `ad_zipcode`, `ad_city`, `ad_country`, `ad_type`, `user_user_id`) 
	                                                    VALUES 
	                                                    (NULL, now(), :num, :street, :zipcode, :city, :country, 'Invoice', :user_id)");
		            
		            $insert3->bindParam(':num', $_POST['invoice_ad_num']);
		            $insert3->bindParam(':street', $_POST['invoice_ad_street']);
		            $insert3->bindParam(':zipcode', $_POST['invoice_ad_zipcode']);
		            $insert3->bindParam(':city', $_POST['invoice_ad_city']);
		            $insert3->bindParam(':country', $_POST['invoice_ad_country']);
		            $insert3->bindParam(':user_id', $userID);
		            
					$insert3->execute();
	
				}
				$this->connexion->commit();
	
				return false;
				}
	
        } catch (Exception $e) {
	        $this->connexion->rollBack();
            echo 'Message:' . $e -> getMessage();
        }
        

	}
	
    /**
     * Linked to : 
     * controller/CartController.php
     * view/cart/*.php
     * 
     * Insert the donation into the DB
     *
     * @param String PSEUDO 
     */
	public function donate(){
		try{
			$this->setCardNumber($_POST['num_card']);
			$this->setCrypto($_POST['crypto_card']);
			$this->setExpirationDate($_POST['expiration_card']);
			
			$num = $this->getCardNumber();
			$crypto = $this->getCrypto();
			$expiration = $this->getExpirationDate();
			
			
			if( is_null($num) || is_null($crypto) || is_null($expiration))
			{
				return false;
			}
			else
			{
			
				$userID = $_SESSION[PREFIX . 'userID'];
				$this->connexion->beginTransaction();
				
				$insert = $this->connexion->prepare("INSERT INTO `" . PREFIX . "bank_details` 
	                                                (`num_card`, `name_card`, `crypto_card`, `expiration_card`, `user_user_id`) 
	                                                VALUES 
	                                                (:num, :name, :crypto, :expiration, :user_id)");
		            
		        $insert->bindParam(':num', $num);
		        $insert->bindParam(':name', $_POST['name_card']);
		        $insert->bindParam(':crypto', $crypto);
		        $insert->bindParam(':expiration', $expiration);
		        $insert->bindParam(':user_id', $userID);
		            
				$insert->execute();
				
				$insert2 = $this->connexion->prepare("INSERT INTO `" . PREFIX . "donate` 
	                                                (`donate_date`, `donate_amount`, `donate_tva`, `group_group_id`, `cp_user_user_id`) 
	                                                VALUES 
	                                                (now(), :amount, 20, :group_id, :user_id)");
		            
		        $insert2->bindParam(':amount', $_SESSION['donation_amount']);
		        $insert2->bindParam(':group_id', $_SESSION['donation_team_id']);
		        $insert2->bindParam(':user_id', $userID);
		        
		        $insert2->execute();
		        
		        $update = $this->connexion->prepare("UPDATE " . PREFIX . "user
	    	                                        SET user_donut = user_donut + 1
	                                                WHERE user_id = " . $userID); 
	
				$update->execute();
		        
				$this->connexion->commit();
				return true;
			}

		}
		catch (Exception $e){
			$this->connexion->rollBack();
			
			echo 'Message:' . $e -> getMessage();
			return false;
		}
	}

	public function sendMail(){
		require_once '../../front-cp/vendor/swiftmailer/swiftmailer/lib/swift_required.php';

		// Create the Transport
		$transport = Swift_SmtpTransport::newInstance('ssl://smtp.gmail.com', 465)
		  ->setUsername('challengesplanet@gmail.com') 
		  ->setPassword('EEMI2014')
		  ;
				// Create the Mailer using your created Transport
		$mailer = Swift_Mailer::newInstance($transport);
		$body = "Thank you for sponsorize a team dear mister " . $_SESSION['cp_userPseudo'] . ". You give " . $_SESSION['donation_amount'] . " euros to " . $_SESSION['donation_team'] . " Hopefully they will be able to participe to " . $_SESSION['donation_event'] . ". See you soon !";
		
		// Create a message
		$message = Swift_Message::newInstance('Wonderful Subject')
		  ->setFrom(array('john@doe.com' => 'John Doe'))
		  ->setTo(array('roadirsh@gmail.com', $_SESSION['cp_userMail']))
		  ->setBody($body)
		  ;
		
		// Send the message
		$result = $mailer->send($message);
	}
}