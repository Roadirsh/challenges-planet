<?php

/**
 * Configuration des DEFINE
 *
 * @package     Framework_L&amp;G
 * @copyright 	L&amp;G
 */


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
// URL de dev
    define("DEV", 'ns366377.ovh.net');
// MODULE
    define("MODULE", 'index.php?module=');
// ACTION
    define("ACTION", '&amp;action=');
// ACTION
    define("ID", '&amp;id=');
// URL de la racine du serveur
	define('BASE_DIR', "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["SCRIPT_NAME"]));
// lien vers le dossier avatar img
	define("AVATAR", '../../front-cp/public/img/avatar/');
// lien vers le dossier event img
	define("EVENT", '../../front-cp/public/img/event/');
// lien vers le dossier project img
	define("PROJECT", '../../front-cp/public/img/group/');
// lien vers le dossier project img
	define("LOGGER", '../lib/Logger.class.php');