<?php
	// Analyse module demandé
if(isset($_GET['module'])){
	$module = ucfirst($_GET['module']);
} else {
	$module = "Login";
}
$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR.'controller/'.$module.'Controller.php';
if(!file_exists($urlController)){
	$module = "Login";
	$urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR.'controller/'.$module.'Controller.php';
}

include_once '../core/Load.php';

include_once '../core/CoreController.php';

include_once 'controller/'.$module.'Controller.php';

// Lancement du module
$controller = $module.'Controller.php';
new $controller();