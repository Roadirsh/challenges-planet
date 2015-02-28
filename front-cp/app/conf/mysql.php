<?php

/**
 * Connexion with 
 *
 * ! require 	conf_mysql.php
 * 
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

try
{
    /* * * * * * * * * * * * * * * * * * * * * * *
     * GET ALL INFORMATIONS 
     */
	require_once('conf_mysql.php');
	
	/* * * * * * * * * * * * * * * * * * * * * * *
     * CONNEXION OPTIONS
     */
	$option = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

	/* * * * * * * * * * * * * * * * * * * * * * *
     * VARIABLE TO MAKE CONNEXION
     */
	global $connexion;
}

catch (Exception $e) 
{
	echo "Impossible to connect mysql : ", $e -> getMessage();
}