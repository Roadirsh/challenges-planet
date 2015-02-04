<?php 

/**
 * LogModel
 *
 * Requêtes relatifs a la conenxion
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

/**
 * choix de l'action
 * instanciation de la class
 */
 
//$logger->log('test', 'loadapp', "Chargement du modele user", Logger::GRAN_MONTH);

class LogModel extends CoreModel{

	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct($_POST);

	}


	/**
	 * LoginUser
	 * Requete vérifiant si le user existe, et si son mdp lui correspond
	 *
	 * @param array $_POST
	 */
	//echo 'lolo';
	public function Login($post){

		$mail = $post['email'];
		$pwd = md5($post['pwd']);
		//var_dump($post);

		try {
			// on récupère toutes les informations d'un user s'il correspond au login et password
			$select = $this->connexion->prepare("SELECT * 
											FROM " . PREFIX . "user
											WHERE user_mail = '" . $mail . "'
											AND user_password = '" . $pwd . "'");
					
		 	//var_dump($select); 
			$select -> execute();
			$select -> setFetchMode(PDO::FETCH_ASSOC);
			$retour = $select -> fetchAll();
			
			//var_dump($retour); exit();
            // création des cookies
			if(count($retour) != 0){
				$_SESSION['connect_compte'] = true;
				$_SESSION['user'] = $retour[0]['user_lastname'];
				$_SESSION['userPseudo'] = $retour[0]['user_pseudo'];
				$_SESSION['userID'] = $retour[0]['user_id'];
				$_SESSION['spyID'] = rand();
				// $_SESSION['level'] = ''; // TO DO // TYPE D'ADMIN

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

			// $select -> closeCursor();
			// echo count($retour); exit();
			return count($retour);
		}

		catch (Exception $e)
		{
			echo 'Message:' . $e -> getMessage();
		}
	}
	
	/**
	 * LoginUser
	 * Requete vérifiant si le user existe, et si son mdp lui correspond
	 *
	 * @param array $_POST
	 */
	//echo 'lolo';
	public function Signup($var){
        //var_dump($var); exit();
		$mail = $var['email'];
		$pwd = md5($var['pwd']);
		

		try {
			// on récupère toutes les informations d'un user s'il correspond au login et password
			$check = $this->connexion->prepare("SELECT * 
    											FROM " . PREFIX . "user
    											WHERE user_mail = '" . $mail . "'
    											AND user_password = '" . $pwd . "'");
            
            $check -> execute();
			$check -> setFetchMode(PDO::FETCH_ASSOC);
			$user_check = $check -> rowCount();

            // echo $user_check; exit();	
            					
    		if($user_check == 0){
        	    $insert = $this->connexion->prepare("INSERT INTO " . PREFIX . "user
			                                    (`user_mail`, `user_password`) 
			                                    VALUES (:mail, :password)");
					
    		 	//var_dump($select); 
    		 	$insert->bindParam(':mail', $mail);
    		 	$insert->bindParam(':password', $pwd);
                //echo $insert -> execute(); exit();
                
                $wellInsert = $insert -> execute();
                
                $userID = $this->connexion->lastInsertId(); 
                
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
			echo 'Message:' . $e -> getMessage();
		}
	}

		
		
}

?>