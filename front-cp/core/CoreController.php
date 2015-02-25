<?php
ob_start();
/**
 * CoreController
 *
 * Predefined and global query of a Controller
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */


class CoreController{
	/**
	 * Variable manager of sight and loading of the model
	 * @var 	object $load 	called page
	 * @var 	object $model 	asked model
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

	 
		/* Creat a LOGGER object */
		$this->logger = new Logger('../logs/');

		if(isset($_GET['module']) && $_GET["action"] !='login' && isset($_SESSION['user'])){
			$this->logger->log('Include', 'loadapp', "" . $_SESSION['user'] . " Controller loaded " . $_GET['module'] . "Controller.php", Logger::GRAN_MONTH);
		}
		else
		{
			$this->logger->log('Include', 'loadapp', "loding of the LogController.php", Logger::GRAN_MONTH);

		}

	}
	

	/**
	 * Redirection & 404 page
	 * @param String $module
	 * @param String $action
	 */
	protected function coreRedirect($module, $action){
		header('location:index.php?module='.$module.'&action='.$action);
		exit;
	}
	protected function corePage404(){
		$this->load->view("notfount", "notfound");
	}


	/**
	 * Stock message inda session
	 * @param String $coreMessage
	 */
	protected function coreDefinirMessage($coreMessage){
		$_SESSION["coreMessage"] = $coreMessage;
	}


	/**
	 * Return message
	 */
	protected function coreEcrireMessage(){
		if(isset($_SESSION["coreMessage"])){
			include_once(ROOT . 'conf/messages.php');
			$coreMessage = $_SESSION["coreMessage"];
            $message = '';
			if($coreMessage['typeMessage'] === 0){
                $message = '';

            }else{
                $message = '';
			}
			unset($_SESSION["coreMessage"]);
			return $message;
		}
	}


	/**
	 * Control level access
	 * @param String $level
	 * @param String $module
	 * @param String $action
	 */
	protected function coreRestrictLevel($level, $module, $action){
		// If HIGH LEVEL ex: Superadmin
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