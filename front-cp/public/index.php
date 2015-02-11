<?php

/**
 * BIG DADY Controller 
 * 
 * @package      Framework_L&G
 * @copyright    L&G
 */

/* Sometimes, you'll need the information of php on your server */
    // phpinfo(); die;

/* Start the session */
    session_start();

/* Give the new born session a name */
    session_name('ChallengesPlanet');
    $_SESSION['name'] = "CP";

/* Get the define file */
    require_once('../app/conf/conf_define.php');

/* Put the all project in UTF-8 */
    header('Content-type: text/html; charset=UTF-8');

/* Make sure you'll have the errors */
    // error_reporting(E_ALL);
    // ini_set("error_reporting", "E_ALL");
    // ini_set('display_errors', 1);


/* Get the Core's librairies */

    /* Pages */
    include_once '../core/Load.php';
    /* Gobal controller */
    include_once '../core/CoreController.php';
    /* Global model */
    include_once '../core/CoreModel.php';
    /* Global Library */
    include("../lib/lib.php");
    /* Global Messages */
    include(ROOT . "conf/messages.php");
    
    
/* APPLICATION GO!! */
    include_once(ROOT . 'app.php');
