<?

/**
 * Controller principal 
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */


// Fichier de configuration principal
    require_once('../app/conf/conf_define.php');

// Ensemble des urls en dur
    include(ROOT . "conf/conf_url.php");

// Librairie principale et globale du framework
    include("../lib/lib.php");

// Parametrage de l'UTF8 
    header('Content-type: text/html; charset=UTF-8');
    
/**
 * Include des librairies du Core
 */

// Affichage des pages
    include_once '../core/Load.php';
// Controller Globale
    include_once '../core/CoreController.php';
// Model Globale
    include_once '../core/CoreModel.php';
    

/**
 * Analyse du module demandé
 */
    if(isset($_GET['module'])){
        //ucfirt = Met le premier caractère en majuscule
        $module = ucfirst($_GET['module']);
    } else {
        $module = "Ajax";
    }


    $urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
    // echo $urlController;
    if(!file_exists($urlController)){
        $module = "404";

        $urlController = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'controller/' . $module . 'Controller.php';
        // echo $urlController;
    }
