<?php
	
class CoreModel{
	protected $pdo;
	
	function __construct(){
		include_once '../app/conf/conf_mysql.php';
		try{
			$this->pdo = new PDO($dns, $PARAM_utilisateur, $PARAM_mot_passe, $options)
		} catch (Exception $e){
			$this->CoreBdError($e);
		}
	}
	// Message erreur pdo
	private function coreBdError($e){
		echo SITE_NAME." dit : Désolé, une erreur est survenue !";
		exit;
	}
	
	// Lecture table, retourne fetchAll
	protected function coreTableAll($table, $options = null){
		try{
			$query = "SELECT ";
			if(isset($options["columns"])){
				$query .= $options["columns"];
			} else {
				$query .= "*";
			}
			$query .= " FROM " .$table;
			if(isset($options["orderBy"])){
				$query .= " order by ".$options["orderBy"];	
			}
			if(isset($options["sort"])){
				$query .= " ".$options["sort"];	
			}
			if(isset($options["limit"]) && isset($options["offset"])){
				$query .= " limit ".$options["offset"].",".$options["limit"];	
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
	
	// Surpression d'un enregistrement par l'id
	public function coreDeleteById($table, $colonne, $valeur){
		try{
			$query = "delete from ".$table." where ".$colonne."=:id";
			
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