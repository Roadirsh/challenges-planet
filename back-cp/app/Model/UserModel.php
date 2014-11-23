<?php 

/**
 * UserModel
 *
 * Requêtes relatifs au user
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */


class UserModel extends CoreModel{

	/**
	* Constructor
	**/
	function __construct($post){
		parent::__construct();

		// on instentie la fonction avec ses paramètres
		LoginUser($post);
	}


	/**
	* LoginUser
	* Requete vérifiant si le user existe, et si son mdp lui correspond
	*
	* @param array $_POST
	**/
	public function LoginUser($post){

		$login = $post['login'];
		$pwd = md5($post['login']);

		try {
			// on récupère toutes les informations d'un user s'il correspond au login et password
			$select = $connexion -> prepare("SELECT * 
											FROM user
											WHERE pseudo = '" . $login . "'
											AND password = '" . $pwd . "'");
					
			$select -> execute();

            // création des cookies
			if($co = $select -> fetch(PDO::FETCH_OBJ)){
				$_SESSION['connect_compte'] = true;
				$_SESSION['name'] = "$login";
				$_SESSION['Users'] = $row;
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
				return true;
				
			}
            
			$select -> closeCursor();
		}

		catch (Exception $e)
		{
			echo 'Message:' . $e -> getMessage();
		}
	}


	/**
	* LogoutUser
	**/
	public function LogoutUser(){

		// on unset la session
		session_unset();
		// on regirige sur une autre page
		$this->coreRedirect('page', 'home');
	}
	
}