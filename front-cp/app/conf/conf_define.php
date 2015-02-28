<?php

/**
 * Configuration des DEFINE
 *
 * @package     Framework_L&G
 * @copyright 	L&G
 */

// To the global directory
	define("ROOT", '../app/');
// To the principal Model
	define("MODEL", '../core/Model/');
// Index.php
	define("INDEX", 'index.php?');
// Web site's name
	define("SITE_NAME", 'Challenges Planet');
// PREFIXE of DB
	define("PREFIX", 'cp_');
// dev URL
    define("DEV", 'ns366377.ovh.net');
// MODULE
    define("MODULE", 'index.php?module=');
// ACTION
    define("ACTION", '&amp;action=');
// ID
    define("ID", '&amp;id=');
// PAGE
    define("PAGE", '&amp;page=');
// MESSAGES
    define("MESS", '&amp;m=');
// Root server URL
	define('BASE_DIR', "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["SCRIPT_NAME"]));
// Web Site's slogan
	define("JOIN", "<span>Join </span>the best caritative student challenges");
// LOGS
	define("LOGGER", "../lib/Logger.class.php");
// AVATAR IMG
    define("AVATAR", '../../front-cp/public/img/avatar/');
// EVENT IMG
    define("EVENT", '../../front-cp/public/img/event/');
// PROJECTS TEAM IMG
    define("PROJECT", '../../front-cp/public/img/group/');
// ORGANISM IMG
    define("ORGANISM", '../../front-cp/public/img/organism/');


// LIMIT PAGINATION EVENT
    define("LIMIT", 7);
