<?php

/**
 * Page Polymorphe
 * 
 * @package 	Framework_L&G
 * @copyright 	L&G
 */


	 $logger->log('test', 'loadapp', "Chargement de l'application app.php", Logger::GRAN_MONTH);
	/**
	 * Analyse du module demandé
	 */
	// session_destroy();
	//$_POST = '';
	var_dump($_SESSION);

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

	// Lancement du module
		$controller = $module . 'Controller';

	// Le controller appelé par la variable $module
<<<<<<< HEAD
		include_once(ROOT . 'controller/' . $controller . '.php');
=======
		include_once(ROOT . 'controller/' . $module . 'Controller.php');

>>>>>>> 2e3aff766ecc7de4ddc8f4c374fa7c57259c46cf
	// Le model appelé par la variable $module
		include_once(ROOT . 'model/' . $module . 'Model.php');

	
<<<<<<< HEAD
	$index = new $controller();
	
=======

>>>>>>> 2e3aff766ecc7de4ddc8f4c374fa7c57259c46cf

