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
	}


	/**
	* LoginUser
	* Requete vérifiant si le user existe, et si son mdp lui correspond
	*
	* @param array $_POST
	**/
	public function LoginUser($post){

		$login = $post['login'];
		$pwd = md5($post['pwd']);


		try {
			// on récupère toutes les informations d'un user s'il correspond au login et password
			$select = $this->connexion->prepare("SELECT * 
											FROM " . PREFIX . "user
											WHERE pseudo = '" . $login . "'
											AND password = '" . $pwd . "'");
					
			// var_dump($select);

			$select -> execute();
			$select -> setFetchMode(PDO::FETCH_ASSOC);
			$retour = $select -> fetchAll();

            // création des cookies
			if(count($retour) != 0){
				$_SESSION['connect_compte'] = true;
				$_SESSION['user'] = $login;
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

			$select -> closeCursor();

			return count($retour);

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