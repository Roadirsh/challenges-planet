<?
/**
 * Afichage de la liste des events
 * 
 * @package      Framework_mobile_L&G
 * @copyright    L&G
 */

require_once('../config.php');
require_once('../model/ListModel.php');

$index = new ListController;

class ListController{

    function __construct(){
        $this->ShowList();
    }

    public function ShowList(){

        $Show = $this->model = new ListModel();
        $List = $Show-> ShowList();
        
        // echo 'les events = '; 
        echo json_encode($List);
        
    }
}