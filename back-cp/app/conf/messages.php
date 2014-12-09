<?php

/**
 * Messages
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */
$logger->log('test', 'loadapp', "Chargement de l'application messages.php", Logger::GRAN_MONTH);
//rouge
	$messageErreur = array(
		"LEVEL_REQUIRED"	=> "Désolé, vous devez être identifié.",
		"LEVEL_LOW"			=> "Désolé, vos droits sont insuffisants.",
		"USER_LOGIN_NOK"	=> "Login ou mot de passe incorrecte."
	);
	
//vert
	$messageInfo = array(
		"USER_LOGIN_OK"		=> "Merci de vous être identifié.",
		"USER_LOGOUT_OK"	=> "Vous êtes correctement déconnecté."
	);		