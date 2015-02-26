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
                $this->SeeOneProject();
            } else {
                $this->coreRedirect('user', 'login');
            }
        }
    }

    /**
     * seeproject.php
     *
     */
    public function SeeOneProject() {

        $project = $this->model = new ProjectModel();

        /* * * * * * * * * * * * * * * * * * * * * * * *
        * Get All projects
        */
        $SeeOneProject = $project->SeeOneGroup($_GET['id']);
        $SeeSponsors = $project->SeeOneGroupSponsors($_GET['id']);

        $array['project'] = $SeeOneProject;
        $array['sponsors'] = $SeeSponsors;
        

        if(isset($_POST['donut']) and !empty($_POST['donut'])){
            $_SESSION["donation_amount"] = $_POST['donut'];
            $_SESSION["donation_team"] = $SeeOneProject['group_name'];
            $_SESSION["donation_event"] = $SeeOneProject['event_name'];
            $_SESSION["donation_team_img"] = $SeeOneProject['group_img'];

            
            $this->coreRedirect('cart', 'seeOneCart'); 
        }


        /* Load the view */
        if(empty($SeeOneProject['group_name'])){
            $this->corePage404();

        } else{

            /* * * * * * * * * * * * * * * * * * * * * * * *
            * <head> STUFF </head>
            */
            define("PAGE_TITLE", SITE_NAME . " - " . $array['project']['group_name']);
            define("PAGE_DESCR", SITE_NAME . " " . $array['project']['group_descr']);
            define("PAGE_ID", "seeProject");

            $this->load->view('project', 'seeOneProject', $array); 
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