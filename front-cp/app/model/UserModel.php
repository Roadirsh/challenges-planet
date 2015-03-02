<?php 

/**
 * UserModel
 *
 * Everything who is relative to a USER
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * SEE ONE USER
 * MY PAGE
 */ 
class UserModel extends CoreModel{

	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();

	}
	
/////////////////////////////////////////////////////
/* MY PROFILE * * * * * * * * * * * * * * * * * * */

    /**
     * Linked to : 
     * controller/UserController.php
     * view/seemypage.php
     * 
     * All information about one user
     * 
     * @param $id $_GET ID
     */
	public function SeeMyPage() {

        // $id = $_SESSION['userID'];
        $id = $_SESSION[PREFIX . 'userID'];

        try {
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * Get All the informations about the user from the ID
            */
            $select = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "user
                                                WHERE user_type != 'admin'
                                                AND user_id = :userID");
           
            $select->bindValue(':userID', $id, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $user = $select->FetchAll();
            $select->closeCursor(); 

            $retour = $user[0];

            if(!empty($user)){

                $select2 = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "phone
                                                WHERE user_user_id = :userID");
           
                $select2->bindValue(':userID', $id, PDO::PARAM_INT);
                $select2->execute();
                $select2->setFetchMode(PDO::FETCH_ASSOC);
                $phone = $select2->FetchAll();
                $select2->closeCursor(); 

                if(!empty($phone[0])){
                    $retour = array_merge($retour, $phone[0]);
                }
  
                $select3 = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "adress
                                                WHERE user_user_id = :userID");
           
                $select3->bindValue(':userID', $id, PDO::PARAM_INT);
                $select3->execute();
                $select3->setFetchMode(PDO::FETCH_ASSOC);
                $adress = $select3->FetchAll();
                $select3->closeCursor(); 

                if(!empty($adress[0])){
                    $retour = array_merge($retour, $adress[0]);
                }
     
                $select4 = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "bank_details
                                                WHERE user_user_id = :userID");
                
                $select4->bindValue(':userID', $id, PDO::PARAM_INT);
                $select4->execute();
                $select4->setFetchMode(PDO::FETCH_ASSOC);
                $adress2 = $select4->FetchAll();
                $select4->closeCursor(); 

                if(!empty($adress2)){
                    $retour = array_merge($retour, $adress2[0]);
                }

            }
            return $retour;
            
            
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
    }

    /**
     * Linked to : 
     * controller/UserController.php
     * view/seemypage.php
     * 
     * All information about one user
     * 
     * @param $id $_GET ID
     */
    public function SeeMyPageEvents($id) {

        try{
            $select5 = $this->connexion->prepare("SELECT * 
                                                FROM cp_user_has_group A, cp_event_has_group B
                                                JOIN cp_event C 
                                                ON C.event_id = B.event_event_id 
                                                WHERE A.user_user_id = :userID
                                                AND A.group_group_id = B.group_group_id ");
                    
            $select5->bindValue(':userID', $id, PDO::PARAM_INT);
            $select5->execute();
            $select5->setFetchMode(PDO::FETCH_ASSOC);
            $array = $select5->FetchAll();
            $select5->closeCursor(); 


            return $array;
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }

    }

    /**
     * Linked to : 
     * controller/UserController.php
     * view/seemypage.php
     * 
     * All information about one user
     * 
     * @param $id $_GET ID
     */
    public function SeeMyPageGroups($id) {

        try{
            $select5 = $this->connexion->prepare("SELECT *, 
                                                    (SELECT SUM(donate_amount) 
                                                    FROM cp_donate E 
                                                    WHERE E.group_group_id = A.group_id) 
                                                    AS helped
                                                FROM cp_group A, cp_event B, cp_event_has_group C, cp_user_has_group D
                                                WHERE C.group_group_id = A.group_id
                                                AND D.group_group_id = A.group_id
                                                AND C.event_event_id = B.event_id
                                                AND D.user_user_id = :userID");
                    
            $select5->bindValue(':userID', $id, PDO::PARAM_INT);
            $select5->execute();
            $select5->setFetchMode(PDO::FETCH_ASSOC);
            $array = $select5->FetchAll();
            $select5->closeCursor(); 


            return $array;
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }

    }

/////////////////////////////////////////////////////
/* UPDATE MY PROFILE * * * * * * * * * * * * * * * */

    /**
     * Linked to : 
     * controller/UserController.php
     * view/seemypage.php
     * 
     * Update pseudo
     * 
     * @param $id $_GET ID
     */
    public function updatePseudo($data, $id) {
        try {
            $select = $this->connexion->prepare("UPDATE " . PREFIX . "user 
                                                SET `user_pseudo` = '" . $data . "'
                                                WHERE user_id = '" . $id . "'");
            if($select->execute()){
                $_SESSION['cp_userPseudo'] = $data;
                return true;
            } else {
                return false;
            }
        }
        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }
    }

    /**
     * Linked to : 
     * controller/UserController.php
     * view/seemypage.php
     * 
     * Update Website
     * 
     * @param $id $_GET ID
     */
    public function updateWebsite($data, $id) {
        try {
            $select = $this->connexion->prepare("UPDATE " . PREFIX . "user 
                                                SET `user_site` = '" . $data . "'
                                                WHERE user_id = '" . $id . "'");
            if($select->execute()){
                return true;
            } else {
                return false;
            }
        }
        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }
    }

    /**
     * Linked to : 
     * controller/UserController.php
     * view/seemypage.php
     * 
     * Update phone
     * 
     * @param $id $_GET ID
     */
    public function updatePhone($data, $id) {
        try {
            $select = $this->connexion->prepare("UPDATE " . PREFIX . "user 
                                                SET `user_phone` = '" . $data . "'
                                                WHERE user_id = '" . $id . "'");
            if($select->execute()){
                return true;
            } else {
                return false;
            }
        }
        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }
    }

    /**
     * Linked to : 
     * controller/UserController.php
     * view/seemypage.php
     * 
     * Update adress
     * 
     * @param $id $_GET ID
     */
    public function updateAdress($data, $id) {
        try {
            $select = $this->connexion->prepare("UPDATE " . PREFIX . "user 
                                                SET `user_pseuso` = '" . $data . "'
                                                WHERE user_id = '" . $id . "'");
            if($select->execute()){
                return true;
            } else {
                return false;
            }
        }
        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }
    }

    /**
     * Linked to : 
     * controller/UserController.php
     * view/seemypage.php
     * 
     * Update mail
     * 
     * @param $id $_GET ID
     */
    public function updateMail($data, $id) {
        try {
            $select = $this->connexion->prepare("UPDATE " . PREFIX . "user 
                                                SET `user_mail` = '" . $data . "'
                                                WHERE user_id = '" . $id . "'");
            if($select->execute()){
                return true;
            } else {
                return false;
            }
        }
        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }
    }

    /**
     * Linked to : 
     * controller/UserController.php
     * view/seemypage.php
     * 
     * Update password
     * 
     * @param $id $_GET ID
     */
    public function updatePwd($data, $id) {
        try {
            $select = $this->connexion->prepare("UPDATE " . PREFIX . "user 
                                                SET `user_password` = '" . $data . "'
                                                WHERE user_id = '" . $id . "'");
            if($select->execute()){
                return true;
            } else {
                return false;
            }
        }
        catch (Exception $e)
        {
            echo 'Message:' . $e->getMessage();
        }
    }

/////////////////////////////////////////////////////
/* ONE USER * * * * * * * * * * * * * * * * * * * * */

    /**
     * Linked to : 
     * controller/UserController.php
     * view/seeoneuser.php
     * 
     * All information about one user
     * 
     * @param $id $_GET ID
     */
    public function SeeOneUser($id) {

        try {
            /* * * * * * * * * * * * * * * * * * * * * * * *
            * Get All the informations about the user from the ID
            */
            $select = $this->connexion->prepare("SELECT user_id, user_date, user_birthday, user_mail, user_pseudo, user_profil_pic, user_type, user_site
                                                FROM " . PREFIX . "user
                                                WHERE user_type = 'student'
                                                AND user_id = :userID");
           
            $select->bindValue(':userID', $id, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $user = $select->FetchAll();
            $select->closeCursor(); 

            if(isset($user[0]['user_id'])){
                $retour = $user[0];
            } else {
                $retour = $user;
            }
            

            if(!empty($user)){

                $select2 = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "phone
                                                WHERE user_user_id = :userID");
           
                $select2->bindValue(':userID', $id, PDO::PARAM_INT);
                $select2->execute();
                $select2->setFetchMode(PDO::FETCH_ASSOC);
                $phone = $select2->FetchAll();
                $select2->closeCursor(); 

                if(!empty($phone[0])){
                    $retour = array_merge($retour, $phone[0]);
                }
  
                $select3 = $this->connexion->prepare("SELECT *
                                                FROM " . PREFIX . "adress
                                                WHERE user_user_id = :userID");
           
                $select3->bindValue(':userID', $id, PDO::PARAM_INT);
                $select3->execute();
                $select3->setFetchMode(PDO::FETCH_ASSOC);
                $adress = $select3->FetchAll();
                $select3->closeCursor(); 

                if(!empty($adress[0])){
                    $retour = array_merge($retour, $adress[0]);
                }

            }
            return $retour;
            
            
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
    }

    /**
     * Linked to : 
     * controller/UserController.php
     * view/seeoneuser.php
     * 
     * All information about one user
     * 
     * @param $id $_GET ID
     */
    public function SeeOneUserEvents($id) {

        try{
            $select5 = $this->connexion->prepare("SELECT * 
                                                FROM cp_user_has_group A, cp_event_has_group B
                                                JOIN cp_event C 
                                                ON C.event_id = B.event_event_id 
                                                WHERE A.user_user_id = :userID
                                                AND A.group_group_id = B.group_group_id ");
                    
            $select5->bindValue(':userID', $id, PDO::PARAM_INT);
            $select5->execute();
            $select5->setFetchMode(PDO::FETCH_ASSOC);
            $array = $select5->FetchAll();
            $select5->closeCursor(); 


            return $array;
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }

    }

    /**
     * Linked to : 
     * controller/UserController.php
     * view/seeoneuser.php
     * 
     * All information about one user
     * 
     * @param $id $_GET ID
     */
    public function SeeOneUserGroups($id) {

        try{
            $select5 = $this->connexion->prepare("SELECT *, 
                                                    (SELECT SUM(donate_amount) 
                                                    FROM cp_donate E 
                                                    WHERE E.group_group_id = A.group_id) 
                                                    AS helped
                                                FROM cp_group A, cp_event B, cp_event_has_group C, cp_user_has_group D
                                                WHERE C.group_group_id = A.group_id
                                                AND D.group_group_id = A.group_id
                                                AND C.event_event_id = B.event_id
                                                AND D.user_user_id = :userID");
                    
            $select5->bindValue(':userID', $id, PDO::PARAM_INT);
            $select5->execute();
            $select5->setFetchMode(PDO::FETCH_ASSOC);
            $array = $select5->FetchAll();
            $select5->closeCursor(); 


            return $array;
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }

    }

/////////////////////////////////////////////////////
/* ADD USER * * * * * * * * * * * * * * * * * * */

	// Get ext files
	public function getExtension($fichier){
		$extension_upload = strtolower(  substr(  strrchr($fichier, '.') ,1)  );
		return $extension_upload;
	}
	
	/**
     * Linked to : 
     * controller/EventController.php
     * Signup
     * 
     * Add a event into the Database
     * 
     * @param Array = $_POST as $post
     */
    public function upload($index, $destination)
	{
		
		$extension = $this->getExtension($destination);
		//move
	   move_uploaded_file($index,$destination);
		if($extension=="jpg" || $extension=="jpeg" )
		{
			$src = imagecreatefromjpeg($destination);
		}
		else if($extension=="png")
		{
			$src = imagecreatefrompng($destination);
		}
		else 
		{
			$src = imagecreatefromgif($destination);
		}
		
		list($width,$height)=getimagesize($destination);
		//Resize à 250px
		$newwidth=250;
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);

		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);

		$filename = $destination;
		
		imagejpeg($tmp,$filename,100);
		
		imagedestroy($src);
		imagedestroy($tmp);

	   return true;
	}
	
	
   
}
?>