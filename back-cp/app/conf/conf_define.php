<? 

/**
* Configuration des DEFINE
*
* @package 		Framework_L&G
* @copyright 	L&G
**/

// Vers le dossier app global
	define("ROOT", '../app/');
// Vers le Model principal
	define("MODEL", '../core/Model/');
// Index.php
	define("INDEX", 'index.php?');
// Nom du site web
	define("SITE_NAME", 'Challenges Planet');
// PREFIXE des tables de la BDD
	define("PREFIX", 'cp_');
// URL de la racine du serveur
	define('BASE_DIR', "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["SCRIPT_NAME"]));