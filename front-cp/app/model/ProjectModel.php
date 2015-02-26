<?php 

/**
 * ProjectModel
 *
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */


class ProjectModel extends CoreModel{

    
    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
    }
    
/////////////////////////////////////////////////////
/* SEE ONE PROJECT * * * * * * * * * * * * * * * * */

    /**
     * seeOneProject.php
     * 
     */
    public function SeeOneGroup($id) {

        try {
            $select = $this->connexion->prepare("SELECT A.*, B.*, SUM(C.donate_amount) as group_given, D.*
                                                FROM " . PREFIX . "group A, " . PREFIX . "event_has_group B, " . PREFIX . "donate C, " . PREFIX . "event D
                                                WHERE D.event_id = B.event_event_id
                                                AND A.group_valid = 1
                                                AND A.group_id = :id");

            $select->bindValue(':id', $id, PDO::PARAM_INT);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_ASSOC);
            $array = $select->FetchAll();
            $select->closeCursor();
            
            return $array[0];

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }   
    }


    /**
     * seeOneProject.php
     * 
     */
    public function SeeOneGroupSponsors($id) {

        try {
            $select2 = $this->connexion->prepare("SELECT A.cp_user_user_id, B.*
                                                FROM " . PREFIX . "donate A
                                                JOIN " . PREFIX . "user B
                                                ON A." . PREFIX . "user_user_id = B.user_id
                                                WHERE group_group_id = :id
                                                LIMIT 6");

            $select2->bindValue(':id', $id, PDO::PARAM_INT);
            $select2->execute();
            $select2->setFetchMode(PDO::FETCH_ASSOC);
            $array = $select2->FetchAll();
            $select2->closeCursor(); 
            
            return $array;

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }   
    }

    /**
     * seeOneProject.php
     * 
     */
    public function SeeOneGroupUsers($id) {

        try {
            $select2 = $this->connexion->prepare("SELECT A.user_id, A.user_pseudo, A.user_profil_pic, B.*, C.group_id
                                                FROM " . PREFIX . "user A, " . PREFIX . "user_has_group B, " . PREFIX . "group C
                                                WHERE B.user_user_id = A.user_id
                                                AND B.group_group_id = C.group_id
                                                AND C.group_id = :id
                                                LIMIT 3");

            $select2->bindValue(':id', $id, PDO::PARAM_INT);
            $select2->execute();
            $select2->setFetchMode(PDO::FETCH_ASSOC);
            $array = $select2->FetchAll();
            $select2->closeCursor(); 
            
            return $array;

        } catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }   
    }

/////////////////////////////////////////////////////
/* MOBILE APP * * * * * * * * * * * * * * * * * * */

    /**
     * mobile application
     *
     */
    public function getProjectJSON() {

        try {
				$selectfrom = "SELECT group_name, group_descr, group_id 
                                                    FROM  `" . PREFIX . "group` ";
                if(isset($_GET['id'])){
	                $projetparevent = "`" . PREFIX . "event_has_group`.`event_event_id` = :id AND ";
					$jointure = "LEFT JOIN " . PREFIX . "event_has_group 
                             ON " . PREFIX . "group.group_id = " . PREFIX . "event_has_group.group_group_id ";
							 
                }
                else{
	                $jointure = "";
	                $projetparevent = "";
                }
                
                
                $where = "WHERE "  .  $projetparevent . " group_valid = 1";
                $query = $selectfrom.$jointure.$where;
                                                    
                $select = $this->connexion->prepare($query);
				if(isset($_GET['id'])){
                	$select->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                }
                $select->execute();
                $select->setFetchMode(PDO::FETCH_ASSOC);
                $event = $select->FetchAll();
                
                $json = json_encode($event);

                return $json;

        }

        catch (Exception $e) {
            echo 'Message:' . $e->getMessage();
        }
    }

/////////////////////////////////////////////////////
/* ADD PROJECT * * * * * * * * * * * * * * * * * * */
    
    //Retourne l'extension d'un fichier
    public function getExtension($fichier){
		$extension_upload = strtolower(  substr(  strrchr($fichier, '.') ,1)  );
		return $extension_upload;
	}

    //Déplacement de l'emplacement temporaire vers la desitnation finale sur le serveur
    public function upload($index, $destination){
		
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
		// Resize de l'image et compression
		$newwidth=378;
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);

		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,
		 $width,$height);

		$filename = $destination;
		
		imagejpeg($tmp,$filename,100);
		
		imagedestroy($src);
		imagedestroy($tmp);

	   return true;
	}


}