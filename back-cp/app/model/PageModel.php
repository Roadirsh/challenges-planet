<?php 

/**
 * UserModel
 *
 * Requêtes relatifs au user
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */


class PageModel extends CoreModel{

    /**
     * Compte du nombre de Users
     */
    public function NbUsers(){

        try {
            $select = $this->connexion->prepare("SELECT user_id 
                                            FROM " . PREFIX . "user WHERE user_type != 'admin' AND user_type!= 'delete'");
                    
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> rowCount();

            // $select -> closeCursor();

            //var_dump($retour);

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }/**
     * Compte du nombre de projets restant à valider
     */
    public function NbProjetRestant(){

        try {
            $select = $this->connexion->prepare("SELECT group_id 
                                            FROM " . PREFIX . "group WHERE group_valid = 0");
                    
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> rowCount();
            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }/**
     * Compte du nombre d'évenements restant à valider
     */
    public function NbEventRestant(){

        try {
            $select = $this->connexion->prepare("SELECT event_id 
                                            FROM " . PREFIX . "event WHERE event_valid = 0");
                    
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> rowCount();

            // $select -> closeCursor();

            //var_dump($retour);

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
    /**
     * Compte du nombre de Users
     */
    public function NbEvents(){

        try {
            $select = $this->connexion->prepare("SELECT event_id 
                                            FROM " . PREFIX . "event");
                    
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> rowCount();

            // $select -> closeCursor();

            //var_dump($retour);

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
    /**
     * Compte du nombre de Users
     */
    public function NbGroups(){

        try {
            $select = $this->connexion->prepare("SELECT group_id 
                                            FROM " . PREFIX . "group");
                    
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> rowCount();

            // $select -> closeCursor();

            //var_dump($retour);

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
    
    /**
     * Compte du nombre de donation total
     */
    public function NbDonat(){

        try {
            $select = $this->connexion->prepare("SELECT sum(donate_amount) as sum
                                            FROM " . PREFIX . "donate");
                    
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
			$retour = $select -> fetchAll();

            return $retour[0]["sum"];
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }    
    /**
     * Voir l'ensemble des admins
     */
    public function Seeteam(){

        try {
            $select = $this->connexion->prepare("SELECT * 
                                            FROM " . PREFIX . "user
                                            WHERE user_type = 'admin'");
                    
            //var_dump($select);
            $select -> execute();
            $select -> setFetchMode(PDO::FETCH_ASSOC);
            $retour = $select -> fetchAll();

            // $select -> closeCursor();

            //var_dump($retour);

            return $retour;
        }

        catch (Exception $e)
        {
            echo 'Message:' . $e -> getMessage();
        }
    }
    
    /**
     * Supprimer un membre des admins
     */
    public function Delteam(){
    	//var_dump($GLOBALS);
    	$delteamID = $_GET['id'];
    	
    	try {
    	    // rajouer un trigger corbeille
        	$select = $this->connexion->prepare("DELETE
                                            FROM " . PREFIX . "user
                                            where user_id = '" . $delteamID . "'");
           
            //var_dump($select); exit();
            $select -> execute();
            
            //var_dump($AllUser);
            return true;
            
            
    	} catch (Exception $e) {
            echo 'Message:' . $e -> getMessage();
        }
    	
	}
	
	/**
	 * Search overAll
	 *
	 * @param array $_POST
	 */
	public function SearchAll($post){
	
	    include('../lib/blacklist.inc.php');
        $post = $_POST['search'];
        $exp = explode(" ", $post);

	    $i = 0;
	    $count = count($exp);
        
	    foreach($exp as $k => $e)
	    {
	        if(!empty($e))
	        {
	            if(strlen($e) > 3)
	            {
	                if(!in_array(strtolower($e), $adv))
	                { 
	                    $r = '';
	                    // ADDRESS TABLE BDD
                        $r .= "A.ad_street LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "A.ad_zipcode LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "A.ad_city LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "A.ad_country LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "A.ad_type LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
	                    // EVENT TABLE BDD
	                    $r .= "B.event_name LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "B.event_decr LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "B.event_location LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        // GROUP TABLE BDD
                        $r .= "C.group_name LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "C.group_descr LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        // PHONE TABLE BDD
                        $r .= "D.phone_type LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        // USER TABLE BDD
                        $r .= "E.user_lastname LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "E.user_firstname LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "E.user_mail LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "E.user_pseudo LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
                        $r .= "E.user_type LIKE '%".addslashes($e)."%' ";
                        if($i < $count){
                            $r .= "OR ";
                        }
	                }
	            }
	        }
	        $i ++; 
	    }

	    $r = substr($r, 0, -4);
	    if(!empty($r)): $ajout = $r; endif;
	    
	    
	    
	    $select = $this->connexion->prepare("SELECT *
		                                FROM 
    		                                " . PREFIX . "adress A,
    		                                " . PREFIX . "event B,
    		                                " . PREFIX . "group C, 
    		                                " . PREFIX . "phone D, 
    		                                " . PREFIX . "user E
		                                WHERE " . $ajout);
        var_dump($select);
		$select -> execute();
		$select -> setFetchMode(PDO::FETCH_ASSOC);
		$retour = $select -> fetchAll();
		
		var_dump($retour); exit();
    }
}