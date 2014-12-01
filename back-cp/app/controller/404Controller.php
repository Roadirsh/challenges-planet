<?

/**
 * Page404
 *
 * Affichage de la page 404
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

$index = new NotfoundController();
if(isset($_GET['action'])){
	//ucfirt = Met le premier caractère en majuscule
	$index-> ucfirst($_GET['action']) . '()';
} else {

	$index->Notfound();
}

class NotfoundController extends CoreController{


	/**
	 * Page 404
	 */
	function __construct(){
		parent::__construct();
	}

	public function Notfound(){
		// Définition des constante
		define("PAGE_TITLE", SITE_NAME . " 404 - not found");
		define("PAGE_DESCR", SITE_NAME . " "); // TODO
		define("PAGE_KW", SITE_NAME); // TODO
		define("PAGE_ID", "404");

		// Appel de la vue
		$this->load->view('layout', 'notfound');

	}

}