<?php

class FbController extends CoreController {

    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
        if(isset($_GET['action'])){
            //ucfirt = put the first letter in Uppercase
            $action = ucfirst($_GET['action']);

            if(method_exists($this, $action)){
                $this->$action();
            } else{
                $this->corePage404();
            }


        } else {
            // is their a session or not?
            if (isset($_SESSION['user']) != '') {
                $this->FacebookConnect();
            } else {
                $this->coreRedirect('', 'login');
            }
        }

    }
    
    public function FacebookConnect(){

        $appID = '1032282680121355';
        $appSecret = 'd23586cd9525f8fcdfc8b96bf6eb2985';

        $connect = new FacebookConnect($appID, $appSecret);

        $user = $connect->connect('http://localhost:8888/fbconnect/index.php');

        if(is_string($user)){
            $user;
        } else{
            var_dump($user);
        }

        $array = $user;
        
        exit;
        // $this->coreRedirect('page', 'home', $array);
    }
}