<?
/**
 * Controller principal 
 * 
 * @package      Framework_mobile_L&G
 * @copyright    L&G
 */



// Demmarage de la session
    session_start();
// Nommage de la session
    session_name('m.ChallengesPlanet');

// Fichier de configuration principal
    require_once('conf/conf_define.php');
// Fichier de configuration principal
    // require_once('conf/mysql.php');
// Affichage des pages
    include_once('../core/Load.php');
// Controller Globale
    include_once('../core/CoreController.php');
// Model Globale
    include_once('../core/CoreModel.php');
// Ensemble des urls en dur
    include('conf/conf_url.php');

