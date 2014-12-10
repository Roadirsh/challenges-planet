<?
//phpinfo();
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

    include_once '../lib/Logger.class.php';
     global $logger;
     $logger = new Logger('../logs/');
     

// Fichier de configuration principal
    require_once('../app/conf/conf_define.php');
    


// Parametrage de l'UTF8 
    header('Content-type: text/html; charset=UTF-8');

// Ensemble des urls en dur
    include(ROOT . "conf/conf_url.php");

// Librairie principale et globale du framework
    include("../lib/lib.php");

// Affichage des erreurs php
    //error_reporting(E_ALL);
   // ini_set("error_reporting", "E_ALL");
   // ini_set('display_errors', 1);




/**
 * Include des librairies du Core
 * @param String $module
 */

// Affichage des pages
    include_once '../core/Load.php';
// Controller Globale
    include_once '../core/CoreController.php';
// Model Globale
    include_once '../core/CoreModel.php';
    
    


	 
	// Création d'un objet Logger
		
	//$logger->log('test', 'loadapp', "Chargement de l'application index.php", Logger::GRAN_MONTH);

// Lancement de l'application !!!!!
    include_once(ROOT . 'app.php');
