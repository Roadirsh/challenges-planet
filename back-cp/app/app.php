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
	// session_destroy();
	// var_dump($_SESSION);

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
	// echo $urlController;

	if(!file_exists($urlController)){
		$module = "404";

		$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
		// echo $urlController;
	}

	// Le controller appelé par la variable $module
		include_once(ROOT . 'controller/' . $module . 'Controller.php');

	// Le model appelé par la variable $module
		include_once(ROOT . 'model/' . $module . 'Model.php');

		
	// Lancement du module
		$controller = $module . 'Controller';
		$index = new $controller();

	


