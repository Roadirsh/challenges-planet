<?php

/**
 * Page Polymorphe
 * 
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

	/**
	 * Analyse du module demandé
	 *
	 * @param array $_GET
	 */
	    // session_destroy();
    	// $_POST = '';
    	// var_dump($_SESSION);
    	
	if(!empty($_SESSION['user'])){

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
		include_once('controller/NotfoundController.php');
		exit();

		$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
		// echo $urlController;
	}

	// Lancement du module
		$controller = $module . 'Controller';

	// Le controller appelé par la variable $module

		include_once('controller/' . $controller . '.php');

		//include_once('controller/' . $module . 'Controller.php');


    
	// Le model appelé par la variable $module
	$urlModel = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'model/' . $module . 'Model.php';
	// echo $urlController;

	if(file_exists($urlModel)){
        include_once('model/' . $module . 'Model.php');
	}
		

	$index = new $controller();
