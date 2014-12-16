<?php

/**
 * Load
 *
 * Gère l'affichage des vues
 *
 * @package 		Framework_L&G
 * @copyright 	L&G
 */

$logger->log('test', 'loadapp', "Chargement du core Load", Logger::GRAN_MONTH);

class Load{


	/**
	 * Affiche une vue dans un module 
	 * @param String $module 	dossier du controller
	 * @param String $vue 		fichier dans le dossier
	 * @param array $data 		données facultatives
	 */
	public function view($module, $vue, $data = null){

		$urlVue = dirname(__FILE__) . DIRECTORY_SEPARATOR . ROOT . 'view/' . $module . '/' . $vue . '.php';

		if (file_exists($urlVue)){
			// si on trouve la vue
			// var_dump($data);
			include(ROOT . 'view/' . $module . '/' . $vue . '.php');
		}else{
			// si on ne trouve pas la vue
			include(ROOT . 'view/layout/404.php');
		}
	}

	/**
	 * Class .active
	 * @param String $pageId 	page ayant l'id sur le body
	 */
	private function coreMenu($pageId){
		if (define('PAGE_ID') && (PAGE_ID === $pageId)){
			echo "<li class='active'>";
		} else {
			echo "<li>";
		}
	}
	
	/**
	 * Message CNIL cookies
	 */
	private function coreCnilCookies(){
		if (!isset($_COOKIE["CookieCnil"])){
			include(ROOT . 'view/layout/cnil.php');
		}
	}
}