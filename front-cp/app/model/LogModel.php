<?php 

/**
 * LogModel
 *
 * All manipulations relative to the action of login log out sign up
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * LOGIN
 * LOGOUT
 * SIGN UP
 */
 
class LogModel extends CoreModel{

    /**
	 * Constructor
	 */
	function __construct(){
		parent::__construct($_POST);
	}

/////////////////////////////////////////////////////
/* HOME * * * * * * * * * * * * * * * * * * * * * * */

	/**
	 * Linked to : 
     * controller/LogController.php
     * view/home.php => lightbox
     * 
	 * Check if is user || user exist
	 *
	 * @param array $_POST
	 */
	public function Login($post){

		try {
			/* * * * * * * * * * * * * * * * * * * * * * * *
            * Get all informations of a user
            * IF user mail and user password are ok
            */
			$select = $this->connexion->prepare("SELECT * 
											FROM " . PREFIX . "user
											WHERE user_mail = '" . $post['email'] . "'
											AND user_password = '" . md5($post['pwd']) . "'");

			$select->execute();
			$select->setFetchMode(PDO::FETCH_ASSOC);
			$retour = $select->fetchAll();
			
			/* * * * * * * * * * * * * * * * * * * * * * * *
            * Let'smake some cookies !
            */
			if(count($retour) != 0){
                /* * * * * * * * * * * * * * * * * * * * * * * *
                * Make a USER _ SESSION array
                */
				$_SESSION['connect_compte_FRONT'] = true;
				$_SESSION[PREFIX . 'user'] = $retour[0]['user_lastname'];
				$_SESSION[PREFIX . 'userPseudo'] = $retour[0]['user_pseudo'];
				$_SESSION[PREFIX . 'userID'] = $retour[0]['user_id'];
				$_SESSION[PREFIX . 'spyID'] = rand();

				if (isset($post['reco'])){
					if(!setcookie("Login",$login,time()+3600*24*31))
					{
						die("cookie ne peut etre enregistré !");
					}
					if(!setcookie("Passwords",$pwd,time()+3600*24*31))
					{
						die("cookie ne peut etre enregistré !");
					}
				}
			} 

			return count($retour);
		}

		catch (Exception $e)
		{
			echo 'Message:' . $e->getMessage();
		}
	}

/////////////////////////////////////////////////////
/* SIGN UP * * * * * * * * * * * * * * * * * * * * */

	/**
     * Linked to : 
     * controller/LogController.php
     * view/signup.php
     * 
     * Insert into the database
     *
     * @param array $_POST
     */
	public function Signup($post){

		$mail = $post['email'];
		$pwd = md5($post['pwd']);
		

		try {
			/* * * * * * * * * * * * * * * * * * * * * * * *
            * Get count to verify none existence
            */
			$check = $this->connexion->prepare("SELECT * 
    											FROM " . PREFIX . "user
    											WHERE user_mail = '" . $post['email'] . "'
                                                AND user_password = '" . md5($post['pwd']) . "'");
            
            $check->execute();
			$check->setFetchMode(PDO::FETCH_ASSOC);
			$user_check = $check->rowCount();


    		if($user_check == 0){
                /* * * * * * * * * * * * * * * * * * * * * * * *
                * Insert into the database in two wawes
                */
        	    $insert = $this->connexion->prepare("INSERT INTO " . PREFIX . "user
			                                    (`user_mail`, `user_password`) 
			                                    VALUES ('" . $post['email'] . "', '" . md5($post['pwd']) . "')");

                $wellInsert = $insert->execute();
                
                $userID = $this->connexion->lastInsertId(); 
                
                /* * * * * * * * * * * * * * * * * * * * * * * *
                * Put into the SESSION
                */
                if($wellInsert == 1){
                    $_SESSION['connect_compte'] = true;
                    $_SESSION['user'] = '';
                    $_SESSION['userPseudo'] = '';
                    $_SESSION['userMail'] = $mail;
                    $_SESSION['userID'] = $userID;
				    $_SESSION['spyID'] = rand();
                }
                
                
    			return $wellInsert;
                
    		} else{
    		    return $user_check;							
			}
		}

		catch (Exception $e)
		{
			echo 'Message:' . $e->getMessage();
		}
	}
		
}

?>