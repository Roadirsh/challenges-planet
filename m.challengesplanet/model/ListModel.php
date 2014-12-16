<?
/**
 * Afichage de la liste des events
 * 
 * @package      Framework_mobile_L&G
 * @copyright    L&G
 */

// $index = new ListModel();

class ListModel extends CoreModel{


    function __construct(){
        parent::__construct();
        // $this->ShowList();
    }

    public function ShowList(){

        try {

            $select = $this->connexion->prepare("SELECT *
                                            FROM " . PREFIX . "event");
           
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $AllEvent = $select -> FetchAll();
            
            // var_dump($AllEvent);
            return $AllEvent;
            
            
        } catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
        
    }

}