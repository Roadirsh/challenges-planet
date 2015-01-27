<?php

/**
 * CoreController
 *
 * Fonctions prédéfinies et globales du controller
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

class CoreController{
	/**
	 * Variable gestionnaire de vue et chargement du model
	 * @var 	object $load 	page appelée
	 * @var 	object $model 	model demandé
	 */
	protected $load;
	protected $model;
	protected $logger;
	
	/**
	 * Constructor
	 */
	function __construct(){
		$this->load = new Load();
		include(LOGGER);

	 
	// Création d'un objet Logger
	$this->logger = new Logger('../logs/');

	if(isset($_GET['module']) && $_GET["action"] !='login' && isset($_SESSION['user'])){
		$this->logger->log('Include', 'loadapp', "" . $_SESSION['user'] . " Chargement du controleur " . $_GET['module'] . "Controller.php", Logger::GRAN_MONTH);
	}
	else
	{
		$this->logger->log('Include', 'loadapp', "Chargement du controleur LogController.php", Logger::GRAN_MONTH);

	}

	}
	

	/**
	 * Redirection & page 404
	 * @param String $module
	 * @param String $action
	 */
	protected function coreRedirect($module, $action){
		header('location:index.php?module='.$module.'&action='.$action);
		exit;
	}
	protected function corePage404(){
		$this->load->view("layout", "404");
	}


	/**
	 * Stock message dans la session
	 * @param String $coreMessage
	 */
	protected function coreDefinirMessage($coreMessage){
		$_SESSION["coreMessage"] = $coreMessage;
	}


	/**
	 * Retourne le message et la class du type du message 
	 */
	protected function coreEcrireMessage(){
		if(isset($_SESSION["coreMessage"])){
			include_once(ROOT . 'conf/messages.php');
			$coreMessage = $_SESSION["coreMessage"];
			if($coreMessage['typeMessage'] === 0){
				// nom class css alerte verte // TODO
				// <div class="alert alert-success" role="alert">...</div>
			}else{
				// nom class css jk rouge // TODO
				// <div class="alert alert-danger" role="alert">...</div>
			}
			unset($_SESSION["coreMessage"]);
			return $message;
		}
	}


	/**
	 * Controle l'accès selon un les droits d'accès. 
	 * @param String $level
	 * @param String $module
	 * @param String $action
	 */
	protected function coreRestrictLevel($level, $module, $action){
		// Si son niveau d'accès est élevé ex=SuperAdmin
		if (!isset($_SESSION[SITE_NAME."_LEVEL"])){
			$this->coreDefinirMessage(array(
										"texteMessage" => "LEVEL_REQUIRED",
										"typeMessage" => 1)
			);
			$this->coreRedirect($module, $action);
		} elseif ($_SESSION[SITE_NAME."_LEVEL"] < $level){
			$this->coreDefinirMessage(array(
										"texteMessage" => "LEVEL_LOW",
										"typeMessage" => 1)
			);
			$this->coreRedirect($module, $action);
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}