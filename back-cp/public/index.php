<?

/**
 * Controller principal 
 * 
 * @package      Framework_L&G
 * @copyright    L&G
 */



// Demmarage de la session
    session_start();

// Nommage de la session
    session_name('ChallengesPlanet');

// Fichier de configuration principal
    require_once('../app/conf/conf_define.php');

// Parametrage de l'UTF8 
    //header('Content-type: text/html; charset=UTF-8');

// Ensemble des urls en dur
    include(ROOT . "conf/conf_url.php");

// Librairie principale et globale du framework
    include("../lib/lib.php");

// Affichage des erreurs php
    error_reporting(E_ALL);
    
// Lancement de l'application !!!!!
    include_once(ROOT . 'app.php');
