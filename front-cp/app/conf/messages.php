<?php

/**
 * Messages
 *
 * @package 	Framework_L&G
 * @copyright 	L&G
 */

/* * * * * * * * * * * * * * * * * * * * * * *
 * MESSAGE CONSTRUCTION MAIL FORGOT PASSWORD
 */
	
	function messageHTML($email, $password){
		$message = "Hello,
		
		We heard that you lost your ChallengesPlanet password. Sorry about that!

		But don't worry! Here you are:
		
		email : " . $email . "
		password : " . $password . "

		http://challengespla.net

		Thanks,
		Your friends at Admin - ChallengesPlanet";

		return $message;
	}

/* * * * * * * * * * * * * * * * * * * * * * *
 * RED => NOT OK 
 */
	$messageErreur = array(
		"USER_LOGIN_NOK"	=> "Oops it seems there's a problem, please try again",
		"USER_SIGN_NOK"		=> "Oops it seems there's a problem, please try again",
		"EVENT_ADD_NOK"		=> "It seems that the event creation has failed. Please try again",
		"UPDATE_PWD_NOK"	=> "Oops it seems there's a problem, please try again",
	);
	
/* * * * * * * * * * * * * * * * * * * * * * *
 * GREEN => OK 
 */
	$messageInfo = array(
		"USER_LOGIN_OK"		=> "You were succesfully logged in ! Welcome !",
		"USER_LOGOUT_OK"	=> "Thanks for visiting our web site, see you soon",
		"USER_SIGN_OK"		=> "Thanks for joing us, you are now logged in !",
		"EVENT_ADD_OK"		=> "Thanks for this new event, this will be checked and approved by our team",
		"UPDATE_PWD_OK"		=> "Please check your email box to get the new password",
	);		

