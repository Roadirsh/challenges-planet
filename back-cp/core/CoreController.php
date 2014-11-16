<?php
	
class CoreController{
	// Variable gestionnaire de vue et chargement du model
	protected $load;
	protected $model;
	
	function __construct(){
		$this->load = new Load();
	}
	
	protected function coreRedirect($module, $action){
		header('location:?module='.$module.'&amp;action='.$action);
		exit;
	}
	protected function corePage404(){
		$this->load->view("layout", "404");
	}
	//Stock message dans la session
	protected function coreDefinirMessage($coreMessage){
		$_SESSION["coreMessage"] = $coreMessage;
		
	}
	// Retourne le message et la class du type du message 
	protected function coreEcrireMessage(){
		if(isset($_SESSION["coreMessage"])){
			include_once '../app/config/messages.php';
			$coreMessage = $_SESSION["coreMessage"];
			if($coreMessage['typeMessage'] === 0){
				// nom class css alerte verte
			}else{
				// nom class css alerte rouge
			}
			unset($_SESSION["coreMessage"]);
			return $message;
		}
	}
	//Controle l'accès selon un niveau
	protected function coreRestrictLevel($level, $module, $action){
		if (!isset($_SESSION[SITE_NAME."_LEVEL"])){
			$this->coreDefinirMessage(array(
										"texteMessage" => "LEVEL_REQUIRED",
										"typeMessage" => 1));
			)
			$this->coreRedirect($module, $action);
		} elseif ($_SESSION[SITE_NAME."_LEVEL"] < $level){
			$this->coreDefinirMessage(array(
										"texteMessage" => "LEVEL_LOW",
										"typeMessage" => 1));
			)
			$this->coreRedirect($module, $action);
		}
	}
}