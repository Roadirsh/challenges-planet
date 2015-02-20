<?php

/**
 * Polymorphius page
 * 
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

/**
 * Check wich module is called and call him
 *
 * @param array $_GET
 */


    if(isset($_GET['module'])){
		/* ucfirt = put the first letter in Uppercase */
		$module = ucfirst($_GET['module']);

	} else {
		$module = "Page";
	}

	$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
		// echo $urlController;

	if(!file_exists($urlController)){
		include_once('controller/NotfoundController.php');
		exit();

		$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
		// echo $urlController;
	}

	/* Start module */
		$controller = $module . 'Controller';

	/* Start controller called by the module */
		include_once('controller/' . $controller . '.php');

	/* Start model called by the module */
	$urlModel = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'model/' . $module . 'Model.php';


	if(file_exists($urlModel)){
        include_once('model/' . $module . 'Model.php');
	}

	$index = new $controller();