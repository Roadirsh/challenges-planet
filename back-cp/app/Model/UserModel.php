<?php 

/**
 * UserModel
 *
 * Requêtes relatifs au user
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */


//$logger->log('test', 'loadapp', "Chargement du modele user", Logger::GRAN_MONTH);

class UserModel extends CoreModel{

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
                $this->$action();
            }
			

		} else {

			$this->ShowUser();
		}

	}


	/**
	 * LoginUser
	 * Requete vérifiant si le user existe, et si son mdp lui correspond
	 *
	 * @param array $_POST
	 */
	//echo 'lolo';
	public function ShowUser(){
        
        $login = $_SESSION['user'];
        $userID = $_SESSION['userID'];

		try {
			// on récupère toutes les informations d'un user s'il correspond au login et password
			$select = $this->connexion->prepare("SELECT * 
											FROM " . PREFIX . "user
											WHERE pseudo = '" . $login . "'
											AND user_id = '" . $userID . "'");
					
		 	//var_dump($select); 
			$select -> execute();
			$select -> setFetchMode(PDO::FETCH_ASSOC);
			$retour = $select -> fetchAll();

			// $select -> closeCursor();
			// echo count($retour); exit();
			return $retour;
		}

		catch (Exception $e)
		{
			echo 'Message:' . $e -> getMessage();
		}
	}

}

?>