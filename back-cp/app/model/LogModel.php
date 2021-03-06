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
class LogModel extends CoreModel{
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct($_POST);

		if(isset($_GET['action'])){
			//ucfirt = Met le premier caractère en majuscule
			// echo ucfirst($_GET['action']);
			$action = ucfirst($_GET['action']);

            if(ucfirst($_GET['action']) == 'Login'){
                $this->$action($_POST);
            } else{
                if(file_exists($action)){
                   $this->$action(); 
                } else{
                    $this->Login($_POST);
                }
                
            }

		} else {
			$this->Login($_POST);
		}

	}


	/**
	 * LoginUser
	 * Requete vérifiant si le user existe, et si son mdp lui correspond
	 *
	 * @param array $_POST
	 */
        //echo 'lolo';
	public function Login($post){

		$login = $post['login'];
		$pwd = md5($post['pwd']);
		//var_dump($post);

		try {
			// on récupère toutes les informations d'un user s'il correspond au login et password
			$select = $this->connexion->prepare("SELECT * 
											FROM " . PREFIX . "user
											WHERE user_pseudo = '" . $login . "'
											AND user_password = '" . $pwd . "'");
					
		 	//var_dump($select); 
			$select -> execute();
			$select -> setFetchMode(PDO::FETCH_ASSOC);
			$retour = $select -> fetchAll();
			
            // création des cookies
			if(count($retour) != 0){
				$_SESSION['connect_compte_BACK'] = true;
				$_SESSION['user'] = $retour[0]['user_lastname'];
				$_SESSION['userF'] = $retour[0]['user_firstname'];
				$_SESSION['userID'] = $retour[0]['user_id'];
				$_SESSION['userPic'] = $retour[0]['user_profil_pic'];
				$_SESSION['userDate'] = $retour[0]['user_date'];
				$_SESSION['userPseudo'] = $retour[0]['user_pseudo'];
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

}

?>