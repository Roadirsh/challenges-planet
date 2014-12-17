<?php

/**
 * Page Polymorphe
 * 
 * @package 	Framework_L&G
 * @copyright 	L&G
 */


	//$logger->log('test', 'loadapp', "Chargement de l'application app.php", Logger::GRAN_MONTH);
	/**
	 * Analyse du module demandé
	 */
	// session_destroy();
	//$_POST = '';
	//var_dump($_SESSION);

	if(isset($_SESSION['user']) != ''){

		if(isset($_GET['module'])){
			//ucfirt = Met le premier caractère en majuscule
			$module = ucfirst($_GET['module']);

		} else {
			$module = "Page";
		}
	} else {
		$module = "Log";
	}

	$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
	// echo $urlController;

	if(!file_exists($urlController)){
		include_once('controller/404Controller.php');
		exit();

		$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
		// echo $urlController;
	}

	// Lancement du module
		$controller = $module . 'Controller';

	// Le controller appelé par la variable $module

		include_once('controller/' . $controller . '.php');

		include_once('controller/' . $module . 'Controller.php');


	// Le model appelé par la variable $module

        include_once('model/' . $module . 'Model.php');
		

	

	$index = new $controller();