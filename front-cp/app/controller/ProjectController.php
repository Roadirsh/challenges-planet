<?php 

/**
 * ProjectController
 *
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * PROJECT JSON 
 */
class ProjectController extends CoreController {
    
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
            if(isset($_SESSION['user']) != ''){
                $this->Projectjson();
            } else {
                $this->coreRedirect('user', 'login');
            }
        }
    }

    /**
     * mobile application
     *
     */
    public function Projectjson() {

        header('Content-Type: application/json');
        $project = $this->model = new ProjectModel();
        $json = $project->getProjectJSON();
        echo $json;

    }
    
    

}