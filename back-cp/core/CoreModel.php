<?php

/**
 * CoreModel
 *
 * Requetes prédéfinies et globales du model
 *
 * @package 		Framework_L&G
 * @copyright 	L&G
 */



class CoreModel{
	/**
	 * Variable gestionnaire de vue et chargement du model
	 * @var 	object $connexion
	 */
	protected $connexion;
	protected $logger;
	
	

	/**
	 * Constructor
	 */
	function __construct(){

		include_once(ROOT . 'conf/mysql.php');
		try {
			// on tente une connexion
			//$this->pdo = new PDO($dns, $PARAM_utilisateur, $PARAM_mot_passe, $options);
			$this->connexion = new PDO($dns, $PARAM_utilisateur, $PARAM_mot_passe, $option);
			
		} catch (Exception $e){
			// on renvoi au message d'erreur de la connexion
			$this->CoreBdError($e);
		}
		include_once(LOGGER);
		
		

	 
	// Création d'un objet Logger
	$this->logger = new Logger('../logs/');
	
	if(isset($_GET['module']) && isset($_SESSION['user'])){
		$this->logger->log('Include', 'loadapp', "" . $_SESSION['user'] . " Chargement du modèle " . $_GET['module'] . "Model.php", Logger::GRAN_MONTH);
	}
	else
	{
		$this->logger->log('Include', 'loadapp', "Chargement du modèle LogModel.php", Logger::GRAN_MONTH);

	}
	}


	/**
	 * Message erreur pdo
	 * @param exception $e
	 */
	private function coreBdError($e){
		echo SITE_NAME." : Désolé, une erreur est survenue !";
		var_dump($e);
		exit;
	}
	

	/**
	 * Lecture table, retourne fetchAll
	 * @param String $table 		nom de la table du select
	 * @param array $options 	tableau des options
	 */
	protected function coreTableAll($table, $options = null){
		try{
			$query = "SELECT ";
			if(isset($options["columns"])){
				$query .= $options["columns"];
			} else {
				$query .= "*";
			}
			$query .= " FROM " . PREFIX .$table;
			if(isset($options["orderBy"])){
				$query .= " ORDER BY ".$options["orderBy"];	
			}
			if(isset($options["sort"])){
				$query .= " ".$options["sort"];	
			}
			if(isset($options["limit"]) && isset($options["offset"])){
				$query .= " LIMIT ".$options["offset"].",".$options["limit"];	
			}
			
			$curseur = $this->pdo->prepare($query);
			$curseur->execute();
			$records = $curseur->fetchAll();
			$curseur->closeCursor();
			return $records;
			
		} catch (Exception $e){
			$this->coreBdError($e);
		}
	}
	

	/**
	 * Surpression d'un enregistrement par l'id
	 * @param String $table 		nom de la table du select
	 * @param String $colonne 	nom de la colonne à tester
	 * @param int $valeur 		valeur à tester
	 */
	public function coreDeleteById($table, $colonne, $valeur){
		try{
			$query = "DELETE FROM ".$table." WHERE ".$colonne."=:id";
			
			$curseur = $this->pdo->prepare($query);
			$curseur->bindValue(':id', $valeur, PDO::PARAM_INT);
			$retour = $curseur->execute();
			$curseur->closeCursor();
			return $retour;

		} catch (Exception $e){
			$this->coreBdError($e);
		}
	}
	
}