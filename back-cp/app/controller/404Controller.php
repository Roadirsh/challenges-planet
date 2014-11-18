<?

/**
* Page404
*
* Affichage de la page 404
*
* @package 		Framework_L&G
* @copyright 	L&G
**/

class 404Controller extends CoreController{

	/**
	* Page 404
	**/
	function __construct(){

		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " 404 - not found");
		define("PAGE_DESCR", SITE_NAME . " "); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "404");

		// Appel de la vue
		$this->Load->view('layout', '404');
	}

}