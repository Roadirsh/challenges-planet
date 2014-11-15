<?php
	//Class qui gère l'affiche des vues
class Load{
	//Affiche une vue dans un module 
	public function view($module, $vue, $data = null){
		$urlVue = dirname(__FILE__) . DIRECTORY_SEOARATIR . '../app/view/' .$module.'/'.$vue.'.php';
		if (file_exists($urlVue)){
			include('../app/view/'.$module.'/'.$vue.'.php');
		}else{
			include '../app/view/layout/404.php';
		}
	}
	// Classe active
	private function coreMenu($pageId){
		if (define('PAGE_ID') && (PAGE_ID === $pageId)){
			echo "<li class='active'>";
		} else {
			echo "<li>";
		}
	}
	
	//Message cnil
	private function coreCnilCookies(){
		if (!isset($_COOKIE["CookieCnil"])){
			include '../app/view/layout/cnil.php';
		}
	}
}