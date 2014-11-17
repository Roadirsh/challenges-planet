<?php

/**
* Page Polymorphe
* 
* @package 		Framework Challenges Planete L&G
* @copyright 	L&G
**/


	/**
	* Analyse du module demandé
	**/
	if(isset($_GET['module'])){
		//ucfirt = Met le premier caractère en majuscule
		$module = ucfirst($_GET['module']);
	} else {
		$module = "Login";
	}	
	$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
	if(!file_exists($urlController)){
		$module = "Login";
		$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
	}

	/**
	* Include des librairies du Core
	* @param String $module
	**/
	// Affichage des pages
		include_once '../core/Load.php';
	// Controller Globale
		include_once '../core/CoreController.php';


	// Le controller appelé par la variable $module
		include_once 'controller/' . $module . 'Controller.php';
	// Lancement du module
		$controller = $module.'Controller.php';
		new $controller();

		