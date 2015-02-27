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
 */ 
class UserModel extends CoreModel{

    /* * * * * * * * * * * * * * * * * * * * * * * * * */

    /* * * * * * * * * * * * * * * * * * * * * * * * * */

	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();

	}
	
/////////////////////////////////////////////////////
/* USER * * * * * * * * * * * * * * * * * * * * * * */

    /**
     * seeOneUser.php
     * 
     * All information about one user
     * 
     * @param $id $_GET ID
     */
	public function SeeOneUser() {

        // $id = $_SESSION['userID'];
        $id = '163';

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
            var_dump($retour);
            return $retour;
            
            
        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
    }

	//Retourne l'extension d'un fichier
	public function getExtension($fichier){
		$extension_upload = strtolower(  substr(  strrchr($fichier, '.') ,1)  );
		return $extension_upload;
	}
	
	/**
	 * Déplacement du fichier de l'emplacement tmp  vers le bon emplacement serveur
	 */
    public function upload($index, $destination)
	{
		
		$extension = $this->getExtension($destination);
		//Déplacement
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