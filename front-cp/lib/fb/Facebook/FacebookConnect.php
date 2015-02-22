<?php
/**
 * Created by PhpStorm.
 * User: saskiagiraud
 * Date: 20/02/15
 * Time: 14:59
 */

// namespace FB\Facebook;

// use Facebook\FacebookRedirectLoginHelper;
// use Facebook\FacebookRequest;
// use Facebook\FacebookSession;


class FacebookConnect {

    private $appID; // FB APPLICATION ID
    private $appSecret; // FB APPLICATION SECRET


    /**
     * @param $appID
     * @param $appSecret
     */
    function __construct($appID, $appSecret){
        $this->appID = $appID;
        $this->appSecret = $appSecret;

    }

    /**
     * @param $redirect_url
     * @return string
     */
    function connect($redirect_url){

        define('FACEBOOK', '../vendor/facebook/php-sdk-v4/src/Facebook/');
        require_once(FACEBOOK . 'FacebookSession.php');

        FacebookSession::setDefaultApplication($this->appID, $this->appSecret);
        $helper = new FacebookRedirectLoginHelper($redirect_url);

        if(isset($_SESSION) && isset($_SESSION['fb_token'])){

            $session = new FacebookSession($_SESSION['fb_token']);

        }  else{

            $session = $helper->getSessionFromRedirect();

        }

        if($session){
            try {
                $_SESSION['fb_token'] = $session->getToken();

                $request = new FacebookRequest($session, "GET", '/me');

                $profile = $request->execute()->getGraphObject("Facebook\Graphuser");

                if($profile->getEmail() === null){
                    throw new \Exception("l'email pas dispo");
                }

                return $profile;

                // SELECT * FROM cp_user WHERE user_fb_id = $fbID
            }
            catch (\Exception $e){
                unset($_SESSION['fb_token']);
                return $helper->getReRequestUrl(['email']);
            }


        } else {

            return $helper->getReRequestUrl(['email']);

        }

    }

}