<?php

/**
 * Page Polymorphe
 * 
 * @package 	Framework_L&G
 * @copyright 	L&G
 */


	/**
	 * Analyse du module demandé
	 */
	if(isset($_SESSION['user']) != ''){
		if(isset($_GET['module'])){
			//ucfirt = Met le premier caractère en majuscule
			$module = ucfirst($_GET['module']);
		} else {
			$module = "Page";
		}
	} else {
		$module = "User";
	}

	$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
	//echo $urlController;
	if(!file_exists($urlController)){
		$module = "404";

		$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
		// echo $urlController;
	}
	/**
	 * Include des librairies du Core
	 * @param String $module
	 */
	// Affichage des pages
		include_once '../core/Load.php';
	// Controller Globale
		include_once '../core/CoreController.php';
	// Model Globale
		include_once '../core/CoreModel.php';
	
	// Le controller appelé par la variable $module
		require_once('controller/' . $module . 'Controller.php');
	// Le cmodel appelé par la variable $module
		include_once('model/' . $module . 'Model.php');
	// Lancement du module
		$controller = $module . 'Controller';
		
		$index = new UserController();

		$index->Login();
		