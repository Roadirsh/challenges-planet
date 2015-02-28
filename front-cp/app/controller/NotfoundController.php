<?php

/**
 * NotfoundController
 *
 * Error 404 page, notfound
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * NOT FOUND
 */
class NotfoundController extends CoreController{

	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
			$this->Notfound();
	}

	/**
     * Linked to :
     * view/notfound.php
     */
	public function Notfound(){
		
		/* * * * * * * * * * * * * * * * * * * * * * * *
        * <head> STUFF </head>
        */
		define("PAGE_TITLE", SITE_NAME . " 404 - not found");
		define("PAGE_DESCR", SITE_NAME . " ");
		define("PAGE_ID", "404");

		/* Load the view */
		$this->load->view('layout', 'notfound');

	}

}