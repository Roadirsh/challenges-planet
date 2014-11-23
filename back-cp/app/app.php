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
	if(isset($_GET['module'])){
		//ucfirt = Met le premier caractère en majuscule
		$module = ucfirst($_GET['module']);
	} else {
		$module = "User";
	}	
	$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
	if(!file_exists($urlController)){
		$module = "User";
		$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
	}

	/**
	 * Include des librairies du Core
	 * @param String $module
	 */
	// Affichage des pages
		include_once '../core/Load.php';
	// Controller Globale
		include_once '../core/CoreController.php';


	// Lancement du module
		$controller = $module . 'Controller';

		new $controller();
	// Le controller appelé par la variable $module
		include_once('controller/' . $module . 'Controller.php');


		