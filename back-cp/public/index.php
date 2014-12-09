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
echo 'lala';
// Fichier de configuration principal
    require_once('../app/conf/conf_define.php');
    echo 'lala';


// Parametrage de l'UTF8 
    header('Content-type: text/html; charset=UTF-8');

// Ensemble des urls en dur
    include(ROOT . "conf/conf_url.php");
echo 'lala';
// Librairie principale et globale du framework
    include("../lib/lib.php");

// Affichage des erreurs php
<<<<<<< HEAD
    // error_reporting(E_ALL);
=======
    error_reporting(E_ALL);
<<<<<<< HEAD
    
    
>>>>>>> 2e3aff766ecc7de4ddc8f4c374fa7c57259c46cf
=======
 
    include_once(ROOT . 'model/UserModel.php');
>>>>>>> logger



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
    
    include_once '../lib/Logger.class.php';


	 
	// Création d'un objet Logger
	$logger = new Logger('../ogs/');
	
	$logger->log('test', 'loadapp', "Chargement de l'application index.php", Logger::GRAN_MONTH);

// Lancement de l'application !!!!!
    //include_once(ROOT . 'app.php');
