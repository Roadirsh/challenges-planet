<?php

/**
 * Connexion PDO 
 *
 * ! require 	conf_mysql.php
 * 
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

try
{
    // se connecter avec PDO 
	require_once('conf_mysql.php');
	// option de connexion
	$option = array(
		// sur la classe PDO on va initialiser statiquement une info qui est MYSQL_ATTR_INIT_COMMAND
		// et dans cette variable, on va lui donner la commande initial SET NAMES utf8
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		// et on gère les erreurs avec le mode voulu
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

	// créer une variable globale pour récupérer la connexion dans toutes les fonctions
	global $connexion;
	// $GLOBALS['connexion'] = $connexion;
	// on instentie la classe
	// $connexion = new PDO($dns, $PARAM_utilisateur, $PARAM_mot_passe, $option);
}

catch (Exception $e) 
{
	echo "Connexion à Mysql impossible : ", $e -> getMessage();
}