<?php

/**
 * Load
 *
 * Manage the view 
 *
 * @package 		Framework_L&G
 * @copyright 	L&G
 */


class Load{


	/**
	 * Poster a sight in a module
	 * @param String $module 	controller repository
	 * @param String $vue 		file into the repo
	 * @param array $data 		more data
	 */
	public function view($module, $vue, $data = null){
		$urlVue = dirname(__FILE__) . DIRECTORY_SEPARATOR . ROOT . 'view/' . $module . '/' . $vue . '.php';

		if (file_exists($urlVue)){
			/* if you get the view file */
			include(ROOT . 'view/' . $module . '/' . $vue . '.php');
		}else{
			/* if not */
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
	 * CNIL message and cookies
	 */
	private function coreCnilCookies(){
		if (!isset($_COOKIE["CookieCnil"])){
			include(ROOT . 'view/layout/cnil.php');
		}
	}
}