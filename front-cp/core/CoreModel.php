<?php

/**
 * CoreModel
 *
 * Predefined and global query of a Model
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

class CoreModel{
	/**
	 * Variable manager of sight and loading of the model
	 * @var object $connexion
	 */
	protected $connexion;
	protected $logger;
	
	

	/**
	 * Constructor
	 */
	function __construct(){

		include_once(ROOT . 'conf/mysql.php');
		try {
			/* Let's try to connect ! */
			$this->connexion = new PDO($dns, $PARAM_utilisateur, $PARAM_mot_passe, $option);
		} catch (Exception $e){
			$this->CoreBdError($e);
		}
		include_once(LOGGER);
		
		/* Creat a LOGGER object */
		$this->logger = new Logger('../logs/');
		
		if(isset($_GET['module']) && isset($_SESSION['user'])){
			$this->logger->log('Include', 'loadapp', "" . $_SESSION['user'] . " Model loaded " . $_GET['module'] . "Model.php", Logger::GRAN_MONTH);
		} else{
			$this->logger->log('Include', 'loadapp', "loading of the LogModel.php", Logger::GRAN_MONTH);

		}
	}


	/**
	 * PDO ERROR MESSAGES
	 * 
	 * @param exception $e
	 */
	private function coreBdError($e){
		// echo SITE_NAME." : Désolé, une erreur est survenue !";
		// var_dump($e);
		include(ROOT . 'view/layout/notfound.php');
		exit;
	}
	

	/**
	 * Read tables, return fetchAll
	 * @param String $table 	name of the select table
	 * @param array $options 	option array
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
			if(isset($options["groupBy"])){
				$query .= " GROUP BY ".$options["groupBy"];	
			}
			if(isset($options["limit"]) && isset($options["offset"])){
				$query .= " LIMIT ".$options["offset"].",".$options["limit"];	
			}
			
			$curseur = $this->connexion->prepare($query);
			// var_dump($curseur); 
			$curseur->execute();
			$records = $curseur->fetchAll();
			$curseur->closeCursor();
			return $records;
			
		} catch (Exception $e){
			$this->coreBdError($e);
		}
	}
	

	/**
	 * Delete by ID
	 * @param String $table 	name of the select table
	 * @param String $colonne 	name of the column
	 * @param int $valeur 		value
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